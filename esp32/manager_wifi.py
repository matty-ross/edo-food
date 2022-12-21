import network
import time

import config


class ManagerWifi:
    
    def __init__(self):
        self.sta_if = network.WLAN(network.STA_IF)
    
    
    def __del__(self):
        self.disconnect()
    
    
    def connect(self):
        if not self.sta_if.active():
            self.sta_if.active(True)
            self.sta_if.connect(config.WIFI_SSID, config.WIFI_PASSWORD)
    
    
    def disconnect(self):
        if self.sta_if.active():
            self.sta_if.disconnect()
            self.sta_if.active(False)
    
    
    def wait_till_connected(self):
        while not self.sta_if.isconnected():
            time.sleep(0.5)
    
    
    def get_status(self):
        status = self.sta_if.status()
        if status == network.STAT_IDLE:
            return "idle"
        if status == network.STAT_CONNECTING:
            return "connecting"
        if status == network.STAT_WRONG_PASSWORD:
            return "wrong password"
        if status == network.STAT_NO_AP_FOUND:
            return "no AP found"
        #if status == network.STAT_CONNECT_FAIL:
        #    return "connection failed"
        if status == network.STAT_GOT_IP:
            return "connection successful"
        return ""
    
    
    def get_ifconfig(self, param):
        ifconfig = self.sta_if.ifconfig()
        if param == "ip":
            return ifconfig[0]
        if param == "subnet":
            return ifconfig[1]
        if param == "gateway":
            return ifconfig[2]
        if param == "dns":
            return ifconfig[3]
        return ""