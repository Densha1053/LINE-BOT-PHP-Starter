from flask import Flask
from flask import request

import requests
import json
import re

LINEBOT_API_EVENT ='https://trialbot-api.line.me/v1/events'
LINE_HEADERS = {
    'Content-type': 'application/json; charset=UTF-8',
    'X-Line-ChannelID':'1517779946', # Channel ID
    'X-Line-ChannelSecret':'0fcee9d249316119f6d98b361a420b90', # Channel secre
    'X-Line-Trusted-User-With-ACL':'c//eUJe6lMKtCicCrC9eCSE5pHZvRiCgavKE5bI6Jd8ujPcvCubtGWhUloHHixBOumFO6IRkKD+q9+AYcU/0tcylBJcaZpWUhotRTPJbQpLkjbzjjl8Q1UwTw60olaqh0fRR7qi3AEYzFej6zDDoyQdB04t89/1O/w1cDnyilFU=' # MID (of Channel)
}

def post_event( to, content):
    msg = {
        'to': [to],
        'toChannel': 1383378250, # Fixed  value
        'eventType': "138311608800106203", # Fixed value
        'content': content
    }
    r = requests.post(LINEBOT_API_EVENT, headers=LINE_HEADERS, data=json.dumps(msg))

def post_text( to, text ):
    content = {
        'contentType':1,
        'toType':1,
        'text':text,
    }
    post_event(to, content)


commands = (
    (re.compile('ラッシャー', 0), lambda x: 'テメエコノヤロウ'),
    (re.compile('ダンカン', 0), lambda x:'バカヤロコノヤロウ'),
)

app = Flask(__name__)

@app.route("/callback", methods=['POST'])
def hello():
    msgs = request.json['result']
    for msg in msgs:
        text = msg['content']['text']
        for matcher, action in commands:
            if matcher.search(text):
                response = action(text)
                break
        else:
            response = 'コマネチ'

        post_text(msg['content']['from'],response)

    return ''


if __name__ == "__main__":
    context = ('cert/server.pem', 'cert/privkey.pem')
    app.run(host='0.0.0.0', port=443, ssl_context=context, threaded=True, debug=True)