import machine

import lcd_api
import i2c_lcd

import config


class ManagerLcd:
    
    def __init__(self):
        self.scl_pin = machine.Pin(config.PIN_SCL)
        self.sda_pin = machine.Pin(config.PIN_SDA)
        self.i2c = machine.I2C(0, scl=self.scl_pin, sda=self.sda_pin)
        self.lcd = None
    
    
    def setup(self):
        lcd_address = self.i2c.scan()[0]
        self.lcd = i2c_lcd.I2cLcd(self.i2c, lcd_address, config.LCD_ROWS, config.LCD_COLUMNS)
    
    
    def display_string_position(self, string, x, y):        
        self.lcd.move_to(x, y)
        self.lcd.putstr(string)
    
    
    def display_string_row_alignment(self, string, row, alignment):
        self.lcd.move_to(0, row)
        cols = config.LCD_COLUMNS
        if alignment == "l":
            string = f"{string :<{cols}}"
        elif alignment == "r":
            string = f"{string :>{cols}}"
        elif alignment == "c":
            string = f"{string :^{cols}}"
        self.lcd.putstr(string)
    
    
    def clear_display(self):
        self.lcd.clear()