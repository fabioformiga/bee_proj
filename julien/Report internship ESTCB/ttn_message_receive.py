# -*- coding: utf-8 -*-
"""
Created on Thu Dec 12 16:33:35 2019

@author: jujot
"""

import time
import ttn
import keyboard

app_id = "bee_project_app"
access_key = "ttn-account-v2.1cwLm25cobw4v4pHyHRGY4oocEmPELg_PZrIUl7wUwo"

def uplink_callback(msg, client):
  print("Received uplink from ", msg.dev_id)
  print(msg.payload_fields)

def printWelcomeMessage():
   print ("  _____________________________________________________  ")
   print (" |                                                     | ")
   print (" |  _                                 _           _    | ")
   print (" | | |                               (_)         | |   | ")
   print (" | | |__   ___  ___   _ __  _ __ ___  _  ___  ___| |_  | ")
   print (" | | '_ \ / _ \/ _ \ | '_ \| '__/ _ \| |/ _ \/ __| __| | ")
   print (" | | |_) |  __/  __/ | |_) | | | (_) | |  __/ (__| |_  | ")
   print (" | |_.__/ \___|\___| | .__/|_|  \___/| |\___|\___|\__| | ")
   print (" |                   | |            _/ |               | ")
   print (" |                   |_|           |__/                | ")
   print (" |                                                     | ")
   print (" |_____________________________________________________| ")
   print (" ")

printWelcomeMessage()
handler = ttn.HandlerClient(app_id, access_key)

# using mqtt client
mqtt_client = handler.data()
mqtt_client.set_uplink_callback(uplink_callback)
mqtt_client.connect()
print ('You are connected! Press touch "esc" if you want to quit the program')

keyboard.wait('esc')
print ('Programm stopping')
mqtt_client.close()
