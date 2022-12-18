import requests

import config
import utils
from socket_pair import SocketPair
from logger import Logger


class HandlerEsp32App():

    def __init__(self):
        self.reader_socket_pair = SocketPair(config.READER_ESP32_APP_HOST, config.READER_ESP32_APP_PORT)
        self.reader_socket_pair.set_callback_functions(
            lambda: self.on_reader_connected(),
            lambda payload: self.on_reader_payload_recv(payload),
            lambda: self.on_reader_handling_stopped()
        )
        self.esp32_socket_pair = SocketPair(config.ESP32_APP_HOST, config.ESP32_APP_PORT)
        self.esp32_socket_pair.set_callback_functions(
            lambda: self.on_esp32_connected(),
            lambda payload: self.on_esp32_payload_recv(payload),
            lambda: self.on_esp32_handling_stopped()
        )
        self.logger = Logger("Handler_ESP32_App")


    def start_handling(self) -> None:
        self.reader_socket_pair.start_handling()
        self.esp32_socket_pair.start_handling()


    def stop_handling(self) -> None:
        self.reader_socket_pair.stop_handling()
        self.esp32_socket_pair.stop_handling()


    def on_reader_connected(self) -> None:
        reader_host = self.reader_socket_pair.client_host
        reader_port = self.reader_socket_pair.client_port
        self.logger.log(f"reader connected -> {reader_host}:{reader_port}")


    def on_esp32_connected(self) -> None:
        esp32_host = self.esp32_socket_pair.client_host
        esp32_port = self.esp32_socket_pair.client_port
        self.logger.log(f"ESP32 connected -> {esp32_host}:{esp32_port}")


    def on_reader_payload_recv(self, payload: bytes) -> None:
        self.logger.log(f"reader payload received -> {payload}")
        user_id = utils.parse_reader_payload(payload)
        if user_id:
            response = get_orders_response(user_id)
            self.esp32_socket_pair.client_socket.send(response.encode())


    def on_esp32_payload_recv(self, payload: bytes) -> None:
        self.logger.log(f"ESP32 payload received -> {payload}")


    def on_reader_handling_stopped(self) -> None:
        reader_host = self.reader_socket_pair.client_host
        reader_port = self.reader_socket_pair.client_port
        self.logger.log(f"reader handling stopped -> {reader_host}:{reader_port}")


    def on_esp32_handling_stopped(self) -> None:
        esp32_host = self.esp32_socket_pair.client_host
        esp32_port = self.esp32_socket_pair.client_port
        self.logger.log(f"ESP32 handling stopped -> {esp32_host}:{esp32_port}")


    
def get_orders_response(user_id: int) -> str:
    response = requests.post(
        config.WEB_APP_GET_ORDERS_URL,
        json={
            "userId": user_id
        }
    )
    return response.text