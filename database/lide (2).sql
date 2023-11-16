-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 10. lis 2023, 16:18
-- Verze serveru: 5.7.17
-- Verze PHP: 5.6.30

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
-- Struktura tabulky `lide`
--

CREATE TABLE `lide` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `prijmeni` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `rozena` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `pohlavi` tinyint(1) DEFAULT '0',
  `datum_narozeni` date DEFAULT NULL,
  `misto_narozeni` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `statni_prislusnost` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `nabozenske_vyznani` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `transport` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL,
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
  `zamnestnani` varchar(255) COLLATE utf8mb4_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `lide`
--

INSERT INTO `lide` (`id`, `jmeno`, `prijmeni`, `rozena`, `pohlavi`, `datum_narozeni`, `misto_narozeni`, `statni_prislusnost`, `nabozenske_vyznani`, `transport`, `mrtvy`, `realmrtvy`, `rodinny_stav`, `partner_id`, `partner`, `dum_id`, `den_prichodu`, `otec_id`, `otec-j`, `matka_id`, `matka-j`, `deti_id`, `deti`, `datum_presidleni`, `presidlil`, `datum_odhaseni`, `majitel_mot_vozidla`, `odkazy`, `karta`, `informace`, `spravce`, `zamnestnani`) VALUES
(1, 'človek', 'jedna', NULL, 0, '2023-09-15', 'boskovice', 'česká', 'jude', NULL, NULL, NULL, 'svobodný', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'človek', 'dvadvadvadvadva', NULL, 0, '2023-09-15', 'boskovice', 'česká', 'jude', NULL, NULL, NULL, 'svobodný', NULL, NULL, 1, '2023-09-15', 1, 'človek jedna', 8, 'človek fsadmfků', NULL, NULL, '2023-09-20', '2023-09-26', '2023-09-05', NULL, NULL, NULL, '212', NULL, NULL),
(3, 'Človek', 'Ano', 'Ne', 1, '2023-09-15', 'Boskovice', 'česká', 'jude', 'la', '2023-11-10', '2023-11-10', 'svobodný', 4, 'človek ano2', 1, '2023-09-15', 1, 'človek jedna', 6, 'človek jedna2', '[\"2\"]', '[\"človek dvadvadvadvadva\"]', '2023-09-20', '2023-09-26', '2023-09-05', 1, '[[\"odkaz 1\", \"odkaz 1\"]]', '[\"karty/Clovek_Ano_65458048d1c67_EwlVdA3W8AIOTmr.jfif\", \"karty/Clovek_Ano_65458048d358d_FXPBmscXEAIiaqz.jfif\"]', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sollicitudin. Proin mattis lacinia justo. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Nullam dapibus fermentum ipsum. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Suspendisse sagittis ultrices augue. Integer vulputate sem a nibh rutrum consequat. Proin mattis lacinia justo. Suspendisse nisl. Aenean vel massa quis mauris vehicula lacinia. Nulla non arcu lacinia neque faucibus fringilla. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Maecenas sollicitudin.', 1, NULL),
(4, 'človek', 'ano2', NULL, 1, '2023-09-15', 'boskovice', 'česká', NULL, NULL, NULL, '2023-10-12', 'svobodný', NULL, NULL, 1, '2023-09-15', 1, 'človek jedna', NULL, NULL, NULL, NULL, '2023-09-20', '2023-09-26', '2023-09-05', 0, NULL, NULL, NULL, 1, NULL),
(5, 'človek', 'dva2', NULL, 0, '2023-09-15', 'boskovice', 'česká', 'jude', NULL, NULL, NULL, 'svobodný', NULL, NULL, 3, '2023-09-15', 1, 'človek jedna', NULL, NULL, NULL, NULL, '2023-09-20', '2023-09-26', '2023-09-05', 0, NULL, NULL, '212', NULL, NULL),
(6, 'človek', 'jedna2', NULL, 0, '2023-09-15', 'boskovice', 'česká', 'jude', NULL, NULL, NULL, 'svobodný', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'jméno ', 'příjmení ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kozel', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'človek', 'fsadmfků', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'obr1', 'pokus', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `lide`
--
ALTER TABLE `lide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otec_id` (`otec_id`),
  ADD KEY `matka_id` (`matka_id`),
  ADD KEY `dum_id` (`dum_id`),
  ADD KEY `spravce` (`spravce`),
  ADD KEY `partner_id` (`partner_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `lide`
--
ALTER TABLE `lide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
