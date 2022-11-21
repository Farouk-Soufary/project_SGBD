-- ============================================================
--   Nom de la base   :  Jeux                               
--   Nom de SGBD      :  MySQL Version ..                
--   Date de creation :  10/11/5022  12:47                       
-- ============================================================

-- @drop.sql

drop table if exists JEUX_MECANIQUES     ; 
drop table if exists JEUX_THEMES         ; 
drop table if exists JOUEURS_MECANIQUES  ; 
drop table if exists JOUEURS_THEMES      ; 
drop table if exists EXTENSIONS          ; 
drop table if exists MECANIQUES          ; 
drop table if exists THEMES              ; 
drop table if exists ROLES               ; 
drop table if exists CONTRIBUTEURS       ; 
drop table if exists JUGEMENTS           ; 
drop table if exists PARTICIPATIONS      ; 
drop table if exists NOTES               ; 
drop table if exists JEUX                ; 
drop table if exists JOUEURS             ; 

COMMIT;
-- ============================================================
--   Table : Jeux                                        
-- ============================================================
create table JEUX
(
    NOM_JEU                      CHAR(50)              not null ,
    EDITEUR                      CHAR(50)                       ,
    DATE_PARUTION                DATE                           ,
    DUREE                        INT(3)                         ,
    TYPE_JEU                     CHAR(50)                       ,                       
    NOMBRE_JOUEURS               INT(2)                         ,
    STAND_ALONE                  BOOLEAN                        ,
    constraint pk_jeu primary key (NOM_JEU)
);

COMMIT;

-- ============================================================
--   Table : Joueurs                                       
-- ============================================================
create table JOUEURS
(
    PSEUDONYME                      CHAR(50)              not null,
    NOM_JOUEUR                      CHAR(50)                      ,
    PRENOM_JOUEUR                   CHAR(50)                      ,
    ADRESSE_MAIL                   CHAR(40)                      ,
    constraint pk_joueur primary key (PSEUDONYME)
);


COMMIT;

-- ============================================================
--   Table : Notes                                              
-- ============================================================
create table NOTES
(
    ID_NOTE                         INT(3)               not null   ,
    COMMENTAIRE                     CHAR(50)                        ,
    DATE_NOTE                       DATE                            ,
    VALEUR                          INT(1)                          ,
    NOMBRE_JOUEURS                  INT(2)                          ,
    NOM_JEU                         CHAR(50)             not null   ,
    PSEUDONYME                      CHAR(50)             not null   ,
    constraint pk_note primary key (ID_NOTE)
);

alter table NOTES
    add constraint fk1_note foreign key (NOM_JEU)
       references JEUX (NOM_JEU),
    add constraint fk2_note foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME);

COMMIT;

-- ============================================================
--   Table : Thèmes                                              
-- ============================================================
create table THEMES
(
    NOM_THEME                   CHAR(50)              not null   ,
    constraint pk_theme primary key (NOM_THEME)
);

COMMIT;

-- ============================================================
--   Table : Mécaniques                                              
-- ============================================================
create table MECANIQUES
(
    NOM_MECANIQUES                   CHAR(50)              not null   ,
    constraint pk_mecanique primary key (NOM_MECANIQUES)
);

COMMIT;

-- ============================================================
--   Table : Contributeurs                                              
-- ============================================================
create table CONTRIBUTEURS
(
    ID_CONTRIBUTEUR                   INT(2)              not null  ,
    NOM_CONTRIBUTEUR                  CHAR(50)                      ,
    PRENOM_CONTRIBUTEUR               CHAR(50)                      ,
    constraint pk_contributeur primary key (ID_CONTRIBUTEUR)
);

COMMIT;

-- ============================================================
--   Table : Roles                                         
-- ============================================================
create table ROLES
(
    NOM_JEU                           CHAR(50)              ,
    ID_CONTRIBUTEUR                   INT(2)                ,
    ROLE_CONTRIBUTEUR                 CHAR(50)              ,
    constraint pk_role primary key (ID_CONTRIBUTEUR, NOM_JEU)
);

