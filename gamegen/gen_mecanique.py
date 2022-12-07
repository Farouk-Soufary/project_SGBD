from random import randint 

default = "insert into MECANIQUES values ( "
end = ") ;"
number_notes = 50
mecaniques = open("src/mecaniques.txt", "r")
db = open("sql/Mecaniques.sql", "a")
for i in  range(1, 50+1):
    t = str(mecaniques.readline()).replace("\n", "")
    db.write(default+"'"+t+"' "+end+"\n")
mecaniques.close()
db.close()