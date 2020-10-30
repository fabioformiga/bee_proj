
#requerid imports
import time
import mysql.connector
import datetime
import random 
from datetime import datetime
from datetime import timedelta
#conection to the database
mydb = mysql.connector.connect(
  host="127.0.0.1",
  user="admin",
  passwd="123qweasd",
  database="test"
)
i=0;
mycursor = mydb.cursor()
print("good connection")
now = datetime.now()
data_inicial = datetime(year=now.year-1, month=now.month, day=now.day)
data_hoje = datetime(year=now.year, month=now.month, day=now.day)
data_diff = data_hoje - data_inicial
colmeia = 1
for hour in range (0, data_diff.days*24): ## allow data introduction each hour
	data_temp =  data_inicial + timedelta(hours=hour)
	temperatura = random.randint(0,40)
	humidade = random.randint(0,90)
	peso = random.randint(0,30)
	horario = data_temp.time()
	data = data_temp.date()
	# print(colmeia, data, horario, temperatura, humidade, peso)
	sql = "INSERT INTO medida (id_colmeia, data, hora, temperatura, humidade, peso) VALUES (%s, %s, %s,%s, %s,%s)"
	val = (colmeia, data, horario, temperatura, humidade, peso)
	mycursor.execute(sql, val)
	mydb.commit()

print("all records inserted in db test table medida")
