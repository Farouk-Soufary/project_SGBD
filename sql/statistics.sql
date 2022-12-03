-- ============================================================
--  Vous trouverez dans ce fichier les requêtes SQL qui sont 
--  utilisées pour les statistiques de la base de données                            
-- ============================================================


-- ============================================================
-- Les joueurs classés selon le nombre de jeux qu'ils ont notés
    SELECT COUNT(A.PSEUDONYME) NB, A.* 
    FROM (SELECT * FROM JOUEURS NATURAL JOIN NOTES) A
    GROUP BY A.PSEUDONYME
    ORDER BY NB DESC; -- NB est le nombre de commentaires noté par joueur
-- ============================================================


-- ============================================================
-- La liste des 5 commentaires les plus récents
    SELECT * FROM NOTES 
    ORDER BY NOTES.DATE_NOTE 
    DESC LIMIT 5; -- ce nombre peut être 5, 10, 15, ...
-- ============================================================


-- ============================================================
-- Le commentaire qui laisse le moins indifférent (celui qui a reçu le plus de jugement)
    SELECT * 
    FROM  NOTES 
    NATURAL JOIN (
        select count(*) NB, ID_NOTE from JUGEMENTS 
        GROUP BY JUGEMENTS.ID_NOTE ) A
    ORDER BY NB DESC; -- NB est le nombre de jugement par commentaire
-- ============================================================


-- ============================================================
-- Les commentaires classés selon leurs indice de confiance 
-- Rappel : l'indice de confiance est : (1 + c)/(1 + d) avec c et d, 
-- respectivement nombre d'appréciations positives et nombre d'appréciations négatives
    SELECT N.COMMENTAIRE, N.NOM_JEU, N.PSEUDONYME , 
    (1+count(CASE WHEN J.AVIS = 'PERTINENT' THEN 1 END))/ (1+count(CASE WHEN J.AVIS = 'IMPERTINENT' THEN 1 END)) INDICE from NOTES N
    inner join JUGEMENTS J
    ON N.ID_NOTE = J.ID_NOTE
    GROUP BY N.COMMENTAIRE
    ORDER BY INDICE DESC;
-- ============================================================


