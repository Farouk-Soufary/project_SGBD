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
            <div class="consult-title-page">Consultation</div>
            <div class="consult-wrap">
                <div class="title-grid">Jeux critiqués disponibles dans le thème 'THEME' (classés par mécaniques)</div>
                <button class="choose-button">Choix du thème</button>

                <div class="choose-bar">
		    <?php
		     $db = new PDO(
		     'mysql:host=localhost;dbname=mysql;charset=utf8',
		     'root',
		     ''
		     );
		    $rs = $db->prepare('SELECT * FROM THEMES');
		    $rs->execute();
		    $themes = $rs->fetchAll();
		    foreach ($themes as $theme) {
		    ?>
		    <button class="test-bar"><?php echo $theme['NOM_THEME']; ?></button>
		    <?php
		     }
		     ?>
                </div>

                <div class="consult-grid">

                </div>
            </div>
        </div>

        <div class="page-2">
            <div class="consult-wrap">
                <div class="title-grid">Commentaires d'un des jeux préférés du joueur 'PLAYER'</div>
                <button class="choose-button">Choix du joueur</button>
                
                <div class="choose-bar">
                <?php
		        $db = new PDO(
                'mysql:host=localhost;dbname=mysql;charset=utf8',
                'root',
                ''
                );
                $rs = $db->prepare('SELECT * FROM JOUEURS');
                $rs->execute();
                $joueurs = $rs->fetchAll();
                foreach ($joueurs as $joueur) {
                ?>
                <button class="test-bar"><?php echo $joueur['NOM_JOUEUR']; ?></button>
                <?php
                }
                ?>
              	</div>
                <div class="consult-grid">

                </div>
            </div>
        </div>

        <div class="page-3">
            <div class="consult-wrap">
                <div class="title-grid">Joueurs qui ont appréciés le commentaire 'ID' de 'PLAYER'</div>
                <button class="choose-button">Choix du commentaire</button>
                
                <div class="choose-bar">
                    <?php
                    $db = new PDO(
                    'mysql:host=localhost;dbname=mysql;charset=utf8',
                    'root',
                    ''
                    );
                    $rs = $db->prepare('SELECT * FROM NOTES');
                    $rs->execute();
                    $notes = $rs->fetchAll();
                    foreach ($notes as $note) {
                    ?>
                    <button class="test-bar"><?php echo $note['COMMENTAIRE']; ?></button>
                    <?php
                    }
                    ?>    
                </div>

                <div class="consult-grid">

                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="app.js"></script>
</html>
