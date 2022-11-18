<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <link rel = "icon" type = "image/png" href = "assets/favicon.png">
    <title>Database</title>
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

        <a class="logo" href="https://moodle.bordeaux-inp.fr/pluginfile.php/226190/mod_resource/content/2/projet_SGBD_jeux.pdf" style="height: 8vh; width: 9vw; cursor: pointer; position: absolute; left: 1vh; bottom: 1vh;">
            <img src="assets/favicon.png" style="height: 8vh; position: absolute;">
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 1.5vh; font-weight: 800; font-size: 3vh;">SGBD</div>
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 4.3vh; font-weight: 800; font-size: 2vh;">projet</div>
        </a>

        <a class="github-link" href="https://github.com/daJster/project_SGBD" title="Github">
        </a>

        <div class="blur-screen"></div>
    </div>
    
    <div class="pages db-page">
        <div class="page-1" style="z-index = 1;">
            <div>
            <button class="button-table isActive" style="left: 10vw; background-color: rgb(43, 122, 120);" onclick="showTable(1);" title="Joueurs">Joueurs</button>
            </div>
            
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">Prenom</th>
                            <th style="width:10%;">Nom </th>
                            <th style="width:10%;">Pseudonyme</th>
                            <th style="width:10%;">Email</th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM JOUEURS');
                        $rs->execute();
                        $players = $rs->fetchAll();
                        foreach ($players as $player) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $player['PRENOM_JOUEUR'];?></td >
                                    <td style="width:10%;"><?php echo $player['NOM_JOUEUR'];?></td >
                                    <td style="width:10%;"><?php echo $player['PSEUDONYME'];?></td >
                                    <td style="width:10%;"><?php echo $player['ADRESSE_MAIL'];?></td >
                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="page-2" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 21vw; background-color:  rgb(40, 54, 61);" onclick="showTable(2);" title="Joueurs">Jeux</button>
            </div>
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">Nom</th>
                            <th style="width:10%;">Editeur </th>
                            <th style="width:10%;">Date de parution</th>
                            <th style="width:10%;">Durée</th>
                            <th style="width:10%;">Type</th>
                            <th style="width:10%;">Nombre de joueurs</th>
                            <th style="width:10%;">Stand Alone</th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM JEUX');
                        $rs->execute();
                        $games = $rs->fetchAll();
                        foreach ($games as $game) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $game['EDITEUR'];?></td >
                                    <td style="width:10%;"><?php echo $game['NOM_JEU'];?></td >
                                    <td style="width:10%;"><?php echo $game['DATE_PARUTION'];?></td >
                                    <td style="width:10%;"><?php echo $game['DUREE'];?></td >
                                    <td style="width:10%;"><?php echo $game['TYPE_JEU'];?></td >
                                    <td style="width:10%;"><?php echo $game['NOMBRE_JOUEURS'];?></td >
                                    <td style="width:10%;"><?php echo $game['STAND_ALONE'];?></td >
                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="page-3" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 32vw; background-color:  rgb(118, 13, 34);" onclick="showTable(3);" title="Joueurs">Notes</button>
            </div>
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">ID</th>
                            <th style="width:10%;">Commentaire </th>
                            <th style="width:10%;">Date</th>
                            <th style="width:10%;">Valeur</th>
                            <th style="width:10%;">Nombre de joueurs</th>
                            <th style="width:10%;">Nom du jeu</th>
                            <th style="width:10%;">Pseudonyme</th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM NOTES');
                        $rs->execute();
                        $notes = $rs->fetchAll();
                        foreach ($notes as $note) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $note['ID_NOTE'];?></td >
                                    <td style="width:10%;"><?php echo $note['COMMENTAIRE'];?></td >
                                    <td style="width:10%;"><?php echo $note['DATE_NOTE'];?></td >
                                    <td style="width:10%;"><?php echo $note['VALEUR'];?></td >
                                    <td style="width:10%;"><?php echo $note['NOMBRE_JOUEURS'];?></td >
                                    <td style="width:10%;"><?php echo $note['NOM_JEU'];?></td >
                                    <td style="width:10%;"><?php echo $note['PSEUDONYME'];?></td >
                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="page-4" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 43vw; background-color:  olive;" onclick="showTable(4);" title="Joueurs">Mécaniques</button>
            </div>
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">Jeu</th>
                            <th style="width:10%;">Mécanique </th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM JEUX_MECANIQUES');
                        $rs->execute();
                        $mechanics = $rs->fetchAll();
                        foreach ($mechanics as $mechanic) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $mechanic['NOM_JEU'];?></td >
                                    <td style="width:10%;"><?php echo $mechanic['NOM_MECANIQUES'];?></td >
                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="page-5" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 54vw; background-color:  peru;" onclick="showTable(5);" title="Joueurs">Thèmes</button>
            </div>
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">Thèmes</th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM THEMES');
                        $rs->execute();
                        $themes = $rs->fetchAll();
                        foreach ($themes as $theme) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $theme['NOM_THEME'];?></td >                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="page-6" style="z-index = -1;">
            <div>
            <button class="button-table" style="left: 65vw; background-color:  rgb(0, 109, 109);" onclick="showTable(6);" title="Joueurs">Contributeurs</button>
            </div>
            <div class="consult-wrap" style="transform: translate(-30vw,-40vh); ">
                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                            <th style="width:10%;">ID</th>
                            <th style="width:10%;">Nom </th>
                            <th style="width:10%;">Prenom</th>
                        </tr>
                    </table>
                    <?php
                        $rs = $db->prepare('SELECT * FROM CONTRIBUTEURS');
                        $rs->execute();
                        $contributors = $rs->fetchAll();
                        foreach ($contributors as $contributor) {
                        ?>
                        <table style="width:100%;">
                                <tr>
                                    <td style="width:10%;"><?php echo $contributor['ID_CONTRIBUTEUR'];?></td >
                                    <td style="width:10%;"><?php echo $contributor['NOM_CONTRIBUTEUR'];?></td >
                                    <td style="width:10%;"><?php echo $contributor['PRENOM_CONTRIBUTEUR'];?></td >
                                    
                                </tr>
                    </table>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>

    </div>
</body>

<script type="text/javascript" src="app.js"></script>
</html>
