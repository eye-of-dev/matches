import json
import re

import pika

with open('data/sport/1.json', encoding='utf-8') as file_handler:
    file_content = file_handler.read()
    json_data = json.loads(file_content)

credentials = pika.PlainCredentials("admin", "secret")
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host="192.168.1.71", port=5672, credentials=credentials))
channel = connection.channel()
channel.queue_declare(queue="matches")

for value in json_data["SS"]:

    for matches in value["CC"]:

        for match in matches["GG"]:
            date = re.search(r"\d+", match["S"])

            to_json = {"sport_type": value["N"], 'tournament': matches["N"], "parent_match": None, "id": match["I"],
                       "home": match["H"], "guest": match["A"], "date": int(date.group(0))}
            channel.basic_publish(exchange="", routing_key="matches", body=json.dumps(to_json))

            if "GG" in match.keys():
                for item in match["GG"]:
                    date = re.search(r"\d+", item["S"])
                    to_json = {"sport_type": value["N"], 'tournament': matches["N"], "parent_match": match["I"],
                               "id": item["I"], "home": item["H"], "guest": item["A"], "date": int(date.group(0))}
                    channel.basic_publish(exchange="", routing_key="matches", body=json.dumps(to_json))

connection.close()
