import paho.mqtt.client as mqtt
import time
Connected = False   #global variable for the state of the connection

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
client.connect("localhost", 1883) 
client.loop_start() 

time.sleep(0.5) #aguarda pela conexao
 
try:
    while True:
        value = raw_input('Enter the message:')
        client.publish("esp8266",value)
 
except KeyboardInterrupt:
 
    client.disconnect()
    client.loop_stop()
  
