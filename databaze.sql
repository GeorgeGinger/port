-- Active: 1694681801963@@127.0.0.1@3306@db-saunaklub
CREATE DATABASE db_saunaklub_editace COLLATE utf8_czech_ci;

CREATE TABLE stranka (
id VARCHAR(255) PRIMARY KEY,
titulek TEXT,
menu TEXT,
obsah TEXT,
poradi INT UNSIGNED
);

INSERT INTO stranka (id, titulek, menu, obsah, poradi) VALUES
 ("uvod", "PrimaKavarna", "Domů", "", 1),
 ("nabidka", "PrimaKavarna - Nabídka", "Nabídka", "", 2),
 ("galerie", "PrimaKavarna - Galerie", "Galerie", "", 3),
 ("rezervace", "PrimaKavarna - Rezervace", "Rezervace", "", 4),
 ("kontakt", "PrimaKavarna - Kontakt", "Kontakt", "", 5),
 ("404", "Stránka neexistuje", "", "", 6)
 ("test", "Stránka Test", "Test", "", 7);
INSERT INTO stranka (id, titulek, menu, obsah, poradi) VALUES
 ("test", "Stránka Test", "Test", "", 7);

 