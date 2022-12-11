import socket
import threading

import config


class ReaderHandler:

    def __init__(self, ip: str, port: int):
        self.socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM, socket.IPPROTO_TCP)
        self.ip = ip
        self.port = port
        self.client_socket = None
        self.client_ip = None
        self.client_port = None
        self.handle_thread = threading.Thread(target=ReaderHandler.handle_thread_fn, args=(self,))
        self.running = False


    def __del__(self):
        if self.running:
            self.stop()


    def start(self) -> None:
        self.running = True
        self.socket.bind((self.ip, self.port))
        self.socket.listen()
        self.handle_thread.start()

    
    def stop(self) -> None:
        self.running = False
        self.handle_thread.join()
        if self.client_socket:
            self.client_socket.close()
        self.socket.close()


    def on_client_connected(self) -> None:
        # TODO: implementované v triede, ktorá zdedí tento interface
        pass


    def on_payload_received(self, payload: bytes) -> None:
        # TODO: implementované v triede, ktorá zdedí tento interface
        pass


    def on_handling_stopped(self) -> None:
        # TODO: implementované v triede, ktorá zdedí tento interface
        pass


    def handle_thread_fn(self) -> None:
        while self.running:
            try:
                self.socket.settimeout(config.READER_ACCEPT_CONNECTION_TIMEOUT)
                client_socket, (client_ip, client_port) = self.socket.accept()
                break
            except socket.timeout:
                continue
        if self.running:
            self.client_socket = client_socket
            self.client_ip = client_ip
            self.client_port = client_port
            self.on_client_connected()
        while self.running:
            try:
                self.client_socket.settimeout(config.READER_RECEIVE_PAYLOAD_TIMEOUT)
                payload = self.client_socket.recv(config.READER_MAX_PAYLOAD_SIZE)
                if not payload:
                    break
                self.on_payload_received(payload)
            except socket.timeout:
                continue
        if self.client_socket:
            self.on_handling_stopped()