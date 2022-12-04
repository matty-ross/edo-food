import threading
from websocket_server.websocket_server import WebsocketServer


class WebsocketManager:

    IP = ""
    PORT = 8081


    def __init__(self):
        self.server = WebsocketServer(WebsocketManager.IP, WebsocketManager.PORT)
        self.run_thread = threading.Thread(target=WebsocketManager.run, args=(self,))
        self.server.set_fn_new_client(
            lambda client, _: print(f"nové pripojenie na WebSocket z {client['address'][0]}:{client['address'][1]}\n")
        )


    def start(self) -> None:
        self.run_thread.start()


    def shutdown(self) -> None:
        self.server.shutdown_gracefully()
        self.run_thread.join()


    def send_message(self, message: bytes) -> None:
        start = message.find(b"#")
        end = message.rfind(b"#")
        if start == -1 or end == -1:
            return
        message = message[start+1:end]
        self.server.send_message_to_all(message.decode())


    def run(self) -> None:
        try:
            self.server.run_forever()
        except:
            pass
        print("vlákno pre websocket server ukončené\n")