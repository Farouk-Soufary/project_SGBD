from random import randint 

default = "insert into JOUEURS_MECANIQUES values ( "
end = ") ;"
number_notes = 50
mecaniques = open("src/shuf_mecaniques.txt", "r")
pseudo = open("src/pseudo.txt", "r")
db = open("sql/Joueurs_Mecaniques.sql", "a")
for i in  range(1, 50+1):
    m = "'"+str(mecaniques.readline()).replace("\n", "")+"'"
    p = "'"+str(pseudo.readline()).replace("\n", "")+"'"
    db.write(default+p+","+m+end+"\n")
mecaniques.close()
pseudo.close()
db.close()