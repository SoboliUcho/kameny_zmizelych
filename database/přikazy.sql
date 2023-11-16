CREATE TABLE `spravci` (
    'id'int(11) NOT NULL AUTO_INCREMENT,
    'jmeno' varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    'email' varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
)

ALTER TABLE lide
ADD transport int(11) DEFAULT NULL,
ADD mrtvy date DEFAULT NULL,
ADD realmrtvy date DEFAULT NULL,
ADD rozena varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
ADD deti json DEFAULT NULL,
ADD odkazy json DEFAULT NULL,
ADD spravce int(11) DEFAULT NULL,
ADD FOREIGN KEY (spravce) REFERENCES spravci(id);

CREATE TABLE napsali (
    id NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nadpis varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    odkaz  varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    slova  text COLLATE utf8mb4_czech_ci,
    obrazek varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    datum date DEFAULT NULL

)
CREATE TABLE donatori (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jmeno varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    email varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
    castka  int(11) DEFAULT NULL
)
ALTER TABLE lide
ADD zamnestnani varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,

ALTER TABLE spravci
ADD visible tinyint(1) DEFAULT 1

ALTER TABLE lide
ADD FOREIGN KEY (dum_id) REFERENCES domy(id),
ADD FOREIGN KEY (otec_id) REFERENCES lide(id),
ADD FOREIGN KEY (matka_id) REFERENCES lide(id),
ADD FOREIGN KEY (partner_id) REFERENCES lide(id);