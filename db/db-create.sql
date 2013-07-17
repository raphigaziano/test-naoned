-- 2013-07-16
-- Script de création de la base nanoned_test.

-- Création user & bdd --
-------------------------
CREATE USER IF NOT EXISTS 'naoned_test'@'localhost';

GRANT USAGE ON * . * TO  'naoned_test'@'localhost' 
    WITH MAX_QUERIES_PER_HOUR 0 
    MAX_CONNECTIONS_PER_HOUR 0 
    MAX_UPDATES_PER_HOUR 0 
    MAX_USER_CONNECTIONS 0 ;

DROP DATABASE IF EXISTS naoned_test;
CREATE DATABASE naoned_test COLLATE utf8_unicode_ci;
USE naoned_test;

-- Création tables --
---------------------

DROP TABLE IF EXISTS categorie;
CREATE TABLE categorie (
    cat_id      INT             NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
    cat_label   VARCHAR(255)    NOT NULL,
    cat_parent  INT,
    FOREIGN KEY (cat_parent) REFERENCES categorie(cat_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
ALTER TABLE categorie AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS fiche;
CREATE TABLE fiche (
    fi_id      INT             NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
    fi_label   varchar(255)    NOT NULL,
    fi_description  TEXT
);
ALTER TABLE fiche AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS categorie_fiche;
CREATE TABLE categorie_fiche (
    cat_id     INT  NOT NULL,
    fi_id      INT  NOT NULL,
    FOREIGN KEY (cat_id) REFERENCES categorie(cat_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fi_id) REFERENCES fiche(fi_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (cat_id, fi_id)
);

