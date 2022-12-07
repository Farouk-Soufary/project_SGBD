prenom = open("prenom.txt", "r")
pseudonyme = open("pseudo.txt", "a")
for i in range(1, 50+1):
    p = str(i) + str(prenom.readline()).replace("\n","")
    pseudonyme.write(p+"\n")
pseudonyme.close()
prenom.close()