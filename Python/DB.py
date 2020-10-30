import mysql.connector
import random 


mydb = mysql.connector.connect(
	host = "127.0.0.1",
	user = "root",
	passwd = "",
	database ="test2",
)
mycursor = mydb.cursor()
for x in range(20):
    y=random.randint(0,40)
    sql = "INSERT INTO graph (x,y) VALUES(%s, %s)"
    val = (x, y)
    mycursor.execute(sql, val)
    mydb.commit()
print(mycursor.rowcount, "records inserted.")
