CREATE DATABASE Kamen;

USE Kamen;

CREATE TABLE dum
(
  Mesto VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  Ulice VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  cislo INT DEFAULT NULL,
  Gps_x FLOAT DEFAULT NULL,
  Gps_y FLOAT DEFAULT NULL,
  stare_cislo VARCHAR(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  Id_domu INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (Id_domu)
);

CREATE TABLE Spravce
(
  Email VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  Jmeno VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  Id_spravce INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (Id_spravce)
);

CREATE TABLE Transport
(
  Nazev VARCHAR(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  Datum DATE DEFAULT NULL,
  id_transportu INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_transportu)
);

CREATE TABLE Clovek
(
  Datum_narozeni DATE DEFAULT NULL,
  Prijmeni VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  Jmeno VARCHAR(255) COLLATE utf8mb4_czech_ci NOT NULL,
  datum_umrti DATE DEFAULT NULL,
  Informace Text DEFAULT NULL,
  id_cloveka INT NOT NULL AUTO_INCREMENT,
  Id_domu INT DEFAULT NULL,
  Id_spravce INT DEFAULT NULL,
  id_transportu INT DEFAULT NULL,
  Partner_id_cloveka INT DEFAULT NULL,
  PRIMARY KEY (id_cloveka),
  FOREIGN KEY (Id_domu) REFERENCES dum(Id_domu),
  FOREIGN KEY (Id_spravce) REFERENCES Spravce(Id_spravce),
  FOREIGN KEY (id_transportu) REFERENCES Transport(id_transportu),
  FOREIGN KEY (Partner_id_cloveka) REFERENCES Clovek(id_cloveka)
);

CREATE TABLE Rodic
(
  id_cloveka_1 INT NOT NULL,
  Rodicid_cloveka_2 INT NOT NULL,
  PRIMARY KEY (id_cloveka_1, Rodicid_cloveka_2),
  FOREIGN KEY (id_cloveka_1) REFERENCES Clovek(id_cloveka),
  FOREIGN KEY (Rodicid_cloveka_2) REFERENCES Clovek(id_cloveka)
);

INSERT INTO clovek ( Jmeno, Prijmeni, Datum_narozeni, datum_umrti, informace, Id_spravce, Id_domu, id_transportu) VALUES
('Josefa', 'Lustigov', '1879-11-23', '1942-10-26', '', '1', '24', '1'),
	('Helena', 'Fisherová', '1884-10-24', '1943-04-26', '', '1', '29', '1'),
	('Ludvík', 'Goldmann', '1877-09-18', '1942-06-23', 'všichni z transportu, až na 9 osob, zavražděni plynem 23.6.1942 v Sobiboru', '1', '30', '1'),
	('Kurt Petr', 'Goldmann', '1906-06-09', '1942-06-24', 'všichni z transportu, až na 9 osob, zavražděni plynem 23.6.1942 v Sobiboru', '2', '30', '1'),
	('Alice', 'Goldmannová', '1916-12-13', '1942-06-25', 'všichni z transportu, až na 9 osob, zavražděni plynem 23.6.1942 v Sobiboru', '1', '30', '1'),
	('Fany', 'Goldmannová', '1885-08-02', '1942-06-26', 'všichni z transportu, až na 9 osob, zavražděni plynem 23.6.1942 v Sobiboru', '2', '30', '1'),
	('Věra Marie', 'Goldmannová', '1936-04-29', '1942-06-27', 'všichni z transportu, až na 9 osob, zavražděni plynem 23.6.1942 v Sobiboru', '2', '30', '1'),
	('Rudolf', 'Weiss', '1904-03-25', '1944-12-05', '', '3', '29', '2'),
	('Mariana', 'Weissová', '1909-09-10', '1945-04-19', '', '3', '29', '2'),
	('Jiří', 'Weiss', '1935-08-12', '1945-04-19', '', '4', '29', '2');

INSERT INTO dum (Id_domu, Mesto, Ulice, cislo, Gps_x, Gps_y, stare_cislo) VALUES
	('1', 'Boskovice', 'Plačkova', '25', '16.6603', '49.4865', '69b'),
	('2', 'Boskovice', 'Plačkova', '23', '16.6605', '49.4865', '70'),
	('3', 'Boskovice', 'Zborovská', '9', '16.6596', '49.4871', NULL),
	('21', 'Boskovice', 'U Koupadel', '4', NULL, NULL, '15a'),
	('22', 'Boskovice', 'U Koupadel', '6', NULL, NULL, '16'),
	('23', 'Boskovice', 'U Koupadel', '3', NULL, NULL, '17'),
	('24', 'Boskovice', 'U Templu', '10', NULL, NULL, '18'),
	('25', 'Boskovice', 'U Templu', '3', NULL, NULL, '20'),
	('26', 'Boskovice', 'U Templu', '5', NULL, NULL, '20a'),
	('27', 'Boskovice', 'U Templu', '7', NULL, NULL, '21a'),
	('28', 'Boskovice', 'U Templu', '14', NULL, NULL, '22'),
	('29', 'Boskovice', 'U Templu', '16', NULL, NULL, '23'),
	('30', 'Boskovice', 'Bílkova', '2', NULL, NULL, '23');

INSERT INTO Rodic (id_cloveka_1, Rodicid_cloveka_2) VALUES
	('9', '1'),
	('3', '6'),
	('4', '1'),
	('3', '5'),
	('5', '9'),
	('10', '8');

INSERT INTO Transport (id_transportu, Datum , Nazev) VALUES
	('1', '1942-03-15', 'vlakem z Boskovic do Brna'),
	('2', '1942-04-01', 'vlakem z Boskovic do Brna');
INSERT INTO Spravce (Id_spravce, Jmeno , Email) VALUES
	('1', 'Spravce1', 'spravce1@spravce.cz'),
	('2', 'Spravce2', 'spravce2@spravce.cz'),
	('3', 'Spravce3', 'spravce3@spravce.cz'),
	('4', 'Spravce4', 'spravce4@spravce.cz');

-- vybrání všech domů a jejich gps pro zobrazení na mapě
SELECT ulice, cislo, Gps_x, Gps_y FROM dum;

-- vybrání všech domů a seřezení abecedně podle ulice a čísla
SELECT mesto, ulice, cislo FROM dum order by ulice ASC, cislo ASC;

-- stažení všech informacích o správci s id 1
SELECT * FROM spravci WHERE id = 1;

-- Zobrazit jména a příjmení všech lidí ve složeném formátu (Jmeno Prijmeni).
SELECT CONCAT(Jmeno, ' ', Prijmeni) AS CeleJmeno FROM clovek;

-- vybrání informací od lidech seřazení abecedně podle příjemní a jména 
SELECT id_cloveka, Jmeno, Prijmeni, datum_narozeni FROM clovek ORDER BY `clovek`.`Prijmeni` ASC, `clovek`.`Jmeno` ASC;

-- Zjistit všechny informace o lidech, kteří byli v Boskovicích a jejichž datum umrtí bylo před rokem 1943.
SELECT * FROM clovek join dum on clovek.Id_domu = dum.Id_domu WHERE Mesto = 'Boskovice' AND datum_umrti < '1943-01-01';  

-- vypsání nejstaršího člověka
SELECT Jmeno, Prijmeni, Datum_narozeni, YEAR(CURRENT_DATE) - YEAR(Datum_narozeni) AS Vek FROM Clovek ORDER BY Vek DESC LIMIT 1;

-- vybere všechny děti osoby s id 1
SELECT 
  d.Jmeno AS JmenoDite, 
  d.Prijmeni AS PrijmeniDite 
FROM Rodic r 
JOIN Clovek d ON r.id_cloveka_1  = d.id_cloveka 
WHERE r.Rodicid_cloveka_2 = 1;

-- najde všechny rodiče osoby 1
SELECT 
  c.Jmeno AS JmenoRodice, 
  c.Prijmeni AS PrijmeniRodice 
FROM Rodic r 
JOIN Clovek c ON r.Rodicid_cloveka_2  = d.id_cloveka 
WHERE r.id_cloveka_1 = 1;

-- vybrání informací od lidech kteří má správce 1 a jich adreasy bydliště seřazení abecedně podle příjemní a jména 
SELECT 
    l.id, 
    l.jmeno, 
    l.prijmeni, 
    l.Datum_narozeni,
    l.dum_id, 
    d.ulice,
    d.cislo_domu
    FROM lide l 
    JOIN dum d on d.id = l.dum_id
    where l.spravce = 1
    ORDER BY l.prijmeni ASC, l.jmeno ASC;

-- Zobrazit jméno, příjmení a datum transportu
SELECT c.Jmeno, c.Prijmeni, t.Datum FROM Clovek c JOIN Transport t ON c.id_transportu = t.id_transportu;

-- Zjistit počet lidí v každém domě.
SELECT d.Id_domu, COUNT(c.id_cloveka) AS PocetObyvatel
FROM Dum d
LEFT JOIN Clovek c ON d.Id_domu = c.Id_domu
GROUP BY d.Id_domu;

-- přidání nového správce
INSERT INTO Spravce (Email, Jmeno) VALUES ('novyspravce@email.cz', 'Novy Spravce');

-- Odstraní všechny lidi, kteří zemřeli před rokem 1940.
DELETE FROM Clovek WHERE datum_umrti < '1940-01-01';

-- Aktualizuje informace o lidech, kteří mají ID_domu 29 a změní správce na ID_spravce 5.
UPDATE Clovek SET Id_spravce = 5 WHERE Id_domu = 29;