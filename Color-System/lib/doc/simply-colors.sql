-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 aug 2017 om 11:34
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simply-colors`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijst-7155`
--

CREATE TABLE `bestellijst-7155` (
  `bestelLijstID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL,
  `aantal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cart-8355`
--

CREATE TABLE `cart-8355` (
  `cartID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL,
  `aantal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `cart-8355`
--

INSERT INTO `cart-8355` (`cartID`, `userID`, `productID`, `aantal`) VALUES
('2FD7572A-BE24-AE33-6A80-16D499132734', '1af9ea1c-2072-4328-9ead-c28aee975fa5', 'FDA1ED01-90B7-87F3-F8E3-DAD0E8C1D6FC', 2),
('749D901E-111F-41E4-ECE9-556E802B4E74', '1af9ea1c-2072-4328-9ead-c28aee975fa5', 'FDA1ED01-90B7-87F3-F8E3-DAD0E8C1D6FC', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten-7416`
--

CREATE TABLE `producten-7416` (
  `productID` varchar(255) NOT NULL,
  `productnaam` varchar(50) NOT NULL,
  `rgb` varchar(20) NOT NULL,
  `prijs` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten-7416`
--

INSERT INTO `producten-7416` (`productID`, `productnaam`, `rgb`, `prijs`) VALUES
('FDA1ED01-90B7-87F3-F8E3-DAD0E8C1D6FC', 'Wit', '255,255,255', 10.00),
('Test', 'Test', '255,255,255', 10.16);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users-3469`
--

CREATE TABLE `users-3469` (
  `userID` varchar(255) NOT NULL,
  `rol` int(1) NOT NULL,
  `gebruikersnaam` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users-3469`
--

INSERT INTO `users-3469` (`userID`, `rol`, `gebruikersnaam`, `email`, `password`) VALUES
('1af9ea1c-2072-4328-9ead-c28aee975fa5', 1, 'Dwitter', 'Dwitter@dwitter.nl', 'd9b5f58f0b38198293971865a14074f59eba3e82595becbe86ae51f1d9f1f65e');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voorraad-9262`
--

CREATE TABLE `voorraad-9262` (
  `voorraadID` varchar(255) NOT NULL,
  `productID` varchar(255) NOT NULL,
  `aantal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellijst-7155`
--
ALTER TABLE `bestellijst-7155`
  ADD PRIMARY KEY (`bestelLijstID`);

--
-- Indexen voor tabel `cart-8355`
--
ALTER TABLE `cart-8355`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexen voor tabel `producten-7416`
--
ALTER TABLE `producten-7416`
  ADD PRIMARY KEY (`productID`);

--
-- Indexen voor tabel `users-3469`
--
ALTER TABLE `users-3469`
  ADD PRIMARY KEY (`userID`);

--
-- Indexen voor tabel `voorraad-9262`
--
ALTER TABLE `voorraad-9262`
  ADD PRIMARY KEY (`voorraadID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
