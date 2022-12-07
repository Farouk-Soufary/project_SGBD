default = "insert into JEUX_THEMES values ( "
end = ") ;"
number_players = 50
themes = open("src/shuf_themes.txt", "r")
game = open("src/game_names.txt", "r")
jeuxt = open("sql/Jeux_themes.sql", "a")
for i in  range(1, number_players+1):
    g = "'"+str(game.readline()).replace("\n", "")+"'"
    t = "'"+str(themes.readline()).replace("\n", "")+"'"
    jeuxt.write(default+g+", "+t+end+"\n")
themes.close()
game.close()
jeuxt.close()
