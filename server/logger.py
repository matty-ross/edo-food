import datetime
import os

import config


class Logger:

    def __init__(self, prefix: str):
        self.prefix = prefix
        if not os.path.exists(config.LOG_DIR):
            os.mkdir(config.LOG_DIR)


    def log(self, message: str) -> None:
        timestamp = Logger.get_current_timestamp()
        file_name = f"{self.prefix}__{Logger.get_file_name()}"
        with open(f"{config.LOG_DIR}{file_name}", "a") as fp:
            fp.write(f"[{timestamp}]  {message}\n")


    @staticmethod
    def get_current_timestamp() -> str:
        now = datetime.datetime.now()
        return now.strftime("%d.%m.%Y %H:%M:%S")

    
    @staticmethod
    def get_file_name() -> str:
        now = datetime.datetime.now()
        return now.strftime("%d-%m-%Y.txt")