import json
import logging
import re

import pika
import yaml

with open("config.yaml") as file_handler:
    try:
        config = yaml.load(file_handler, Loader=yaml.FullLoader)
    except yaml.YAMLError as e:
        logging.error("Can't load config file " + str(e))

PARSE_FILES = ["data/sport/1.json", "data/sport/2.json", "data/sport/3.json", "data/sport/4.json", "data/sport/5.json",
               "data/sport/8.json"]

credentials = pika.PlainCredentials(config["rabbit"]["user"], config["rabbit"]["password"])
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host=config["rabbit"]["host"], port=config["rabbit"]["port"], credentials=credentials))
channel = connection.channel()
channel.queue_declare(queue=config["rabbit"]["queue"])

for file in PARSE_FILES:
    with open(file, encoding="utf-8") as file_handler:
        file_content = file_handler.read()
        json_data = json.loads(file_content)

    for value in json_data["SS"]:

        for matches in value["CC"]:

            for match in matches["GG"]:

                if not match["HI"] or not match["AI"]:
                    continue

                date = re.search(r"\d+", match["S"])

                to_json = {"sport_type": value["N"], "tournament": matches["N"], "parent_match": None, "id": match["I"],
                           "home": match["H"], "home_id": match["HI"], "guest": match["A"], "guest_id": match["AI"],
                           "date": int(date.group(0))}

                if "GG" in match.keys():
                    gg_matches, spam = [], []
                    for item in match["GG"]:
                        gg_matches.append(item["I"])
                        if len(spam) == 0:
                            spam.append(item)
                        else:
                            for i in spam:
                                if i["A"] != item["A"] and i["H"] != item["H"] and i["S"] != item["S"]:
                                    spam.append(item)

                    to_json["gg_matches"] = gg_matches
                    channel.basic_publish(exchange="", routing_key=config["rabbit"]["queue"], body=json.dumps(to_json))

                    for item in spam:
                        date = re.search(r"\d+", item["S"])

                        to_json = {"sport_type": value["N"], "tournament": matches["N"], "parent_match": match["I"],
                                   "id": item["I"], "home": item["H"], "home_id": item["HI"], "guest": item["A"],
                                   "guest_id": item["AI"], "date": int(date.group(0)), "gg_matches": []}

                        channel.basic_publish(exchange="", routing_key=config["rabbit"]["queue"],
                                              body=json.dumps(to_json))
                else:
                    channel.basic_publish(exchange="", routing_key=config["rabbit"]["queue"], body=json.dumps(to_json))

connection.close()
