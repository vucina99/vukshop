-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 01:11 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vukshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `boja`
--

CREATE TABLE `boja` (
  `idboja` int(255) NOT NULL,
  `vrednost` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boja`
--

INSERT INTO `boja` (`idboja`, `vrednost`) VALUES
(10, 'Bela'),
(2, 'Crna'),
(4, 'Plava'),
(1, 'Svetlo zelena'),
(3, 'Svetlo žuta'),
(6, 'Zelena'),
(7, 'Žuta');

-- --------------------------------------------------------

--
-- Table structure for table `brendovi`
--

CREATE TABLE `brendovi` (
  `idbrend` int(255) NOT NULL,
  `nazivbrend` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slikaaltbrend` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slikasrcbrend` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brendovi`
--

INSERT INTO `brendovi` (`idbrend`, `nazivbrend`, `slikaaltbrend`, `slikasrcbrend`) VALUES
(1, 'FB sister', 'FB sister logo', 'fbsisters.png'),
(2, 'Smog', 'Smog logo', 'smog.png'),
(3, 'FSBN', 'FSBN logo', 'fsbn.png'),
(6, 'Amisu', 'Amisu logo', '1591918776_amisu.png');

-- --------------------------------------------------------

--
-- Table structure for table `cena`
--

CREATE TABLE `cena` (
  `idcena` int(255) NOT NULL,
  `idproizvod` int(255) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `datumod` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `cena`
--

INSERT INTO `cena` (`idcena`, `idproizvod`, `cena`, `datumod`) VALUES
(5, 2, '899.00', '2021-08-30 00:18:16'),
(6, 3, '899.00', '2021-08-30 00:18:16'),
(7, 4, '1899.00', '2021-08-30 00:18:16'),
(8, 5, '2599.00', '2021-08-30 00:18:16'),
(12, 1, '999.00', '2021-08-30 00:18:16'),
(14, 18, '799.00', '2021-08-30 00:18:16'),
(15, 19, '899.00', '2021-08-30 00:18:16'),
(16, 20, '1899.00', '2021-08-30 00:18:16'),
(17, 21, '999.00', '2021-08-30 00:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `idkategorije` int(255) NOT NULL,
  `nazivkat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`idkategorije`, `nazivkat`) VALUES
(2, 'Haljine'),
(3, 'Jakne'),
(1, 'Majice'),
(4, 'Pantalone'),
(5, 'Šorts');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnika` int(11) NOT NULL,
  `ime` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `iduloga` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slikakorisnika` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnika`, `ime`, `prezime`, `email`, `lozinka`, `iduloga`, `datum`, `slikakorisnika`) VALUES
(1, 'Vuk', 'Zdravkovic', 'vukzdravkovic69@gmail.com', 'c8de05f20384b677430fa0ee02132ae5', 2, '2021-08-27 22:51:25', 'assets/uploadimg/nova_1630097485_AirBrush_20200906092643.jpg'),
(2, 'Jovanka', 'Jokic', 'jjokic@gmail.com', '5d233f5861e52f7a40ef32c27dd95138', 1, '2021-08-29 23:32:54', 'assets/uploadimg/nova_1630272774_haljina.png'),
(3, 'Ceda', 'Zdravkovic', 'ceda@gmail.com', 'c8de05f20384b677430fa0ee02132ae5', 1, '2021-08-29 23:56:50', 'assets/uploadimg/nova_1630274210_AirBrush_20200906092643.jpg'),
(4, 'Luka', 'Lukic', 'lukalukic@gmail.com', 'b03fb76da09b0b42f0f74e728b727573', 1, '2021-08-30 00:54:58', 'assets/uploadimg/nova_1630277698_1591885792_decak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id` int(11) NOT NULL,
  `idproizvod` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `idKorisnika` int(11) NOT NULL,
  `kupljeno` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id`, `idproizvod`, `kolicina`, `idKorisnika`, `kupljeno`) VALUES
(1, 2, 2, 1, 1),
(2, 3, 1, 1, 1),
(3, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idmeni` int(255) NOT NULL,
  `naziv` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `prikaz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idmeni`, `naziv`, `putanja`, `prikaz`) VALUES
(1, 'Početna', 'index.php', 0),
(3, 'Muška', 'index.php?page=proizvodi&kat=Muška', 0),
(4, 'Ženska', 'index.php?page=proizvodi&kat=Ženska', 0),
(5, 'Kontakt', 'index.php?page=kontakt', 0),
(6, 'Admin panel', 'index.php?page=admin', 1),
(7, 'Autor', 'index.php?page=autor', 0),
(8, 'Korpa', 'index.php?page=korpa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `idocena` int(255) NOT NULL,
  `idproizvod` int(255) NOT NULL,
  `idkorisnik` int(255) NOT NULL,
  `ocena` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`idocena`, `idproizvod`, `idkorisnik`, `ocena`) VALUES
(1, 3, 1, 5),
(2, 19, 5, 5),
(3, 19, 1, 3),
(7, 4, 1, 5),
(8, 5, 5, 3),
(9, 1, 5, 3),
(10, 4, 5, 3),
(11, 1, 1, 5),
(12, 18, 1, 5),
(13, 18, 5, 5),
(14, 19, 2, 5),
(15, 5, 1, 5),
(16, 2, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `idPoruke` int(255) NOT NULL,
  `email` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `naslov` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tekst` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`idPoruke`, `email`, `naslov`, `tekst`) VALUES
(2, 'ceda@gmail.com', 'Pitanje', 'Da li mogu da zamenim proizvod ako nemam etiketu?'),
(6, 'jana@yahoo.com', 'Pitanje', 'Kojim prevozom mogu doci do vas'),
(8, 'deki@gmail.com', 'Pitanje', 'Da li radite vikendom?');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `idproizvod` int(255) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slikasrc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slikaalt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idbrend` int(255) NOT NULL,
  `idmeni` int(255) NOT NULL,
  `idkat` int(255) NOT NULL,
  `idboja` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`idproizvod`, `naziv`, `slikasrc`, `slikaalt`, `idbrend`, `idmeni`, `idkat`, `idboja`) VALUES
(1, 'Majica Knjiga o džungli', 'majica2.png', 'Majica', 1, 4, 1, 3),
(2, 'Muska majica', 'majicam.png', 'Majica', 2, 3, 1, 2),
(3, 'Majica', 'majica.png', 'Majica', 1, 4, 1, 1),
(4, 'Haljina sa tufnama', 'haljina.png', 'Kratka haljina', 1, 4, 2, 2),
(5, 'Teksas jakna', 'jakna.png', 'Muska jakna', 3, 3, 3, 4),
(18, 'Majica cvetna', '1591922748_slika5.png', 'Majica', 6, 4, 1, 10),
(19, 'Majica', '1591922880_majicamuska.png', 'Majica', 3, 3, 1, 10),
(20, 'Šorts', '1591923041_sorc.png', 'Šorts', 3, 3, 5, 2),
(21, 'Majica Tom i Džeri', '1591961342_majica55.png', 'Majica Tom i Džeri', 1, 4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `iduloga` int(255) NOT NULL,
  `nazivuloge` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`iduloga`, `nazivuloge`) VALUES
(1, 'Korisnik'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boja`
--
ALTER TABLE `boja`
  ADD PRIMARY KEY (`idboja`),
  ADD UNIQUE KEY `vrednost` (`vrednost`);

--
-- Indexes for table `brendovi`
--
ALTER TABLE `brendovi`
  ADD PRIMARY KEY (`idbrend`);

--
-- Indexes for table `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`idcena`),
  ADD KEY `idproizvod` (`idproizvod`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`idkategorije`),
  ADD UNIQUE KEY `nazivkat` (`nazivkat`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnika`),
  ADD KEY `iduloga` (`iduloga`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproizvod` (`idproizvod`),
  ADD KEY `idKorisnika` (`idKorisnika`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idmeni`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`idocena`),
  ADD KEY `idproizvod` (`idproizvod`),
  ADD KEY `idkorisnik` (`idkorisnik`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`idPoruke`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`idproizvod`),
  ADD KEY `idbrend` (`idbrend`),
  ADD KEY `idmeni` (`idmeni`),
  ADD KEY `idkat` (`idkat`),
  ADD KEY `idboja` (`idboja`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`iduloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boja`
--
ALTER TABLE `boja`
  MODIFY `idboja` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brendovi`
--
ALTER TABLE `brendovi`
  MODIFY `idbrend` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cena`
--
ALTER TABLE `cena`
  MODIFY `idcena` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `idkategorije` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idmeni` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `idocena` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `idPoruke` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `idproizvod` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `iduloga` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cena`
--
ALTER TABLE `cena`
  ADD CONSTRAINT `cena_ibfk_1` FOREIGN KEY (`idproizvod`) REFERENCES `proizvod` (`idproizvod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
