from random import randint 

default = "insert into JEUX_MECANIQUES values ( "
end = ") ;"
number_notes = 50
mecaniques = open("src/mecaniques.txt", "r")
game = open("src/game_names.txt", "r")
db = open("sql/Jeux_Mecaniques.sql", "a")
for i in  range(1, 50+1):
    t = "'"+str(mecaniques.readline()).replace("\n", "")+"'"
    g = "'"+str(game.readline()).replace("\n", "")+"'"
    db.write(default+g+", "+t+end+"\n")
mecaniques.close()
game.close()
db.close()