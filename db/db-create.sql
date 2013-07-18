-- 2013-07-16
-- Script de création de la base nanoned_test.

-- Création user & bdd --

DROP TABLE IF EXISTS categorie_fiche;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS fiche;

DROP DATABASE IF EXISTS naoned_test;

CREATE DATABASE naoned_test COLLATE utf8_unicode_ci;
USE naoned_test;

-- Création tables --

CREATE TABLE categorie (
    cat_id      INT             NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
    cat_label   VARCHAR(255)    NOT NULL,
    cat_parent  INT,
    FOREIGN KEY (cat_parent) REFERENCES categorie(cat_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
ALTER TABLE categorie AUTO_INCREMENT = 1;


CREATE TABLE fiche (
    fi_id      INT             NOT NULL    AUTO_INCREMENT  PRIMARY KEY,
    fi_label   varchar(255)    NOT NULL,
    fi_description  TEXT
);
ALTER TABLE fiche AUTO_INCREMENT = 1;


CREATE TABLE categorie_fiche (
    cat_id     INT  NOT NULL,
    fi_id      INT  NOT NULL,
    FOREIGN KEY (cat_id) REFERENCES categorie(cat_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fi_id) REFERENCES fiche(fi_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (cat_id, fi_id)
);

-- Triggers --

-- Supprime les fiches associées à une catégorie à la suppression de celle ci.
-- TODO: recursif (ne supprime les post associés à une sous catégorie que sur un seul niveau)
DROP TRIGGER IF EXISTS tr_del_fiches_on_cat_delete;
delimiter $$
CREATE TRIGGER tr_del_fiches_on_cat_delete
    BEFORE DELETE ON categorie
    FOR EACH ROW
BEGIN
    DECLARE cat_id INT;
    SET cat_id = OLD.cat_id;

    DELETE FROM fiche WHERE fi_id in (
        SELECT fi_id FROM categorie_fiche
        WHERE categorie_fiche.cat_id = cat_id
    );
END$$
delimiter ;

