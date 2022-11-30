default = "insert into EXTENSIONS values ( "
end = " );"
number_games = 50

print("--EXTENSIONS")

game_list = open("src/game_names.txt", "r")
for i in range(1,number_games):
    full_game_name = str(game_list.readline()).replace("\n","")
    if (":" in full_game_name):
        extension = full_game_name
        game = full_game_name.split(":")[0]
        print(default + "'" + game + "'" + ", " + "'" + extension + "'" + end)
game_list.close()