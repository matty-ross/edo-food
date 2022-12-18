import config


def parse_reader_payload(payload: bytes) -> str:
    prefix = payload.find(config.READER_PAYLOAD_PREFIX)
    postfix = payload.rfind(config.READER_PAYLOAD_POSTFIX)
    if prefix == -1 and postfix == -1:
        return None
    message = payload[prefix+1:postfix]
    return message.decode()