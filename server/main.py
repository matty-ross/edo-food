import time

from reader_web_app import ReaderWebApp


def main():
    reader_web_app = ReaderWebApp()
    reader_web_app.start()
    while True:
        try:
            time.sleep(1)
        except KeyboardInterrupt:
            break
    reader_web_app.stop()


if __name__ == "__main__":
    main()