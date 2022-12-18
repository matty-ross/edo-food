import socket
import threading

import config


class SocketPair:

    def __init__(self, server_host: str, server_port: int):
        self.server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM, socket.IPPROTO_TCP)
        self.server_host = server_host
        self.server_port = server_port
        self.client_socket = None
        self.client_host = None
        self.client_port = None
        self.handle_communication_thread = threading.Thread(target=SocketPair.handle_communication, args=(self,))
        self.handling = False
        self.on_client_connected = None
        self.on_payload_recv = None
        self.on_handling_stopped = None


    def __del__(self):
        if self.handling:
            self.stop_handling()


    def set_callback_functions(self, on_client_connected: callable, on_payload_recv: callable, on_handling_stopped: callable) -> None:
        self.on_client_connected = on_client_connected
        self.on_payload_recv = on_payload_recv
        self.on_handling_stopped = on_handling_stopped


    def start_handling(self) -> None:
        self.handling = True
        self.server_socket.bind((self.server_host, self.server_port))
        self.server_socket.listen()
        self.handle_communication_thread.start()


    def stop_handling(self) -> None:
        self.handling = False
        self.handle_communication_thread.join()
        if self.client_socket:
            self.client_socket.close()
        self.server_socket.close()


    def handle_communication(self) -> None:
        while self.handling:
            try:
                self.server_socket.settimeout(config.SOCKET_ACCEPT_CONNECTION_TIMEOUT)
                client_socket, (client_host, client_port) = self.server_socket.accept()
                break
            except socket.timeout:
                continue
        if self.handling:
            self.client_socket = client_socket
            self.client_host = client_host
            self.client_port = client_port
            if self.on_client_connected:
                self.on_client_connected()
        while self.handling:
            try:
                self.client_socket.settimeout(config.SOCKET_RECV_PAYLOAD_TIMEOUT)
                payload = self.client_socket.recv(config.SOCKET_MAX_PAYLOAD_SIZE)
                if not payload:
                    break
                if self.on_payload_recv:
                    self.on_payload_recv(payload)
            except socket.timeout:
                continue
        if self.client_socket and self.on_handling_stopped:
            self.on_handling_stopped()