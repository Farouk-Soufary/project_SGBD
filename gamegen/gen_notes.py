from random import randint 

default = "insert into NOTES values ( "
end = ") ;"
number_notes = 50
comments = open("src/shuf_commentaires.txt", "r")
prenom = open("src/prenom.txt", "r")
pseudo = open("src/shuf_pseudo.txt", "r")
game = open("src/shuf_game_names.txt", "r")
db = open("sql/Notes.sql", "a")
date = ["JAN", "FEV", "MAR", "AVR", "MAI", "JUIN"]
for i in  range(71, 100):
    c = str(comments.readline()).replace("\n", "")
    ID = str(i)
    D,M,Y = str(randint(1,21)), str(randint(1,12)),str(randint(2000,2022))
    date = "'"+Y+"-"+M+'-'+D+"'"
    valeur = str(randint(0,20))   
    num_joueurs = str(randint(1,30))
    pseudonyme = "'"+str(pseudo.readline().replace("\n",""))+"'"
    gname = str(game.readline()).replace("\n", "")
    db.write(default+ID+", "+"'"+c+"'"+", "+date+", "+valeur+", "+num_joueurs+", "+"'"+gname+"'"+", "+pseudonyme+end+"\n")
comments.close()
db.close()
