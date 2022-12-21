import socket

import config


class ManagerServer:
    
    def __init__(self):
        self.socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM, socket.IPPROTO_TCP)
    
    
    def __del__(self):
        self.socket.close()
    
    
    def connect(self):
        self.socket.connect((config.SERVER_HOST, config.SERVER_PORT))
    
    
    def recv_payload(self):
        payload = self.socket.recv(config.SERVER_MAX_PAYLOAD_SIZE)
        if not payload:
            payload = b""
        return payload.decode()