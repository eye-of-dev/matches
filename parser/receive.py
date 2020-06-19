import json
import logging
from datetime import datetime

import pika
from peewee import MySQLDatabase, Model, CharField, IntegerField, ForeignKeyField

db_handle = MySQLDatabase('matches', user='root', password='WoD3joo7', host='localhost')


class BaseModel(Model):
    class Meta:
        database = db_handle


class SportTypes(BaseModel):
    title = CharField(max_length=255, unique=True)
    created_at = IntegerField(default=int(datetime.now().timestamp()))
    updated_at = IntegerField(default=int(datetime.now().timestamp()))

    class Meta:
        db_table = "sport_types"


class Teams(BaseModel):
    sport_type = ForeignKeyField(SportTypes)
    title = CharField(max_length=255)
    created_at = IntegerField(default=int(datetime.now().timestamp()))
    updated_at = IntegerField(default=int(datetime.now().timestamp()))

    class Meta:
        db_table = "teams"


class Tournaments(BaseModel):
    title = CharField(max_length=255, unique=True)
    created_at = IntegerField(default=int(datetime.now().timestamp()))
    updated_at = IntegerField(default=int(datetime.now().timestamp()))

    class Meta:
        db_table = "tournaments"


class Matches(BaseModel):
    sport_type = ForeignKeyField(SportTypes)
    tournament = ForeignKeyField(Tournaments)
    parent_match_id = CharField(max_length=32, unique=True)
    external_match_id = CharField(max_length=32, unique=True)
    team_home = ForeignKeyField(Teams)
    team_guest = ForeignKeyField(Teams)
    start = IntegerField()
    is_bet = IntegerField(default=0)
    created_at = IntegerField(default=int(datetime.now().timestamp()))
    updated_at = IntegerField(default=int(datetime.now().timestamp()))

    class Meta:
        db_table = "matches"


class Bets(BaseModel):
    match = ForeignKeyField(Matches)
    bet = CharField()
    created_at = IntegerField(default=int(datetime.now().timestamp()))
    updated_at = IntegerField(default=int(datetime.now().timestamp()))

    class Meta:
        db_table = "bets"


def callback(ch, method, properties, body):
    json_data = json.loads(body)

    sport_type = SportTypes.get_or_none(SportTypes.title == json_data["sport_type"])
    if sport_type is None:
        sport_type = SportTypes(title=json_data["sport_type"])
        sport_type.save()

    tournament = Tournaments.get_or_none(Tournaments.title == json_data["tournament"])
    if tournament is None:
        tournament = Tournaments(title=json_data["tournament"])
        tournament.save()

    team_home = Teams.get_or_none(Teams.sport_type == sport_type, Teams.title == json_data["home"])
    if team_home is None:
        team_home = Teams(sport_type=sport_type, title=json_data["home"])
        team_home.save()

    team_guest = Teams.get_or_none(Teams.sport_type == sport_type, Teams.title == json_data["guest"])
    if team_guest is None:
        team_guest = Teams(sport_type=sport_type, title=json_data["guest"])
        team_guest.save()

    match = Matches.get_or_none(Matches.external_match_id == json_data["id"])
    if match is None:
        match = Matches(sport_type=sport_type, tournament=tournament, parent_match_id=json_data["parent_match"],
                        external_match_id=json_data["id"], team_home=team_home, team_guest=team_guest,
                        start=int(json_data["date"] / 1000))
        match.save()

    try:
        with open(f'data/match/{json_data["id"]}.json') as file_handler:
            file_content = file_handler.read()
            json_data = json.loads(file_content)

        data_source = []

        for event in json_data["Event"]:
            for bet in event["Value"]:
                if not bet["B"]:
                    data_source.append({"match": match, "bet": json.dumps(bet)})

        if len(data_source) > 0:
            Bets.insert_many(data_source).execute()
            Matches.update(is_bet=1).where(Matches.id == match).execute()

    except Exception as e:
        logging.error('Error occurred ' + str(e))


credentials = pika.PlainCredentials("admin", "secret")
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host="192.168.1.71", port=5672, credentials=credentials))
channel = connection.channel()

channel.queue_declare(queue='matches')

channel.basic_consume(queue='matches', on_message_callback=callback, auto_ack=True)
channel.start_consuming()
