import random

default = "insert into PARTICIPATIONS values ( "
end = " );"
nb_pseudos = 50
nb_games = 50

print("--PARTICIPATIONS")
game_names = open("src/game_names.txt", "r")
nb_players = open("src/nb_players.txt","r")
pseudos = open("src/pseudo.txt","r")

P = []
for k in range(nb_pseudos):
    P.append(str(pseudos.readline()).replace("\n",""))
random.shuffle(P)

for i in range(1,nb_games):
    game = "'" + str(game_names.readline()).replace("\n","") + "'"
    nbp = str(nb_players.readline()).replace("\n","")
    players = []
    for j in range(int(nbp)):
        player = "'" + str(P[random.randint(0,len(P)-1)]) + "'"
        if (player not in players):
            players.append(player)
    for p in players:
        print(default + game + ", " + p + end)
    
