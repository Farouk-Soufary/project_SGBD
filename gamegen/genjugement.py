import random

default = "insert into JUGEMENTS values ( "
end = " );"
number_notes = 100
number_pseudos = 50

print("--JUGEMENTS")
AVIS = ['PERTINENT','IMPERTINENT']
ID_NOTES = random.sample(range(number_notes),number_notes)
pseudo_list = open("src/pseudo.txt", "r")
for i in range(1,number_pseudos):
    pseudo = str(pseudo_list.readline()).replace("\n","")
    for j in range(1,10):
        print(default + str(ID_NOTES[random.randint(0,len(ID_NOTES)-1)]) + ", "+ "'" + pseudo + "'"+ ", " + "'" + AVIS[random.randint(0,1)] + "'" + end)
pseudo_list.close()

    