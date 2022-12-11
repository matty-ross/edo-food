import threading

from websocket_server.websocket_server import WebsocketServer

import config
from reader_handler import ReaderHandler


class ReaderWebApp(ReaderHandler):

    def __init__(self):
        super().__init__(config.READER_WEB_APP_HOST, config.READER_WEB_APP_PORT)
        self.ws_server = WebsocketServer(config.WEBSOCKET_WEB_APP_HOST, config.WEBSOCKET_WEB_APP_PORT)
        self.ws_serve_thread = threading.Thread(target=ReaderWebApp.ws_serve_thread_fn, args=(self,))


    def __del__(self):
        self.stop()
        super().__del__()


    def start(self) -> None:
        super().start()
        self.ws_serve_thread.start()


    def stop(self) -> None:
        self.ws_server.shutdown_gracefully()
        self.ws_serve_thread.join()
        super().stop()


    def on_client_connected(self) -> None:
        print(f"new connection from {self.client_ip}:{self.client_port}")


    def on_payload_received(self, payload: bytes) -> None:
        print(payload)
        message = parse_payload(payload)
        if message:
            self.ws_server.send_message_to_all(message)


    def on_handling_stopped(self) -> None:
        print(f"goodbye from {self.client_ip}:{self.client_port}")


    def ws_serve_thread_fn(self) -> None:
        try:
            self.ws_server.serve_forever()
        except:
            pass


def parse_payload(payload: bytes) -> str:
    prefix = payload.find(config.READER_PAYLOAD_PREFIX)
    postfix = payload.rfind(config.READER_PAYLOAD_POSTFIX)
    if prefix == -1 and postfix == -1:
        return None
    message = payload[prefix+1:postfix]
    return message.decode()