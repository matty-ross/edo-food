import socket
import threading


class ReaderManager:

    IP = ""
    PORT = 8080
    TIMEOUT = 2 # seconds


    def __init__(self):
        self.server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM, socket.IPPROTO_TCP)
        self.accept_connections_thread = threading.Thread(target=ReaderManager.accept_connections, args=(self,))
        self.client_handler_threads = []
        self.on_payload_fn = None
        self.running = False


    def __del__(self):
        self.server_socket.close()


    def start(self) -> None:
        self.server_socket.bind((ReaderManager.IP, ReaderManager.PORT))
        self.server_socket.listen()
        self.running = True
        self.accept_connections_thread.start()


    def shutdown(self) -> None:
        self.running = False
        self.accept_connections_thread.join()
        for client_handler_thread in self.client_handler_threads:
            client_handler_thread.join()


    def set_on_payload_fn(self, on_payload_fn: callable) -> None:
        self.on_payload_fn = on_payload_fn


    def accept_connections(self) -> None:
        while self.running:
            self.server_socket.settimeout(ReaderManager.TIMEOUT)
            try:
                client_socket, (ip, port) = self.server_socket.accept()
            except socket.timeout:
                continue
            client_handler_thread = threading.Thread(target=ReaderManager.client_handler, args=(self, client_socket, ip, port))
            self.client_handler_threads.append(client_handler_thread)
            client_handler_thread.start()
        print("vlákno pre príjmanie nových pripojení ukončené\n")


    def client_handler(self, client_socket: socket.socket, ip: str, port: int) -> None:
        print(f"nové pripojenie z {ip}:{port}\n")
        while self.running:
            client_socket.settimeout(ReaderManager.TIMEOUT)
            try:
                payload = client_socket.recv(1024)
                if not payload:
                    break
            except socket.timeout:
                continue
            if self.on_payload_fn:
                self.on_payload_fn(payload)
        print(f"vlákno pre klienta {ip}:{port} ukončené\n")