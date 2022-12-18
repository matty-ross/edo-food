import threading

from websocket_server.websocket_server import WebsocketServer

import config
import utils
from socket_pair import SocketPair
from logger import Logger


class HandlerWebApp:

    def __init__(self):
        self.reader_socket_pair = SocketPair(config.READER_WEB_APP_HOST, config.READER_WEB_APP_PORT)
        self.reader_socket_pair.set_callback_functions(
            lambda: self.on_reader_connected(),
            lambda payload: self.on_reader_payload_recv(payload),
            lambda: self.on_reader_handling_stopped()
        )
        self.ws_server = WebsocketServer(config.WEB_APP_WEBSOCKET_HOST, config.WEB_APP_WEBSOCKET_PORT)
        self.ws_serve_thread = threading.Thread(target=HandlerWebApp.ws_serve, args=(self,))
        self.logger = Logger("Handler_Web_App")


    def start_handling(self) -> None:
        self.reader_socket_pair.start_handling()
        self.ws_serve_thread.start()


    def stop_handling(self) -> None:
        self.reader_socket_pair.stop_handling()
        self.ws_server.shutdown_gracefully()
        self.ws_serve_thread.join()


    def on_reader_connected(self) -> None:
        reader_host = self.reader_socket_pair.client_host
        reader_port = self.reader_socket_pair.client_port
        self.logger.log(f"reader connected -> {reader_host}:{reader_port}")


    def on_reader_payload_recv(self, payload: bytes) -> None:
        self.logger.log(f"reader payload received -> {payload}")
        user_id = utils.parse_reader_payload(payload)
        if user_id:
            self.ws_server.send_message_to_all(user_id)


    def on_reader_handling_stopped(self) -> None:
        reader_host = self.reader_socket_pair.client_host
        reader_port = self.reader_socket_pair.client_port
        self.logger.log(f"reader handling stopped -> {reader_host}:{reader_port}")


    def ws_serve(self) -> None:
        try:
            self.ws_server.serve_forever()
        except:
            pass