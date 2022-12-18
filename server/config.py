# logovanie
LOG_DIR = "./logs/"

# sockety
SOCKET_ACCEPT_CONNECTION_TIMEOUT = 2 # sekundy
SOCKET_RECV_PAYLOAD_TIMEOUT = 2 # sekundy
SOCKET_MAX_PAYLOAD_SIZE = 1024 # bajty

# čítačky
READER_PAYLOAD_PREFIX = b"#"
READER_PAYLOAD_POSTFIX = b"#"
READER_WEB_APP_HOST = "" # "" znamená všetky adaptéry
READER_WEB_APP_PORT = 8080
READER_ESP32_APP_HOST = "" # "" znamená všetky adaptéry
READER_ESP32_APP_PORT = 8082

# aplikácie
WEB_APP_WEBSOCKET_HOST = "" # "" znamená všetky adaptéry
WEB_APP_WEBSOCKET_PORT = 8081
WEB_APP_GET_ORDERS_URL = "http://localhost/api/menu/get-orders.php"
ESP32_APP_HOST = "" # "" znamená všetky adaptéry
ESP32_APP_PORT = 8083