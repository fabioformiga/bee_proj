import mysql.connector
from datetime import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="root",
  database="beeProject"
)

def location(i):
        switcher={
                0:'Castelo Branco',
                1:'Lisboa',
                2:'Porto',
                3:'Cuimbra',
                4:'Thursday',
                5:'Friday',
                6:'Saturday'
             }
        return switcher.get(i,"Invalid location")

f = open("weight.txt", "r")
mycursor = mydb.cursor()
if f.mode == 'r':
    contents = f.readlines()
for valuesRow in contents:
    valuesList = valuesRow.split(';')
    date_time_obj = datetime.strptime(valuesList[1], '%d/%m/%Y').strftime('%Y-%m-%d')
    sql = "INSERT IGNORE INTO Location (Id_location, name_location, Nb_hive) VALUES (%s, %s, %s)"
    val = (valuesList[2], location(valuesList[2]), '10')
    mycursor.execute(sql, val)
    sql = "INSERT IGNORE INTO Hive (reference_hive, nb_sensor, id_location) VALUES (%s, %s, %s)"
    val = (valuesList[3], '2', valuesList[2])
    mycursor.execute(sql, val)
    sql = "SELECT id_hive from Hive ORDER BY id_hive DESC LIMIT 1"
    mycursor.execute(sql)
    records = mycursor.fetchone()
    sql = "INSERT INTO Measure (sensor_type, date_measure, value_measure, id_hive) VALUES (%s, %s, %s, %s)"
    val = (valuesList[0], date_time_obj, valuesList[4], records[0])
    mycursor.execute(sql, val)
mydb.commit()   
f.close()
print(mycursor.rowcount, "record inserted.")

# mycursor = mydb.cursor()

# sql = "INSERT INTO customers (name, address) VALUES (%s, %s)"
# val = ("John", "Highway 21")
# mycursor.execute(sql, val)

# mydb.commit()

# print(mycursor.rowcount, "record inserted.")l