# main.py

import time
import json
import os

from config import CHECK_INTERVAL, SENT_MESSAGES_FILE
from ivasms_api import login, fetch_messages
from otp_utils import extract_otp, detect_service
from telegram_sender import send_message


def load_sent():

    if not os.path.exists(SENT_MESSAGES_FILE):
        return set()

    with open(SENT_MESSAGES_FILE) as f:
        return set(json.load(f))


def save_sent(data):

    with open(SENT_MESSAGES_FILE, "w") as f:
        json.dump(list(data)[-1000:], f)


def main():

    print("Logging in to iVasms...")
    login()

    sent_messages = load_sent()

    print("Bot started")

    while True:

        try:

            messages = fetch_messages()

            for msg in messages:

                msg_id = str(msg["id"])

                if msg_id in sent_messages:
                    continue

                number = msg["number"]
                text = msg["text"]

                otp = extract_otp(text)
                service = detect_service(text)

                message = f"""
📩 New SMS

📱 Number: {number}
🔑 OTP: {otp}
🧾 Service: {service}

💬 Message:
{text}
"""

                send_message(message)

                sent_messages.add(msg_id)

            save_sent(sent_messages)

        except Exception as e:

            print("Error:", e)

        time.sleep(CHECK_INTERVAL)


if __name__ == "__main__":
    main()