from random import randint 

default = "insert into THEMES values ( "
end = ") ;"
number_notes = 50
themes = open("src/themes.txt", "r")
db = open("sql/Themes.sql", "a")
for i in  range(1, 50+1):
    t = str(themes.readline()).replace("\n", "")
    db.write(default+"'"+t+"' "+end+"\n")
themes.close()
db.close()
