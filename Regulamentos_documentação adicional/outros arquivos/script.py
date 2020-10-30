#este script permite ver os dados provenientes do mqtt para o raspberry 
import paho.mqtt.client as mqtt
import time

def on_connect(client, userdata, flags, rc):
  print("Connected with result code " + str(rc)) 
  client.subscribe("esp8266") 

def on_message(client, userdata, msg):
  #print(msg.topic + " " + str(msg.payload)) 
  print(str(msg.payload)) 


client = mqtt.Client() 
client.on_connect = on_connect
client.on_message = on_message
client.username_pw_set("username","admin") 
client.connect("localhost", 1883, 60) 
client.loop_start() 
while 1:
  time.sleep(0.1)
