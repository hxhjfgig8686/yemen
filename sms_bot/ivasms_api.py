# ivasms_api.py

import requests
import re
from config import IVASMS_LOGIN_URL, IVASMS_USERNAME, IVASMS_PASSWORD

session = requests.Session()


def extract_csrf(html):

    match = re.search(r'name="_token" value="(.*?)"', html)

    if match:
        return match.group(1)

    return None


def login():

    r = session.get(IVASMS_LOGIN_URL)

    token = extract_csrf(r.text)

    payload = {
        "email": IVASMS_USERNAME,
        "password": IVASMS_PASSWORD,
        "_token": token
    }

    session.post(IVASMS_LOGIN_URL, data=payload)


def fetch_messages():

    url = "https://ivas.tempnum.qzz.io/portal/sms/received/getsms"

    payload = {
        "draw": 1,
        "start": 0,
        "length": 10
    }

    r = session.post(url, data=payload)

    data = r.json()

    messages = []

    for item in data.get("data", []):

        messages.append({
            "id": item.get("id"),
            "number": item.get("number"),
            "text": item.get("sms")
        })

    return messages