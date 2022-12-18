import time

from handler_web_app import HandlerWebApp
from handler_esp32_app import HandlerEsp32App


def main():
    handler_web_app = HandlerWebApp()
    handler_esp32_app = HandlerEsp32App()
    handler_web_app.start_handling()
    handler_esp32_app.start_handling()
    while True:
        try:
            time.sleep(1)
        except KeyboardInterrupt:
            break
    handler_web_app.stop_handling()
    handler_esp32_app.stop_handling()


if __name__ == "__main__":
    main()