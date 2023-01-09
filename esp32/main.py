import json

from manager_wifi import ManagerWifi
from manager_lcd import ManagerLcd
from manager_server import ManagerServer


"""

{
    "orders": {
        "0": {
            "id": "2",
            "menu_item_id": "3",
            "timestamp": "2022-10-23 19:51:29",
            "menu_idem_date": "2022-10-23",
            "meal_id": "7",
            "meal_name": "Mix zeleninov\u00fd \u0161al\u00e1t, kuracie stripsy, BBQ dressing,  toust",
            "meal_price":" 5.00"
        },
        "1": {
            "id": "1",
            "menu_item_id": "1",
            "timestamp": "2022-10-23 19:51:26",
            "menu_idem_date": "2022-10-23",
            "meal_id": "1",
            "meal_name": "Hrachov\u00fd kr\u00e9m, klob\u00e1ska, 1 ks chlieb",
            "meal_price":
            "0.00"
        }
    }
}

"""


def parse_payload(payload: str) -> list:
    orders = json.loads(payload).get("orders")
    if not orders:
        return []
    return orders.values()


def main() -> None:
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
        manager_lcd.clear_display()
        orders = parse_payload(payload)
        for order in orders:
            row = order.get("id")
            menu_item_id = order.get("menu_item_id")
            meal_name = order.get("meal_name")
            manager_lcd.display_string_row_alignment(
                f"{menu_item_id}: {meal_name}", row, "l"
            )


if __name__ == "__main__":
    main()