alter table ROLES
    add constraint fk1_role foreign key (NOM_JEU)
       references JEUX (NOM_JEU),
    add constraint fk2_role foreign key (ID_CONTRIBUTEUR)
       references CONTRIBUTEURS (ID_CONTRIBUTEUR);

COMMIT;

-- ============================================================
--   Table : Jugements                                              
-- ============================================================
create table JUGEMENTS
(
    ID_NOTE                           INT(2)                    ,
    PSEUDONYME                        CHAR(50)                  ,
    AVIS                              CHAR(50)                          ,
    constraint pk_jugement primary key (PSEUDONYME, ID_NOTE)
);

alter table JUGEMENTS
    add constraint fk1_jugement foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_jugement foreign key (ID_NOTE)
       references NOTES (ID_NOTE);

COMMIT;

-- ============================================================
--   Table : Participations                                              
-- ============================================================
create table PARTICIPATIONS
(
    NOM_JEU                           CHAR(50)                  ,
    PSEUDONYME                        CHAR(50)                  ,
    constraint pk_participation primary key (PSEUDONYME, NOM_JEU)
);

alter table PARTICIPATIONS
    add constraint fk1_participation foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_participation foreign key (NOM_JEU)
       references JEUX (NOM_JEU);

COMMIT;

-- ============================================================
--   Table : Extensions                                              
-- ============================================================
create table EXTENSIONS
(
    NOM_JEU                           CHAR(50)                  ,
    NOM_EXTENSION                     CHAR(50)                  ,
    constraint pk_extension primary key (NOM_EXTENSION, NOM_JEU)
);

alter table EXTENSIONS
    add constraint fk1_extension foreign key (NOM_JEU)
       references JEUX (NOM_JEU),
    add constraint fk2_extension foreign key (NOM_EXTENSION)
       references JEUX (NOM_JEU);

COMMIT;

-- ============================================================
--   Table : Jeux_Themes                                           
-- ============================================================
create table JEUX_THEMES
(
    NOM_JEU                       CHAR(50)                   ,
    NOM_THEME                     CHAR(50)                   ,
    constraint pk_jeu_theme primary key (NOM_THEME, NOM_JEU)
);

alter table JEUX_THEMES
    add constraint fk1_jeu_theme foreign key (NOM_JEU)
       references JEUX (NOM_JEU),
    add constraint fk2_jeu_theme foreign key (NOM_THEME)
       references THEMES (NOM_THEME);

COMMIT;


-- ============================================================
--   Table : Jeux_Mecaniques                                           
-- ============================================================
create table JEUX_MECANIQUES
(
    NOM_JEU                     CHAR(50)                ,
    NOM_MECANIQUES              CHAR(50)                ,
    constraint pk_jeu_mecanique primary key (NOM_MECANIQUES, NOM_JEU)
);

alter table JEUX_MECANIQUES
    add constraint fk1_jeu_mecanique foreign key (NOM_JEU)
       references JEUX (NOM_JEU),
    add constraint fk2_jeu_mecanique foreign key (NOM_MECANIQUES)
       references MECANIQUES (NOM_MECANIQUES);

COMMIT;

-- ============================================================
--   Table : Joueurs_Themes                                           
-- ============================================================
create table JOUEURS_THEMES
(
    PSEUDONYME                    CHAR(50)                   ,
    NOM_THEME                     CHAR(50)                   ,
    constraint pk_joueur_theme primary key (NOM_THEME, PSEUDONYME)
);

alter table JOUEURS_THEMES
    add constraint fk1_joueur_theme foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_joueur_theme foreign key (NOM_THEME)
       references THEMES (NOM_THEME);

COMMIT;

-- ============================================================
--   Table : Joueurs_Mecaniques                                           
-- ============================================================
create table JOUEURS_MECANIQUES
(
    PSEUDONYME                  CHAR(50)                    ,
    NOM_MECANIQUES              CHAR(50)                    ,
    constraint pk_joueur_mecanique primary key (NOM_MECANIQUES, PSEUDONYME)
);

alter table JOUEURS_MECANIQUES
    add constraint fk1_joueur_mecanique foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_joueur_mecanique foreign key (NOM_MECANIQUES)
       references MECANIQUES (NOM_MECANIQUES);

COMMIT;
