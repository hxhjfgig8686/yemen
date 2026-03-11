# otp_utils.py

import re


def extract_otp(text: str):
    match = re.search(r"\b\d{4,8}\b", text)
    if match:
        return match.group()
    return None


def detect_service(text: str):
    text = text.lower()

    if "whatsapp" in text:
        return "WhatsApp"

    if "facebook" in text:
        return "Facebook"

    if "telegram" in text:
        return "Telegram"

    if "google" in text:
        return "Google"

    return "Unknown"