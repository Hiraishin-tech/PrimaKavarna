CREATE DATABASE primakavarna COLLATE utf8mb4_czech_ci;

CREATE TABLE stranka (
    id VARCHAR(100) PRIMARY KEY,
    titulek VARCHAR(255),
    menu VARCHAR(255),
    obsah TEXT,
    poradi INT
);

INSERT INTO stranka (id, titulek, menu, poradi)
VALUES ("uvod", "PrimaKavárna", "Domů", 1),
       ("nabidka", "PrimaKavárna - Nabídka", "Nabídka", 2),
       ("galerie", "PrimaKavárna - Galerie", "Galerie", 3),
       ("rezervace", "PrimaKavárna - Rezervace", "Rezervace", 4),
       ("kontakt", "PrimaKavárna - Kontakt", "Kontakt", 5),
       ("404", "Stránka neexistuje", "", 6);

INSERT INTO stranka SET id = "test", titulek = "Testovací titulek", menu = "Testovací menu", poradi = 7;

UPDATE stranka
SET menu = "Test"
WHERE menu = "Testovací menu";
