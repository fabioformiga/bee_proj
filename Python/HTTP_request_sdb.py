# ----------------------------------------
#---efetua um request HTTP à gateway LoRa da internet 
#----------------------------------------
#requerid imports
import time
import requests
import re

#conection to the database

while True:
	r = requests.get('http://192.168.1.10/valor') #alterar para o endereço do GW internet local
	data =r.json
	#data = "1 10 20 18"
	data_split = data.split(" ")
	id_hive = data_split[0]
	temperatura = data_split[1]
	humidade = data_split[2]
	peso = data_split[3]
    print(id_hive + " " + temperatura + " " + humidade + " " + peso) 
	time.sleep(10)

