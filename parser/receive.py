import hashlib
import json
import logging

import pika
import yaml
from peewee import MySQLDatabase, Model, CharField, IntegerField, ForeignKeyField

with open("config.yaml") as file_handler:
    try:
        config = yaml.load(file_handler, Loader=yaml.FullLoader)
    except yaml.YAMLError as e:
        logging.error("Error occurred " + str(e))

db_handle = MySQLDatabase(config["mysql"]["db"], user=config["mysql"]["user"], password=config["mysql"]["password"],
                          host=config["mysql"]["host"])


class BaseModel(Model):
    class Meta:
        database = db_handle


class SportTypes(BaseModel):
    title = CharField(max_length=255, unique=True)

    class Meta:
        db_table = "sport_types"

    @staticmethod
    def create_or_get(title):
        sport_type = SportTypes.get_or_none(SportTypes.title == title)
        if sport_type is None:
            sport_type = SportTypes(title=title)
            sport_type.save()

        return sport_type


class Tournaments(BaseModel):
    title = CharField(max_length=255, unique=True)

    class Meta:
        db_table = "tournaments"

    @staticmethod
    def create_or_get(title):
        tournament = Tournaments.get_or_none(Tournaments.title == title)
        if tournament is None:
            tournament = Tournaments(title=title)
            tournament.save()

        return tournament


class Teams(BaseModel):
    sport_type = ForeignKeyField(SportTypes)
    external_team_id = CharField(max_length=32, unique=True)
    title = CharField(max_length=255)

    class Meta:
        db_table = "teams"

    @staticmethod
    def create_or_get(sport_type, external_team_id, title):
        team = Teams.get_or_none(Teams.title == title)
        if team is None:
            team = Teams(sport_type=sport_type, external_team_id=external_team_id, title=title)
            team.save()

        return team


class Matches(BaseModel):
    sport_type = ForeignKeyField(SportTypes)
    tournament = ForeignKeyField(Tournaments)
    parent_match_id = CharField(max_length=32, unique=True)
    external_match_id = CharField(max_length=32, unique=True)
    team_home = ForeignKeyField(Teams)
    team_guest = ForeignKeyField(Teams)
    start = IntegerField()
    bets = CharField()
    gg_matches = CharField()

    class Meta:
        db_table = "matches"

    @staticmethod
    def create_or_get(match_data):
        match = Matches.get_or_none(Matches.external_match_id == match_data["external_match_id"])
        if match is None:
            match = Matches(sport_type=match_data["sport_type"], tournament=match_data["tournament"],
                            parent_match_id=match_data["parent_match_id"],
                            external_match_id=match_data["external_match_id"],
                            team_home=match_data["team_home"],
                            team_guest=match_data["team_guest"],
                            start=int(match_data["start"] / 1000),
                            gg_matches=json.dumps(match_data["gg_matches"]))
            match.save()

        return match

    @staticmethod
    def add_or_update_bets(match_id, bets):
        match_bets = Matches.get(Matches.id == match_id).bets

        if match_bets:
            match_bets = json.loads(match_bets)
            new_best_hash = list(set(bets["bets_hash"]) - set(match_bets["bets_hash"]))

            if new_best_hash:
                match_bets["bets_hash"] = match_bets["bets_hash"] + new_best_hash

                for bet in bets["bets"]:
                    if list(bet.keys())[0] in new_best_hash:
                        match_bets["bets"].append(bet)

                Matches.update(bets=json.dumps(match_bets).encode("utf-8")).where(Matches.id == match_id).execute()
        else:
            Matches.update(bets=json.dumps(bets).encode("utf-8")).where(Matches.id == match_id).execute()


def callback(ch, method, properties, body):
    json_data = json.loads(body)

    sport_type = SportTypes().create_or_get(json_data["sport_type"])

    tournament = Tournaments().create_or_get(json_data["tournament"])

    team_home = Teams().create_or_get(sport_type, json_data["home_id"], json_data["home"])

    team_guest = Teams().create_or_get(sport_type, json_data["guest_id"], json_data["guest"])

    match_data = {
        "sport_type": sport_type,
        "tournament": tournament,
        "parent_match_id": json_data["parent_match"],
        "external_match_id": json_data["id"],
        "team_home": team_home,
        "team_guest": team_guest,
        "start": json_data["date"],
        "bets": [],
        "gg_matches": json_data["gg_matches"]
    }

    match = Matches().create_or_get(match_data)

    try:
        with open(f'data/match/{json_data["id"]}.json') as file_handler:
            file_content = file_handler.read()
            json_data = json.loads(file_content)

            bets = []
            bets_hash = []
            for event in json_data["Event"]:
                for bet in event["Value"]:
                    if not bet["B"]:
                        bet_hash = hashlib.md5(json.dumps(bet).encode("utf-8")).hexdigest()
                        bets_hash.append(bet_hash)
                        bets.append({bet_hash: bet})

                if len(bets) > 0:
                    data = {"bets_hash": bets_hash, "bets": bets}
                    Matches().add_or_update_bets(match, data)
    except IOError as e:
        logging.error("Could not open/read file: " + str(e))
    except ValueError as e:
        logging.error(f'Decoding JSON file({json_data["id"]}) has failed: ' + str(e))


credentials = pika.PlainCredentials(config["rabbit"]["user"], config["rabbit"]["password"])
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host=config["rabbit"]["host"], port=config["rabbit"]["port"], credentials=credentials))
channel = connection.channel()

channel.queue_declare(queue=config["rabbit"]["queue"])

channel.basic_consume(queue=config["rabbit"]["queue"], on_message_callback=callback, auto_ack=True)
channel.start_consuming()
