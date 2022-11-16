<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <link rel = "icon" type = "image/png" href = "assets/favicon.png">
    <title>projet SGBD : Jeux</title>
    <style>
        html, body{
            overflow-y: hidden;
            scroll-behavior: smooth;
        }
    </style>
    <?php
      	$login = 'root';
        $db_pwd = '';
        $db = new PDO("mysql:host=127.0.0.1;dbname=mysql;charset=utf8mb4", $login, $db_pwd);
        if (!$db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $cr_query = file_get_contents('../sql/create.sql');
        $ins_query = file_get_contents('../sql/insert.sql');
        $drp_query = file_get_contents('../sql/drop.sql');
        // $result = mysqli_query($db, $cr_query);
        
        $result = $db->exec($cr_query.$ins_query);

       	$sql_q1 = "SELECT NOM_JEU, EDITEUR, DATE_PARUTION FROM JEUX";
        $result = $db->query($sql_q1); // doesn't work

        // while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     echo "NOM_JEU: \t" . $row["NOM_JEU"] . " - EDITEUR: \t" . $row["EDITEUR"] . " - DATE_PARUTION: \t" . $row["DATE_PARUTION"] . "<br>";
        // }

        $sql_q2 = "SELECT PSEUDONYME, NOM_JOUEUR, ADRESSE_MAIL FROM JOUEURS";
        $result = $db->query($sql_q2);

        // while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     echo "PSEUDONYME: \t" . $row["PSEUDONYME"] . " - NOM_JOUEUR: \t" . $row["NOM_JOUEUR"] . " - ADRESSE_MAIL: \t" . $row["ADRESSE_MAIL"] . "<br>";
        // }

        // $result = $db->exec($drp_query);
    ?>
</head>
<body>


    <div class="navbar" style="z-index: 7;">
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
    
    <div class="pages db-page">
        <div class="page-1" style="z-index = 1;">
            <div>
            <button class="button-table isActive" style="left: 10vw; background-color: rgb(43, 122, 120);" onclick="showTable(1);" title="Joueurs">Joueurs</button>
            </div>
        </div>

        <div class="page-2" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 21vw; background-color:  rgb(40, 54, 61);" onclick="showTable(2);" title="Joueurs">Jeux</button>
            </div>
        </div>

        <div class="page-3" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 32vw; background-color:  rgb(118, 13, 34);" onclick="showTable(3);" title="Joueurs">Notes</button>
            </div>
        </div>

        <div class="page-4" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 43vw; background-color:  olive;" onclick="showTable(4);" title="Joueurs">Mécaniques</button>
            </div>
        </div>

        <div class="page-5" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 54vw; background-color:  peru;" onclick="showTable(5);" title="Joueurs">Thèmes</button>
            </div>
        </div>

        <div class="page-6" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 65vw; background-color: rgb(43, 122, 120);" onclick="showTable(6);" title="Joueurs">Contributeurs</button>
            </div>
        </div>

    </div>
</body>

<script type="text/javascript" src="app.js"></script>
</html>
