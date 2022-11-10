-- ============================================================
--   Nom de la base   :  Jeux                               
--   Nom de SGBD      :  MySQL Version ..                
--   Date de creation :  10/11/2022  12:47                       
-- ============================================================

drop table if exists JEUX                ; -- cascade constraints;
drop table if exists JOUEURS             ; -- cascade constraints;
drop table if exists NOTES               ; -- cascade constraints;
drop table if exists ROLES               ; -- cascade constraints;
drop table if exists EXTENSIONS          ; -- cascade constraints;
drop table if exists MECANIQUES          ; -- cascade constraints;
drop table if exists THEMES              ; -- cascade constraints;
drop table if exists CONTRIBUTEURS       ; -- cascade constraints;
drop table if exists JUGEMENTS           ; -- cascade constraints;
drop table if exists JEUX_MECANIQUES     ; -- cascade constraints;
drop table if exists JEUX_THEMES         ; -- cascade constraints;
drop table if exists JOUEURS_MECANIQUES  ; -- cascade constraints;
drop table if exists JOUEURS_THEMES      ; -- cascade constraints;
drop table if exists PARTICIPATIONS      ; -- cascade constraints;

-- ============================================================
--   Table : Jeux                                        
-- ============================================================
create table JEUX
(
    NOM_DU_JEU                   CHAR(20)              not null,
    EDITEUR                      CHAR(20),
    DATE_DE_PARUTION             DATE,
    DUREE                        INT(3),
    TYPE_DU_JEU                   CHAR(20),                       
    NOMBRE_DE_JOUEURS           INT(2),
    STAND_ALONE             BOOLEAN,
    constraint pk_jeu primary key (NOM_DU_JEU)
);

-- ============================================================
--   Table : Joueurs                                       
-- ============================================================
create table JOUEURS
(
    PSEUDONYME                      CHAR(20)              not null,
    NOM_JOUEUR                      CHAR(20)                       ,
    PRENOM_JOUEUR                   CHAR(20)                       ,
    ADDRESSE_MAIL                   CHAR(40)                       ,
    constraint pk_joueur primary key (PSEUDONYME)
);

-- ============================================================
--   Table : Notes                                              
-- ============================================================
create table NOTES
(
    ID_NOTE                         INT(3)              not null,
    COMMENTAIRE                     CHAR(50)               not null,
    DATE_NOTE                       DATE                           ,
    VALEUR                          INT(1)              not null,
    NOMBRE_DE_JOUEURS               INT(2)               not null,
    NOM_DU_JEU                      CHAR(20)                not null,
    PSEUDONYME                      CHAR(20)                not null,
    constraint pk_note primary key (ID_NOTE)
);

alter table NOTES
    add constraint fk1_note foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU),
    add constraint fk2_note foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME);


-- ============================================================
--   Table : Thèmes                                              
-- ============================================================
create table THEMES
(
    NOM_DU_THEME                   CHAR(20)              not null,
    constraint pk_theme primary key (NOM_DU_THEME)
);

-- ============================================================
--   Table : Mécaniques                                              
-- ============================================================
create table MECANIQUES
(
    NOM_MECANIQUES                   CHAR(20)              not null,
    constraint pk_mecanique primary key (NOM_MECANIQUES)
);

-- ============================================================
--   Table : Contributeurs                                              
-- ============================================================
create table CONTRIBUTEURS
(
    ID_CONTRIBUTEUR                   INT(2)              not null,
    NOM_CONTRIBUTEUR                  CHAR(20)                       ,
    PRENOM_CONTRIBUTEUR               CHAR(20)                        ,
    constraint pk_contributeur primary key (ID_CONTRIBUTEUR)
);

-- ============================================================
--   Table : Roles                                         
-- ============================================================
create table ROLES
(
    NOM_DU_JEU                        CHAR(20)              not null,
    ID_CONTRIBUTEUR                   INT(2)              not null,
    ROLE_CONTRIBUTEUR                 CHAR(20)                       ,
    constraint pk_role primary key (ID_CONTRIBUTEUR, NOM_DU_JEU)
);

