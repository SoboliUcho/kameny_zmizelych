-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 30. lis 2023, 18:54
-- Verze serveru: 5.7.17
-- Verze PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kameny`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `domy`
--

CREATE TABLE `domy` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `mesto` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT 'Boskovice',
  `ulice` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `cislo_domu` int(11) DEFAULT NULL,
  `gps_x` float DEFAULT NULL,
  `gps_y` float DEFAULT NULL,
  `stare_cislo` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `domy`
--
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '1', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '2', '2');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '3', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '4', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '4', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '5', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '6', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '7', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '8', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '9', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '10', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '11', '9');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '12a', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Traplova', '12', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '13', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '14', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '15', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Koupadel', '15a', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Koupadel', '16', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Koupadel', '17', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '18', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '20', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '20a', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '21a', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '22', '14');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Templu', '23', '16');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '23', '2');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '23a', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '24', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '25', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '26', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '27', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '28', '14');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '29', '16');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '30', '20');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '31', '22');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '32', '24');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '33', '26');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '34a', '32');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '34b', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '35', '34');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '35b', '36');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '35a', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '35c', '16');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '36', '38');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '36a', '40');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '37a', '42');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '37b', '44');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '37c', '46');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '38', '15');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '39', '13');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova - Jeden Dům', '40 a 41', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '42', '9');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '43a', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Ve Špitálku', '43b', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Joštova', '44b', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Joštova', '44a', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Joštova', '44c', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '44', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '45a', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '45', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '45', '15');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '46a', '13');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '46', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '47b', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '47a', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '48', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '49', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '50', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '98', '14');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '51', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '99', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '52', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '53a', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '53b', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '54', '2');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '55', '9');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '56', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '57', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '58', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '58', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '59', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská ', '59', '15');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '60', '45');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '61', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '62', '2');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '63', '43');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '64', '41');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '64a', '39');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '65', '37');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '66', '35');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '67b', '33');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '67a', '31');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '68', '29');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '69a', '27');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '69b', '25');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '70', '23');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '71', '21');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '72', '19');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '73', '17');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '74', '15');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '75', '13');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '76', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '77', '9');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '77a', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '78', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '79a', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '79b', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '80', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '81', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '82', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '83', '0');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Plačkova', '84', '0');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '85', '13');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '86', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '87', '11');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '88', '0');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '89', '9');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '90', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '91', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '92', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '93', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '93a', '4');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '94', '12');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '95a', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '95b', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '96', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '97', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '98', '14');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Vážné Studny', '99', '10');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Joštova', '100a', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zástřizlova', '100a', '1');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zástřizlova', '100b', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Koupadel', '101', '5');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('U Koupadel', '102', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '103', '14');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('V Síňkách', '103a', '8');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Velenova', '104', '3');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Pod Klášterem', '104', '6');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '106', '30');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Bílkova', '107', '28');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zborovská', '108', '7');
INSERT INTO `domy` (`ulice`, `stare_cislo`, `cislo_domu`) VALUES ('Zástřizlova', '109', '5');
--------------------------------------------------------

--
-- Struktura tabulky `donatori`
--

CREATE TABLE `donatori` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jmeno` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `castka` int(11) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `donatori`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `lide`
--

CREATE TABLE `lide` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jmeno` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `prijmeni` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `rozena` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `pohlavi` tinyint(1) DEFAULT '0',
  `datum_narozeni` date DEFAULT NULL,
  `misto_narozeni` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `statni_prislusnost` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `nabozenske_vyznani` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `transport` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `datum_trans_tere` date DEFAULT NULL,
  `transport_tere` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `mrtvy` date DEFAULT NULL,
  `realmrtvy` date DEFAULT NULL,
  `rodinny_stav` varchar(50) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `partner` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `dum_id` int(11) DEFAULT NULL,
  `den_prichodu` date DEFAULT NULL,
  `otec_id` int(11) DEFAULT NULL,
  `otec-j` text COLLATE utf8mb4_czech_ci,
  `matka_id` int(11) DEFAULT NULL,
  `matka-j` text COLLATE utf8mb4_czech_ci,
  `deti_id` json DEFAULT NULL,
  `deti` json DEFAULT NULL,
  `datum_presidleni` date DEFAULT NULL,
  `presidlil` date DEFAULT NULL,
  `datum_odhaseni` date DEFAULT NULL,
  `majitel_mot_vozidla` tinyint(1) DEFAULT NULL,
  `odkazy` json DEFAULT NULL,
  `karta` json DEFAULT NULL,
  `informace` text COLLATE utf8mb4_czech_ci,
  `spravce` int(11) DEFAULT NULL,
  `zamnestnani` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `lide`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `napsali`
--

CREATE TABLE `napsali` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nadpis` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `odkaz` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `slova` text COLLATE utf8mb4_czech_ci,
  `datum` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `napsali`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `report`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `spravci`
--

CREATE TABLE `spravci` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `jmeno` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `spravci`
--

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `domy`
--
ALTER TABLE `domy`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `donatori`
--
ALTER TABLE `donatori`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `lide`
--
ALTER TABLE lide
ADD FOREIGN KEY (otec_id) REFERENCES lide(id),
ADD FOREIGN KEY (matka_id) REFERENCES lide(id),
ADD FOREIGN KEY (partner_id) REFERENCES lide(id);
ADD FOREIGN KEY (spravce) REFERENCES spravci(id);
ADD FOREIGN KEY (dum_id) REFERENCES domy(id),


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
