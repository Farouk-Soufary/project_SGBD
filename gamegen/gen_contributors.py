import random

default = "insert into CONTRIBUTEURS values ( "
end = " );"
number_contributors = 100
contributor_list = open("src/contributors.txt", "r")
game_list = open("src/game_names.txt", "r")

ROLES = ['ILLUSTRATEUR','AUTEUR']

for i in  range(1,number_contributors):
    full_name = contributor_list.readline().replace("\n","")
    nom,prenom = full_name.split(" ")

    print(default + str(i) + ", " + "'" + nom +"'"+ ", " + "'" + prenom + "'" + end )

contributor_list.close()
default = "insert into ROLES values ( "
for i in  range(1,number_contributors//2,2):
    game = "'" + str(game_list.readline()).replace("\n","") + "'"
    role = "'" + str(ROLES[random.randint(0,len(ROLES)-1)]) + "'"
    print(default + game + ", " + str(i) + ", " + "'"+ ROLES[0] + "'" + end)
    print(default + game + ", " + str(i+50) + ", " + "'" + ROLES[1] + "'" + end)
game_list.close()