from manager_wifi import ManagerWifi
from manager_lcd import ManagerLcd
from manager_server import ManagerServer


def main():
    manager_wifi = ManagerWifi()
    manager_lcd = ManagerLcd()
    manager_server = ManagerServer()
    
    manager_lcd.setup()
    
    manager_lcd.clear_display()
    manager_lcd.display_string_row_alignment("connecting to Wi-Fi", 1, "c")
    manager_wifi.connect()
    manager_wifi.wait_till_connected()
    manager_lcd.clear_display()
    manager_lcd.display_string_row_alignment("connected to Wi-Fi", 0, "c")
    manager_lcd.display_string_row_alignment(manager_wifi.get_status(), 1, "l")
    manager_lcd.display_string_row_alignment(manager_wifi.get_ifconfig("ip"), 3, "l")
    
    manager_lcd.clear_display()
    manager_lcd.display_string_row_alignment("connecting to server", 1, "c")
    manager_server.connect()
    manager_lcd.clear_display()
    manager_lcd.display_string_row_alignment("connected to server", 1, "c")
    
    while True:
        manager_lcd.clear_display()
        manager_lcd.display_string_row_alignment("cakam na cipnutie", 1, "c")
        payload = manager_server.recv_payload()


if __name__ == "__main__":
    main()