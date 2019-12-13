-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2019 at 09:23 PM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenti`
--

DROP TABLE IF EXISTS `agenti`;
CREATE TABLE IF NOT EXISTS `agenti` (
  `SifraA` int(11) NOT NULL,
  `Ime` varchar(11) NOT NULL,
  `Prezime` varchar(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`SifraA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenti`
--

INSERT INTO `agenti` (`SifraA`, `Ime`, `Prezime`, `Email`) VALUES
(1, 'Milutin', 'Pejovic', 'mile@gmail.com'),
(2, 'Darko', 'Nenadovic', 'nenad@gmail.com'),
(3, 'Zoran', 'Dragisic', 'zok1@gmail.com'),
(4, 'Dragica', 'Todorovic', 'draga@live.com'),
(5, 'Milica', 'Ljubinkovic', 'milica@yahoo'),
(6, 'Djordje', 'Perusic', 'djole@yahoo.com'),
(7, 'Aleksandar', 'Loncar', 'alek@gmail.com'),
(8, 'Stevan', 'Velimirovic', 'velis@gmail.com'),
(9, 'Miroslava', 'Drazic', 'petra@gmail.com'),
(10, 'Zita', 'Turcinovic', 'zitaturcin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `SifraK` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`SifraK`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`SifraK`, `username`, `mail`, `pass`) VALUES
(1, 'Pera00', 'pera@gmail.com', '$2y$10$tgvf9LnRtHr4k5qFLdi0K.5YTPGvUkWYmFEvDnIUNZHpu1ZGnOPMG'),
(2, 'Danilo234', 'danilo@gmail.com', '$2y$10$A1zvANCwXr1HwmClWI0Xd.3WJ7pzM5UvwRHgWiv9PpQ2iMuKJOJHe'),
(3, 'Stojanka', 'stodza@gmail.com', '$2y$10$I8IbWkidDzXFzSpyiPjWp.wnpmDzVLjJm5HxX99EfBhYePxeyv/Lu'),
(4, 'Zita', 'zitaturcin@yahoo.com', '$2y$10$hjU.cTFpBSSYpj7AhKax1.7gQ/AstzljZ19e/Zn5A6VuwOTxV0fV2'),
(5, 'dockie', 'dockie@msn.com', '$2y$10$kD3bQ4Gw.Fyg/h32tHIiweZsbI9AzCsxSWdgYi/j8k6XGBoZKYFW2');

-- --------------------------------------------------------

--
-- Table structure for table `naselje`
--

DROP TABLE IF EXISTS `naselje`;
CREATE TABLE IF NOT EXISTS `naselje` (
  `SifraN` int(11) NOT NULL,
  `Naziv` varchar(11) NOT NULL,
  `km2` int(11) NOT NULL,
  PRIMARY KEY (`SifraN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `naselje`
--

INSERT INTO `naselje` (`SifraN`, `Naziv`, `km2`) VALUES
(1, 'Liman', 5000),
(2, 'Detelinara', 3000),
(3, 'Grbavica', 300);

-- --------------------------------------------------------

--
-- Table structure for table `prodaja`
--

