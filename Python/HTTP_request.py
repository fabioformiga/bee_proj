# ----------------------------------------
#---efetua um request HTTP à gateway LoRa da internet 
#----------------------------------------
#requerid imports
import time
import requests
import re
import mysql.connector
import datetime

#conection to the database
mydb = mysql.connector.connect(
  host="127.0.0.1",
  user="root",
  passwd="pt123PT#",
  database="beeproject_db"
)

mycursor = mydb.cursor()

while True:
	r = requests.get('http://192.168.1.10/valor')
	data =r.json

	#data = "1 10 20 18"

	data_split = data.split(" ")

	id_hive = data_split[0]
	temperatura = data_split[1]
	humidade = data_split[2]
	peso = data_split[3]
	
	for tmp in range(1, 3):
		if tmp == 1:
			type_measure = "temperature"
			measure_value = temperatura
			now = datetime.datetime.now()
			date_measure = (str(now.year) + "-" + str(now.month) + "-" + str(now.day) + " " + str(now.hour) + ":" + str(now.minute) + ":" + str(now.second))
			sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive) VALUES (%s, %s, %s,%s)"
			val = (type_measure, measure_value, date_measure, id_hive)
			mycursor.execute(sql, val)
			mydb.commit()
			print(mycursor.rowcount, "record temperature inserted.")
		if tmp == 2:	
			type_measure = "humidity"
			measure_value = humidade
			now = datetime.datetime.now()
			date_measure = (str(now.year) + "-" + str(now.month) + "-" + str(now.day) + " " + str(now.hour) + ":" + str(now.minute) + ":" + str(now.second))
			sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive) VALUES (%s, %s, %s,%s)"
			val = (type_measure, measure_value, date_measure, id_hive)
			mycursor.execute(sql, val)
			mydb.commit()
			print(mycursor.rowcount, "record humidity inserted.")
		if tmp == 2:	
			type_measure = "weight"
			measure_value = peso
			now = datetime.datetime.now()
			date_measure = (str(now.year) + "-" + str(now.month) + "-" + str(now.day) + " " + str(now.hour) + ":" + str(now.minute) + ":" + str(now.second))
			sql = "INSERT INTO tmp_measure (type_measure, measure_value, date_measure, id_hive) VALUES (%s, %s, %s,%s)"
			val = (type_measure, measure_value, date_measure, id_hive)
			mycursor.execute(sql, val)
			mydb.commit()
			print(mycursor.rowcount, "record weight inserted.")
	print("---------------------------------------")
	time.sleep(10)
			
		
