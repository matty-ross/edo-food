import time
import reader_manager


def main():
    rm = reader_manager.ReaderManager()
    rm.start()
    
    while True:
        try:
            time.sleep(1)
        except KeyboardInterrupt:
            break

    rm.shutdown()


if __name__ == "__main__":
    main()