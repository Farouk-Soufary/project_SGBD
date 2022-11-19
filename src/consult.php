<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <link rel = "icon" type = "image/png" href = "assets/favicon.png">
    <title>Consultation</title>
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

        <a class="logo" href="https://moodle.bordeaux-inp.fr/pluginfile.php/226190/mod_resource/content/2/projet_SGBD_jeux.pdf" style="height: 8vh; width: 9vw; cursor: pointer; position: absolute; left: 1vh; bottom: 1vh;">
            <img src="assets/favicon.png" style="height: 8vh; position: absolute;">
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 1.5vh; font-weight: 800; font-size: 3vh;">SGBD</div>
            <div style="position: absolute; color: white; font-family: montserrat; left: 3.8vw; top: 4.3vh; font-weight: 800; font-size: 2vh;">projet</div>
        </a>

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
            <form action="" method="post">
		    <button class="test-bar" name=<?php echo $theme['NOM_THEME'];?> type="submit" ><?php echo $theme['NOM_THEME']; ?></button>
            </form>
		    <?php
		     }
		     ?>
                </div>

                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                                <th style="width:30%;">JEUX</th>
                        </tr>
                    </table>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                      $rs = $db->prepare('SELECT * FROM THEMES');
              		    $rs->execute();
              		    $themes = $rs->fetchAll();
              		    foreach ($themes as $theme) {
                        if (isset($_POST[$theme['NOM_THEME']])) {
                               $ttarget = $theme['NOM_THEME'];
                               $rs = $db->prepare('SELECT J.* from JEUX J
                               inner join NOTES N
                               on J.NOM_JEU = N.NOM_JEU
                               inner join JEUX_THEMES JT
                               on J.NOM_JEU = JT.NOM_JEU
                               inner join JEUX_MECANIQUES JM
                               on J.NOM_JEU = JM.NOM_JEU
                               where JT.NOM_THEME =:thetheme
                               order by JM.NOM_MECANIQUES');
                               $rs->bindParam('thetheme',$ttarget,PDO::PARAM_STR);
                               $rs->execute();
                               $games = $rs->fetchAll();
                               foreach ($games as $game) {
                               ?>
                               <table style="width:100%;">
                                        <tr>
                                            <td style="width:5%;"><?php echo $game['NOM_JEU'];?></td>
                                        </tr>
                            </table>
                               <?php
                                }
                        }
                    }
                  }
                    ?>
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
                <form  action="" method="post">
                <button class="test-bar" type=submit name=<?php echo $joueur['PSEUDONYME'];?> ><?php echo $joueur['PSEUDONYME']; ?></button>
                </form>
                <?php
                }
                ?>
              	</div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                  $rs = $db->prepare('SELECT * FROM JOUEURS');
                  $rs->execute();
                  $joueurs = $rs->fetchAll();
                  foreach($joueurs as $joueur){
                    if (isset($_POST[$joueur['PSEUDONYME']])) {
                      $player = $joueur['PSEUDONYME'];
                      $rs = $db->prepare('SELECT distinct J.* from JEUX J
                      inner join JEUX_MECANIQUES JM
                      on JM.NOM_JEU = J.NOM_JEU
                      inner join JOUEURS_MECANIQUES JOM
                      on JOM.NOM_MECANIQUES = JM.NOM_MECANIQUES
                      where JOM.PSEUDONYME =:playername');
                      $rs->bindParam('playername',$player,PDO::PARAM_STR);
                      $rs->execute();
                      $games = $rs->fetchAll();
                      foreach($games as $game){
                      ?>
                      <form  action="" method="post">
                      <button class="test-bar" type=submit name=<?php echo $game['NOM_JEU'];?> ><?php echo $game['NOM_JEU']; ?></button>
                      </form>
                      <?php
                      }
                    }

                  }?>


                  <div class="consult-grid" style="overflow-y: scroll;">
                  <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                          <tr>
                                  <th style="width:30%;">COMMENTS</th>
                          </tr>
                      </table>
                      <?php
                  if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    $rs = $db->prepare('SELECT * FROM JEUX');
                    $rs->execute();
                    $games = $rs->fetchAll();
                    foreach($games as $game){
                      if (isset($_POST[$game['NOM_JEU']])) {
                        $targetgame = $game['NOM_JEU'];
                        $rs = $db->prepare('SELECT distinct N.* from NOTES N
                        inner join JEUX J
                        on J.NOM_JEU = N.NOM_JEU
                        where J.NOM_JEU =:lejeu');
                        $rs->bindParam('lejeu',$targetgame,PDO::PARAM_STR);
                        $rs->execute();
                        $lesnotes = $rs->fetchAll();
                        foreach($lesnotes as $unenote){?>
                          <table style="width:100%;">
                                   <tr>
                                      <td style="width:5%;"><?php echo $unenote['COMMENTAIRE'];?></td>
                                   </tr>
                          </table>
                          <?php
                        }
                      }
                  }
                }
              }
                ?>
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
                    <form  action="" method="post">
                    <button class="test-bar" type=submit name="<?php echo $note['ID_NOTE']; ?>"><?php echo $note['ID_NOTE']; ?></button>
                    <?php
                    }
                    ?>
                </div>

                <div class="consult-grid" style="overflow-y: scroll;">
                <table style="width:100%; border-radius-bottom: 2vh; background-color: rgb(0,0,0,.2); box-shadow: 0 0 4vh .1vh rgb(0,0,0,.4);">
                        <tr>
                                <th style="width:13%;">Peudonyme</th>
                                <td style="width:22%;">Nom du jeu</td >
                                <td style="width:13%;">Avis</td >
                        </tr>
                    </table>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        $rs = $db->prepare('SELECT * FROM NOTES');
                        $rs->execute();
                        $notes = $rs->fetchAll();
                        foreach ($notes as $note) {
                            if (isset($_POST[$note['ID_NOTE']])) {
                                $id = $note['ID_NOTE'];
                                $rs = $db->prepare('SELECT * FROM NOTES N, JUGEMENTS J
                                                        WHERE J.AVIS =:avis
                                                        AND J.ID_NOTE=:note1
                                                        AND N.ID_NOTE=:note2');
                                $av = 'PERTINENT';
                                $rs->bindParam('avis',$av,PDO::PARAM_STR);
                                $rs->bindParam('note1',$id,PDO::PARAM_INT);
                                $rs->bindParam('note2',$id,PDO::PARAM_INT);
                                $rs->execute();
                                $rows = $rs->fetchAll();
                                foreach ($rows as $row) {
                                ?>
                                <table style="width:100%;">
                                        <tr>
                                            <td style="width:13%;"><?php echo $row['PSEUDONYME'];?></td >
                                            <td style="width:22%;"><?php echo $row['NOM_JEU'];?></td >
                                            <td style="width:13%;"><?php echo $row['AVIS'];?></td >
                                        </tr>
                            </table>
                                <?php
                                    }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="app.js"></script>
</html>
