import mysql.connector

mydb = mysql.connector.connect(
  host="127.0.0.1",
  user="root",
  passwd="",
  database="test"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT DISTINCT id_colmeia FROM medida;")

myresult = mycursor.fetchall()

for x in myresult:
  print("colmeia" , x)
