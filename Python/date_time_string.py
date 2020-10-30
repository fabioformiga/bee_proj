import datetime
#__________________
now = datetime.datetime.now()
date_measure = (str(now.year) + "-" + str(now.month) + "-" + str(now.day) + " " + str(now.hour) + ":" + str(now.minute) + ":" + str(now.second))
print(date_measure)
