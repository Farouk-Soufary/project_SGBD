import random

default = "insert into JEUX values ( "
end = " );"
number_games = 50
game_name = open("src/game_names.txt", "r")
game_length = open("src/time.txt", "r")
creation_date = open("src/years.txt", "r")
editor = open("src/editors.txt","r")
nb_players = open("src/nb_players.txt","r")

TYPES = ['STRATEGY','RPG','ACTION','COOPERATION','CARD', 'SURVIVAL', 'COMPETITIVE','PLATFORM', 'PUZZLE', 'ARCADE']
print("--JEUX")


for i in  range(1,number_games):
    n = "'" + str(game_name.readline()).replace("\n","") + "'"
    e = "'" + str(editor.readline()).replace("\n","") + "'"
    cd = "'" + str(random.randint(1,26)) + "-" + str(random.randint(1,12)) + "-" + str(creation_date.readline()).replace("\n","") + "'"
    t = str(int(game_length.readline())).replace("\n","")
    g = "'" + TYPES[random.randint(0,len(TYPES)-1)] + "'"
    nb = str(nb_players.readline()).replace("\n","")
    s = str(random.randint(0,1))
    if (":" in n):
        s = str(0)
    else:
        s = str(1)
    print(default+ n +"," + e +"," + cd +"," + t +"," + g +"," + nb+ ","+  s + end)
game_name.close()
game_length.close()
creation_date.close()
editor.close()
