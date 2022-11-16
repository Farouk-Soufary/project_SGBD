<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <link rel = "icon" type = "image/png" href = "assets/favicon.png">
    <title>projet SGBD : Jeux</title>
</head>
<body>
    <div class="navbar">
        <div>
            <button class="menu-button" onclick="activateNavbar();" title="Menu"></button>
        </div>

        <div class="utilities-links">
            <div class="home-link">
                <a href="index.php" class="text-link">Accueil</a> 
            </div>

            <div class="consult-link">
                <a href="database.php" class="text-link">DataBase</a> 
            </div>
            
            <div class="consult-link">
                <a href="consult.php" class="text-link">Consulter</a> 
            </div>

            <div class="statistics-link">
                <a href="statistics.php" class="text-link">Statistiques</a> 
            </div>

            <div class="modify-link">
                <a href="modify.php" class="text-link">Modifier</a> 
            </div>

            <div class="about-link">
                <a href="about.php" class="text-link">À propos</a> 
            </div>

        </div>

        <a class="github-link" href="https://github.com/daJster/project_SGBD" title="Github">
        </a>
        
        <div class="blur-screen"></div>
    </div>

    <div class="pages">
        <div class="page-1">
            <div class="stats-title-page">Statistiques</div>
            <div class="stats-wrap">
                <div class="title-grid">Les joueurs classés selon le nombre de jeux qu'ils ont notés</div>
                <div class="stats-grid" style="margin-top: 6vh; border-radius: 2vh;" >

                </div>
            </div>
        </div>

        <div class="page-2">
            <div class="stats-wrap">
                <div class="title-grid">la liste des commentaires les plus récents</div>
                <button class="choose-button">Nombre de commentaires</button>

                <div class="choose-bar">
                    <button class="test-bar">5</button>
                    <button class="test-bar">10</button>
                    <button class="test-bar">15</button>
                    <button class="test-bar">20</button>
                </div>

                <div class="stats-grid">

                </div>
            </div>
        </div>

        <div class="page-3">
            <div class="stats-wrap">
                <div class="title-grid">Le commentaire qui laisse le moins indifférent <br> (celui qui a reçu le plus de jugement)</div>
                <div class="stats-grid" style="margin-top: 9vh; border-radius: 2vh;">

                </div>
            </div>
        </div>

        <div class="page-4">
            <div class="stats-wrap">
                <div class="title-grid">Les commentaires classés selon leurs indices de confiance</div>
                <div class="stats-grid" style="margin-top: 6vh; border-radius: 2vh;">

                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="app.js"></script>
</html>