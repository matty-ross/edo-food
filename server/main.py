import websocket_manager
import reader_manager


def main():
    wsm = websocket_manager.WebsocketManager()
    rm = reader_manager.ReaderManager()

    def on_msg(message):
        wsm.send_message(message)

    rm.set_on_payload_fn(on_msg)
    
    wsm.start()
    rm.start()
    
    while True:
        cmd = input()
        if cmd == "$exit":
            break

    rm.shutdown()
    wsm.shutdown()


if __name__ == "__main__":
    main()