alter table ROLES
    add constraint fk1_role foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU),
    add constraint fk2_role foreign key (ID_CONTRIBUTEUR)
       references CONTRIBUTEURS (ID_CONTRIBUTEUR);


-- ============================================================
--   Table : Jugements                                              
-- ============================================================
create table JUGEMENTS
(
    ID_NOTE                           INT(2)              not null,
    PSEUDONYME                        CHAR(20)              not null,
    ROLE_CONTRIBUTEUR                 CHAR(20)                       ,
    constraint pk_jugement primary key (PSEUDONYME, ID_NOTE)
);

alter table JUGEMENTS
    add constraint fk1_jugement foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_jugement foreign key (ID_NOTE)
       references NOTES (ID_NOTE);


-- ============================================================
--   Table : Participations                                              
-- ============================================================
create table PARTICIPATIONS
(
    NOM_DU_JEU                        CHAR(20)              not null,
    PSEUDONYME                        CHAR(20)              not null,
    constraint pk_participation primary key (PSEUDONYME, NOM_DU_JEU)
);

alter table PARTICIPATIONS
    add constraint fk1_participation foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_participation foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU);

-- ============================================================
--   Table : Extensions                                              
-- ============================================================
create table EXTENSIONS
(
    NOM_DU_JEU                        CHAR(20)              not null,
    NOM_EXTENSION                     CHAR(20)              not null,
    constraint pk_extension primary key (NOM_EXTENSION, NOM_DU_JEU)
);

alter table EXTENSIONS
    add constraint fk1_extension foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU),
    add constraint fk2_extension foreign key (NOM_EXTENSION)
       references JEUX (NOM_DU_JEU);

-- ============================================================
--   Table : Jeux_Themes                                           
-- ============================================================
create table JEUX_THEMES
(
    NOM_DU_JEU                       CHAR(20)              not null,
    NOM_DU_THEME                     CHAR(20)              not null,
    constraint pk_jeu_theme primary key (NOM_DU_THEME, NOM_DU_JEU)
);

alter table JEUX_THEMES
    add constraint fk1_jeu_theme foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU),
    add constraint fk2_jeu_theme foreign key (NOM_DU_THEME)
       references THEMES (NOM_DU_THEME);


-- ============================================================
--   Table : Jeux_Mecaniques                                           
-- ============================================================
create table JEUX_MECANIQUES
(
    NOM_DU_JEU                  CHAR(20)              not null,
    NOM_MECANIQUES              CHAR(20)              not null,
    constraint pk_jeu_mecanique primary key (NOM_MECANIQUES, NOM_DU_JEU)
);

alter table JEUX_MECANIQUES
    add constraint fk1_jeu_mecanique foreign key (NOM_DU_JEU)
       references JEUX (NOM_DU_JEU),
    add constraint fk2_jeu_mecanique foreign key (NOM_MECANIQUES)
       references MECANIQUES (NOM_MECANIQUES);

    
-- ============================================================
--   Table : Joueurs_Themes                                           
-- ============================================================
create table JOUEURS_THEMES
(
    PSEUDONYME                       CHAR(20)              not null,
    NOM_DU_THEME                     CHAR(20)              not null,
    constraint pk_joueur_theme primary key (NOM_DU_THEME, PSEUDONYME)
);

alter table JOUEURS_THEMES
    add constraint fk1_joueur_theme foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_joueur_theme foreign key (NOM_DU_THEME)
       references THEMES (NOM_DU_THEME);


-- ============================================================
--   Table : Joueurs_Mecaniques                                           
-- ============================================================
create table JOUEURS_MECANIQUES
(
    PSEUDONYME                  CHAR(20)              not null,
    NOM_MECANIQUES              CHAR(20)              not null,
    constraint pk_joueur_mecanique primary key (NOM_MECANIQUES, PSEUDONYME)
);

alter table JOUEURS_MECANIQUES
    add constraint fk1_joueur_mecanique foreign key (PSEUDONYME)
       references JOUEURS (PSEUDONYME),
    add constraint fk2_joueur_mecanique foreign key (NOM_MECANIQUES)
       references MECANIQUES (NOM_MECANIQUES);