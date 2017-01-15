-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                      Oracle Version 9i
--                        (6/1/2017 11:55:00)
-- -----------------------------------------------------------------------------
--      Nom de la base : 
--      Projet : 
--      Auteur : Jeremy
--      Date de dernière modification : 6/1/2017 11:49:03
-- -----------------------------------------------------------------------------

DROP TABLE CONGES CASCADE CONSTRAINTS;

DROP TABLE STATUT CASCADE CONSTRAINTS;

DROP TABLE INDIVIDU CASCADE CONSTRAINTS;

DROP TABLE ADMINISTRATEUR CASCADE CONSTRAINTS;

DROP TABLE PAYS CASCADE CONSTRAINTS;

DROP TABLE FICHE_DE_PAIE CASCADE CONSTRAINTS;

-- -----------------------------------------------------------------------------
--       TABLE : CONGES
-- -----------------------------------------------------------------------------

CREATE TABLE CONGES
   (
    ID_CONGES NUMBER(2)  NOT NULL,
    ID_INDIVIDU NUMBER(2)  NOT NULL,
    DATE_DEBUT VARCHAR2(128)  NOT NULL,
    DATE_FIN VARCHAR2(128)  NOT NULL,
    VALIDITE NUMBER(2)  NOT NULL,
    NB_JOURS NUMBER(2)  NOT NULL
,   CONSTRAINT PK_CONGES PRIMARY KEY (ID_CONGES)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CONGES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CONGES_INDIVIDU
     ON CONGES (ID_INDIVIDU ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : STATUT
-- -----------------------------------------------------------------------------

CREATE TABLE STATUT
   (
    ID_STATUT NUMBER(2)  NOT NULL,
    NOM_STATUT CLOB  NOT NULL,
    TAUX_STATUT NUMBER  NOT NULL
,   CONSTRAINT PK_STATUT PRIMARY KEY (ID_STATUT)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : INDIVIDU
-- -----------------------------------------------------------------------------

CREATE TABLE INDIVIDU
   (
    ID_INDIVIDU NUMBER(2)  NOT NULL,
    ID_PAYS NUMBER(2)  NOT NULL,
    ID_STATUT NUMBER(2)  NOT NULL,
    NUM_INDIVIDU CLOB  NOT NULL,
    NOM_INDIVIDU CLOB  NOT NULL,
    PRENOM_INDIVIDU CLOB  NOT NULL,
    ADRESSE_INDIVIDU CLOB  NOT NULL,
    CP_INDIVIDU CLOB  NOT NULL,
    LOCALITE_INDIVIDU CLOB  NOT NULL,
    TEL_INDIVIDU CLOB  NOT NULL,
    NB_CONGES_INDIVIDU CHAR(32)  NOT NULL,
    LOGIN CLOB  NOT NULL,
    PASSWORD CLOB  NOT NULL,
    ANCIENNETE NUMBER(2)  NOT NULL
,   CONSTRAINT PK_INDIVIDU PRIMARY KEY (ID_INDIVIDU)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE INDIVIDU
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_INDIVIDU_PAYS
     ON INDIVIDU (ID_PAYS ASC)
    ;

CREATE  INDEX I_FK_INDIVIDU_STATUT
     ON INDIVIDU (ID_STATUT ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : ADMINISTRATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE ADMINISTRATEUR
   (
    ID_ADMIN NUMBER(2)  NOT NULL,
    LOGIN NUMBER(2)  NOT NULL,
    PASSWORD NUMBER(2)  NOT NULL,
    NOM_ADMIN CLOB  NOT NULL,
    PRENOM_ADMIN CLOB  NOT NULL
,   CONSTRAINT PK_ADMINISTRATEUR PRIMARY KEY (ID_ADMIN)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PAYS
-- -----------------------------------------------------------------------------

CREATE TABLE PAYS
   (
    ID_PAYS NUMBER(2)  NOT NULL,
    NOM_PAYS CLOB  NOT NULL
,   CONSTRAINT PK_PAYS PRIMARY KEY (ID_PAYS)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : FICHE_DE_PAIE
-- -----------------------------------------------------------------------------

CREATE TABLE FICHE_DE_PAIE
   (
    ID_FICHE NUMBER(2)  NOT NULL,
    ID_INDIVIDU NUMBER(2)  NOT NULL,
    BRUT_FICHE NUMBER  NOT NULL,
    NET_FICHE NUMBER  NOT NULL,
    DATE_DEBUT DATE  NOT NULL,
    DATE_FIN DATE  NOT NULL,
    HEURES_FICHES NUMBER(2)  NOT NULL
,   CONSTRAINT PK_FICHE_DE_PAIE PRIMARY KEY (ID_FICHE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE FICHE_DE_PAIE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_FICHE_DE_PAIE_INDIVIDU
     ON FICHE_DE_PAIE (ID_INDIVIDU ASC)
    ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE CONGES ADD (
     CONSTRAINT FK_CONGES_INDIVIDU
          FOREIGN KEY (ID_INDIVIDU)
               REFERENCES INDIVIDU (ID_INDIVIDU))   ;

ALTER TABLE INDIVIDU ADD (
     CONSTRAINT FK_INDIVIDU_PAYS
          FOREIGN KEY (ID_PAYS)
               REFERENCES PAYS (ID_PAYS))   ;

ALTER TABLE INDIVIDU ADD (
     CONSTRAINT FK_INDIVIDU_STATUT
          FOREIGN KEY (ID_STATUT)
               REFERENCES STATUT (ID_STATUT))   ;

ALTER TABLE FICHE_DE_PAIE ADD (
     CONSTRAINT FK_FICHE_DE_PAIE_INDIVIDU
          FOREIGN KEY (ID_INDIVIDU)
               REFERENCES INDIVIDU (ID_INDIVIDU))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------