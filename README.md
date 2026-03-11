# SMS API Server

爻賷乇賮乇 API 賱丕爻鬲賯亘丕賱 丕賱乇爻丕卅賱 丕賱賳氐賷丞 賵兀賰賵丕丿 丕賱鬲丨賯賯 (OTP)

## 馃殌 丕賱鬲孬亘賷鬲 丕賱爻乇賷毓

1. 丕乇賮毓 丕賱賲賱賮丕鬲 賱賱爻賷乇賮乇
2. 卮睾賱 `install.php`
3. 丕爻鬲禺丿賲 API Key 賱賱丕鬲氐丕賱

## 馃摗 賳賯丕胤 丕賱賳賴丕賷丞 (Endpoints)

| 丕賱賲爻丕乇 | 丕賱胤乇賷賯丞 | 丕賱賵氐賮 |
|--------|---------|-------|
| `/get_codes` | GET | 噩賱亘 丕賱兀賰賵丕丿 丕賱噩丿賷丿丞 |
| `/add_number` | POST | 廿囟丕賮丞 乇賯賲 噩丿賷丿 |
| `/delete_number` | POST | 丨匕賮 乇賯賲 |
| `/receive_sms` | POST | 丕爻鬲賯亘丕賱 乇爻丕賱丞 噩丿賷丿丞 |
| `/stats` | GET | 廿丨氐丕卅賷丕鬲 |

## 馃攽 丕賱鬲賵孬賷賯

丕爻鬲禺丿賲 Header: `X-API-Key: your-api-key`

## 馃惓 丕賱鬲卮睾賷賱 賲毓 Docker

```bash
docker build -t sms-api .
docker run -p 80:80 sms-api