DROP TABLE IF EXISTS `prodaja`;
CREATE TABLE IF NOT EXISTS `prodaja` (
  `SifraS` int(11) NOT NULL,
  `SifraA` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL,
  PRIMARY KEY (`SifraS`,`SifraA`),
  KEY `SifraA` (`SifraA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodaja`
--

INSERT INTO `prodaja` (`SifraS`, `SifraA`, `datum`) VALUES
(22, 1, '2019-05-28 20:28:42'),
(23, 2, '2019-05-28 20:30:40'),
(23, 8, '2019-05-28 20:30:40'),
(25, 7, '2019-05-28 20:35:41'),
(26, 2, '2019-05-28 20:38:00'),
(26, 5, '2019-05-28 20:38:00'),
(27, 8, '2019-05-28 20:39:37'),
(28, 10, '2019-05-28 20:41:09'),
(29, 3, '2019-05-28 21:18:54'),
(29, 10, '2019-05-28 21:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `slike_stanova`
--

DROP TABLE IF EXISTS `slike_stanova`;
CREATE TABLE IF NOT EXISTS `slike_stanova` (
  `sifra` int(11) NOT NULL AUTO_INCREMENT,
  `putanja` varchar(255) NOT NULL DEFAULT 'Uploads/blank.png',
  `SifraS` int(11) NOT NULL,
  PRIMARY KEY (`sifra`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slike_stanova`
--

INSERT INTO `slike_stanova` (`sifra`, `putanja`, `SifraS`) VALUES
(7, 'Uploads/1.jpg', 22),
(8, 'Uploads/kuhnya-gostinaya-dizajn-i-foto.jpg', 23),
(10, 'Uploads/white-sweedish-inspiration9.jpg', 25),
(11, 'Uploads/2.jpg', 26),
(12, 'Uploads/Zakup-stana-Novi-Sad.jpg', 27),
(13, 'Uploads/images.jpg', 28),
(14, 'Uploads/luksuz-enterijer-dizajn-stan-BW.jpg', 29);

-- --------------------------------------------------------

--
-- Table structure for table `stanovi`
--

DROP TABLE IF EXISTS `stanovi`;
CREATE TABLE IF NOT EXISTS `stanovi` (
  `SifraS` int(11) NOT NULL AUTO_INCREMENT,
  `m2` int(11) NOT NULL,
  `Struktura` varchar(11) NOT NULL,
  `Cena` int(11) NOT NULL,
  `SifraK` int(11) DEFAULT NULL,
  `SifraZ` int(11) NOT NULL,
  PRIMARY KEY (`SifraS`),
  KEY `SifraZ` (`SifraZ`),
  KEY `SifraK` (`SifraK`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stanovi`
--

INSERT INTO `stanovi` (`SifraS`, `m2`, `Struktura`, `Cena`, `SifraK`, `SifraZ`) VALUES
(22, 30, 'Jednosoban', 4000, NULL, 1),
(23, 70, 'Dvosoban', 6500, NULL, 3),
(25, 60, 'Dvosoban', 6500, NULL, 1),
(26, 70, 'Dvoiposoban', 8000, NULL, 3),
(27, 20, 'Garsonjera', 3000, NULL, 3),
(28, 50, 'Jednosoban', 9000, NULL, 2),
(29, 90, 'Troiposoban', 10000, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `zgrade`
--

DROP TABLE IF EXISTS `zgrade`;
CREATE TABLE IF NOT EXISTS `zgrade` (
  `SifraZ` int(11) NOT NULL,
  `Ulica` varchar(11) NOT NULL,
  `Broj` int(11) NOT NULL,
  `SifraN` int(11) NOT NULL,
  PRIMARY KEY (`SifraZ`),
  KEY `SifraN` (`SifraN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zgrade`
--

INSERT INTO `zgrade` (`SifraZ`, `Ulica`, `Broj`, `SifraN`) VALUES
(1, 'Cara Lazara', 64, 1),
(2, 'Cara Dusana', 49, 3),
(3, 'Rumenacka', 132, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prodaja`
--
ALTER TABLE `prodaja`
  ADD CONSTRAINT `prodaja_ibfk_1` FOREIGN KEY (`SifraS`) REFERENCES `stanovi` (`SifraS`) ON DELETE CASCADE,
  ADD CONSTRAINT `prodaja_ibfk_2` FOREIGN KEY (`SifraA`) REFERENCES `agenti` (`SifraA`) ON DELETE CASCADE;

--
-- Constraints for table `stanovi`
--
ALTER TABLE `stanovi`
  ADD CONSTRAINT `stanovi_ibfk_1` FOREIGN KEY (`SifraZ`) REFERENCES `zgrade` (`SifraZ`) ON DELETE CASCADE,
  ADD CONSTRAINT `stanovi_ibfk_2` FOREIGN KEY (`SifraK`) REFERENCES `korisnik` (`SifraK`) ON DELETE CASCADE;

--
-- Constraints for table `zgrade`
--
ALTER TABLE `zgrade`
  ADD CONSTRAINT `zgrade_ibfk_1` FOREIGN KEY (`SifraN`) REFERENCES `naselje` (`SifraN`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
