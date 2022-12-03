<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <link rel = "icon" type = "image/png" href = "assets/favicon.png">
    <title>projet SGBD</title>
    <?php
        include 'LaunchDB.php';
    ?>
</head>
<body>

    <div>
        <div class="loading-page isActive"></div>
        <div class="loading-motion isActive"></div>
    </div>

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

        <a class="logo" href="https://moodle.bordeaux-inp.fr/pluginfile.php/226190/mod_resource/content/2/projet_SGBD_jeux.pdf" style="height: 8vh; width: 9vw; cursor: pointer; position: absolute; left: 1vh; bottom: 1vh;">
            <img src="assets/favicon.png" style="height: 8vh; position: absolute;">
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 1.5vh; font-weight: 800; font-size: 3vh;">SGBD</div>
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 4.3vh; font-weight: 800; font-size: 2vh;">projet</div>
        </a>

        <a class="github-link" href="https://github.com/daJster/project_SGBD" title="Github">
        </a>

        <div class="blur-screen"></div>
    </div>
    
    <a class="logo" href="https://moodle.bordeaux-inp.fr/pluginfile.php/226190/mod_resource/content/2/projet_SGBD_jeux.pdf" style="height: 8vh; width: 9vw; margin-left: 10vh; cursor: pointer; position: absolute; left: 0;">
            <img src="assets/favicon.png" style="height: 8vh; position: absolute;">
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 1.5vh; font-weight: 800; font-size: 3vh;">SGBD</div>
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 4.3vh; font-weight: 800; font-size: 2vh;">projet</div>
    </a>

    <div class="pages">
        <div class="page-1">
            <div class="index-title-page">Jeux</div>
            <div class="paragraph slide">
                <div class="title">Présentation du projet</div>
                <div class="content">
                    Le but de ce projet est de mettre en œuvre les connaissances et les notions vues dans le module SGBD.
                    Le projet commence par une phase de modélisation des données (modèle conceptuel) et se poursuit par la création d'une 
                    base de données relationnelle et la réalisation d'un certain nombre de manipulations (Consutlation, Statistiques, Modification).<br><br>
                    Ce projet consistera en la réalisation d'une base de données gérant une communauté de joueurs de jeux de société ou de jeux de rôle.<br>
                    Chacun des joueurs a un pseudonyme, un nom et un prenom, et une adresse mail et des préférences de thèmes et mécaniques.<br>
                    Chaque jeu a un éditeur, des auteurs et des illustrateurs. Le jeu a une date de parution, et appartient a un type précis de jeu. Il a aussi des 
                    spécifités comme : Durée de jeu, Nombre de joueurs(2, 4, 6 ...), Mécaniques du jeu, Thème dont il appartient.
                    Le jeu peut être joué seul (stand-alone) comme il peut être une extension d'un autre jeu.<br>
                    Chaque joueur a le droit de noter une seule fois un jeu en lui donnant un commentaire et une appréciation entre 0 et 20, tout en indiquant les paramètres
                    qui a utilisé dans le jeu (les extensions, le nombre de joueur, configurations, ...).<br>
                    Chacun des joueurs a le droit de juger un commentaire qui n'est pas le sien.<br>
                </div>
            </div>
        </div>

        <div class="page-2">
            <div class="paragraph slide" style="text-align: center;">
                <div class="title" style="text-align: center;">Schéma conceptuel et relationel</div>
                <div class="content"></div>
                <div class="scheme-links">
                    <a class="scheme-link-one" href="./assets/scheme-concept.pdf">
                        <div class="scheme-concept title" style="color: whitesmoke; font-size: 5vh; text-align: center;">Conceptuel</div>
                        <img src="./assets/scheme-concept.png" style="height: 31vh; text-align: center;">
                    </a>

                    <a class="scheme-link-two" href="./assets/scheme-relation.pdf">
                        <div class="scheme-relation title" style="color: whitesmoke; font-size: 5vh; text-align: center;" >Relationel</div>
                        <img src="./assets/scheme-relation.png" style="height: 32vh; text-align: center;">
                    </a>
                </div>

            </div>
        </div>

        <div class="page-3">
            <div style="display:grid; grid-template-columns: auto; row-gap: 2vh; margin-top: 2vh;">
                <div class="paragraph special slide">
                    <a class="title" href="consult.php">Consultation</a>
                    <div class="content">
                        Aprés avoir stocké les informations cités dans le paragraphe précédent dans notre base de données, on veut
                        disposer des manipulations comme par exemple la consultation de la base de données.<br>
                        La page de consultation montre des informations sur les jeux, les joueurs, et les commentaires. En particulier on montre les cas suivants:<br>
                        La liste des jeux notés disponibles dans un thème choisit par l'utilisateur, cet ensemble est classés par mécaniques.<br>
                        La liste des commentaires se reférant à un jeu dans une des catégories (mécaniques) d'un joueur que l'utilisateur peut choisir.<br>
                        La liste des joueurs qui ont appréciés un commentaire choisit.<br>
                    </div>
                </div>
                
                <div class="paragraph special slide">
                    <a class="title" href="statistics.php">Statistiques</a>
                    <div class="content">
                        Dans cette partie on cherche plus à faire des calculs dans la base de données pour avoir une idée sur l'avis général d'un jeu
                        la moyenne des jeux qui ont été le plus appréciés, les commentaires les plus pertinent (calculs d'indice de confiance), et les commentaires les plus récents.<br>
                    </div>
                </div>
                
                <div class="paragraph special slide">
                    <a class="title" href="modify">Modifiation</a>
                    <div class="content">
                        La page de modification nous permet d'avoir une interface qui simplifie la modification de la base de données. On garantie l'ajout,
                        le suppression  et la modification d'un jeu, d'un joueur, ou d'un commentaire. La modification de ces trois ensembles nécéssite une
                        connaissance du nom du jeu (pour les jeux), le pseudonyme (pour les joueurs), l'ID (pour le commentaire).
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="main-text">
                Made with ❤️ by Jad 
            </div> 
            <div class="secondary-text">
                Website built using : Vanilla JS, CSS, HTML, PHP, SQL
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="app.js"></script>
</html>
