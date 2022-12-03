-- ============================================================
--  Vous trouverez dans ce fichier les requêtes SQL qui sont 
--  utilisées pour la consutlation de la base de données                            
-- ============================================================


-- ============================================================
-- Jeux critiqués disponible dans un thème précis (classés par Mécaniques)
    SELECT DISTINCT J.* from JEUX J
    inner join NOTES N
    on J.NOM_JEU = N.NOM_JEU
    inner join JEUX_THEMES JT
    on J.NOM_JEU = JT.NOM_JEU
    inner join JEUX_MECANIQUES JM
    on J.NOM_JEU = JM.NOM_JEU
    where JT.NOM_THEME = 'Horreur'  -- ici on mettra le thème choisi par l'utilisateur
    order by JM.NOM_MECANIQUES ;
-- ============================================================


-- ============================================================
-- Joueurs qui ont appréciés le commentaire ID
    SELECT * FROM NOTES N, JUGEMENTS J
    WHERE J.AVIS = 'PERTINENT' -- pour avoir les joueurs qui n'ont pas apprécier le commentaire on met 'IMPERTINENT'
    AND J.ID_NOTE = 3 -- ici on mettra l'ID du commentaire qu'on veut choisir
    AND N.ID_NOTE = 3 ;
-- ============================================================


-- ============================================================
-- Commentaires d'un des jeux préférés d'un joueur précis
    SELECT distinct J.* from (JEUX J
    inner join JEUX_MECANIQUES JM
    on JM.NOM_JEU = J.NOM_JEU)
    inner join JOUEURS_MECANIQUES JOM
    on JOM.NOM_MECANIQUES = JM.NOM_MECANIQUES
    where JOM.PSEUDONYME = '1john' -- ici on mettra le pseudonyme du joueur qu'on choisi
    AND J.NOM_JEU = 'Gloomhaven' ;  -- ici on mettra un des jeux préféré (obligatoire) du joueur qu'on a choisi
-- ============================================================

