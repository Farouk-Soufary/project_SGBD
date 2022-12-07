from random import randint 

default = "insert into JOUEURS_THEMES values ( "
end = ") ;"
number_notes = 50
themes = open("src/shuf_themes.txt", "r")
pseudo = open("src/pseudo.txt", "r")
db = open("sql/joueurs_themes.sql", "a")
for i in  range(1, 50+1):
    t = "'"+str(themes.readline()).replace("\n", "")+"'"
    p = "'"+str(pseudo.readline()).replace("\n", "")+"'"
    db.write(default+p+", "+t+end+"\n")
themes.close()
pseudo.close()
db.close()
