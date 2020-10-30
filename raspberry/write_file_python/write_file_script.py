temp = [3, 5, 7, 12, 16, 20, 25, 28, 25, 19, 12, 6]
lenTemp = len(temp)
mes = ["jan", "feb", "marc","abr", "may", "jun", "julh", "aug", "sept", "oct","nov","dez"]
lenMes = len(mes)


file=open("test.txt","w")
for i in range(lenTemp):
    m = mes[i]
    file.write(str(m)+ ";")
    t=temp[i]
    file.write(str(t)+ "\n")

file.close()


    
