
default = "insert into JOUEURS values ( "
end = ") ;"
number_players = 50
nom = open("src/nom.txt", "r")
prenom = open("src/prenom.txt", "r")
db = open("sql/Joueurs.sql", "a")
for i in  range(1, number_players+1):
    n = str(nom.readline()).replace("\n", "")
    p = str(prenom.readline()).replace("\n", "")
    pseudo = "'"+str(i)+p+"'"
    email = "'"+n.lower()+str(i)+"@gmail.com"+"'"
    db.write(default+pseudo+", '"+n+"', '"+p+"', "+email+end+"\n")
nom.close()
prenom.close()
db.close()
