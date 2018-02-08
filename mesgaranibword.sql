-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 21 déc. 2017 à 13:57
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mesgaranibword`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

DROP TABLE IF EXISTS `appartement`;
CREATE TABLE IF NOT EXISTS `appartement` (
  `idAppart` int(6) NOT NULL AUTO_INCREMENT,
  `nomAppartement` varchar(30) DEFAULT NULL,
  `numImmeuble` varchar(5) DEFAULT NULL,
  `adresAppart` varchar(20) NOT NULL,
  `CPAppart` int(5) NOT NULL,
  `villAppart` varchar(20) NOT NULL,
  `dispoDebut` date DEFAULT NULL,
  `dispoFin` date DEFAULT NULL,
  `type` char(2) NOT NULL,
  `prix` int(6) NOT NULL,
  PRIMARY KEY (`idAppart`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`idAppart`, `nomAppartement`, `numImmeuble`, `adresAppart`, `CPAppart`, `villAppart`, `dispoDebut`, `dispoFin`, `type`, `prix`) VALUES
(1, 'lesmolines', '245', '25 place napoleon', 5350, 'molines-en-queyras', '2016-08-31', '2017-08-31', 'as', 700),
(2, 'leChateauvielleville', '246', '25 place napoleon', 5350, 'chateau-vile-vielle', '2016-08-31', '2017-08-31', 'ad', 700),
(3, 'lesceillac', '247', '25 place napoleon', 5350, 'ceillac', '2016-08-31', '2017-08-31', 'ad', 700),
(4, 'leristolas', '248', '25 place napoleon', 5350, 'ristolas', '2016-08-31', '2017-08-31', 'as', 700),
(5, 'lesabries', '248', '25 place napoleon', 5350, 'abries', '2016-08-31', '2017-08-31', 'as', 700);

-- --------------------------------------------------------

--
-- Structure de la table `contratlocation`
--

DROP TABLE IF EXISTS `contratlocation`;
CREATE TABLE IF NOT EXISTS `contratlocation` (
  `IDContratLoc` int(9) NOT NULL AUTO_INCREMENT,
  `DebutContratLoc` date DEFAULT NULL,
  `FinContratLoc` date DEFAULT NULL,
  PRIMARY KEY (`IDContratLoc`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contratlocation`
--

INSERT INTO `contratlocation` (`IDContratLoc`, `DebutContratLoc`, `FinContratLoc`) VALUES
(1, '2017-03-22', '2017-10-05'),
(2, '2017-01-02', '2017-12-01'),
(3, '2017-06-10', '2017-12-02'),
(4, '2017-04-10', '2017-09-16'),
(5, '2017-02-18', '2017-11-16');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `IDEquip` int(6) NOT NULL AUTO_INCREMENT,
  `nomEquip` varchar(30) NOT NULL,
  `descripEquip` varchar(250) NOT NULL,
  `tarif` float NOT NULL,
  `IDClient` int(6) NOT NULL,
  PRIMARY KEY (`IDEquip`),
  KEY `IDClient` (`IDClient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `IDLieu` int(6) NOT NULL AUTO_INCREMENT,
  `DescripLieu` varchar(200) DEFAULT NULL,
  `prixMin` int(6) DEFAULT NULL,
  `prixMax` int(6) DEFAULT NULL,
  PRIMARY KEY (`IDLieu`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`IDLieu`, `DescripLieu`, `prixMin`, `prixMax`) VALUES
(1, 'local', 320, 480),
(2, 'studio', 210, 560),
(3, 'commune', 340, 670),
(4, 'local', 100, 400),
(5, 'studio', 200, 500);

-- --------------------------------------------------------

--
-- Structure de la table `majorer`
--

DROP TABLE IF EXISTS `majorer`;
CREATE TABLE IF NOT EXISTS `majorer` (
  `IDsaison` int(1) NOT NULL,
  `IDAppart` int(6) NOT NULL,
  `majoPrix` float DEFAULT NULL,
  PRIMARY KEY (`IDsaison`,`IDAppart`),
  KEY `IDAppart` (`IDAppart`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `motdepasse` text NOT NULL,
  `adresse` varchar(20) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

DROP TABLE IF EXISTS `proprietaire`;
CREATE TABLE IF NOT EXISTS `proprietaire` (
  `idPro` int(9) NOT NULL AUTO_INCREMENT,
  `nomPro` varchar(30) NOT NULL,
  `prenomPro` varchar(30) NOT NULL,
  `adressPro` varchar(30) DEFAULT NULL,
  `cpPro` int(5) DEFAULT NULL,
  `villePro` varchar(25) DEFAULT NULL,
  `telephonePro` varchar(13) NOT NULL,
  `mailPro` varchar(50) NOT NULL,
  `motdepassePro` text NOT NULL,
  PRIMARY KEY (`idPro`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `representant`
--

DROP TABLE IF EXISTS `representant`;
CREATE TABLE IF NOT EXISTS `representant` (
  `IDRepre` int(9) NOT NULL AUTO_INCREMENT,
  `NomRepre` varchar(30) NOT NULL,
  `PrenomRepre` varchar(30) NOT NULL,
  `TelRepre` varchar(13) NOT NULL,
  `MailRepre` varchar(50) NOT NULL,
  `mdprepre` text NOT NULL,
  `ContratDemarDebut` date DEFAULT NULL,
  `ContratDemarFin` date DEFAULT NULL,
  PRIMARY KEY (`IDRepre`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `representant`
--

INSERT INTO `representant` (`IDRepre`, `NomRepre`, `PrenomRepre`, `TelRepre`, `MailRepre`, `mdprepre`, `ContratDemarDebut`, `ContratDemarFin`) VALUES
(1, 'London', 'Jack', '0725684523', 'jack.london@gmail.com', 'bbbbb', '2014-07-05', '2020-08-15'),
(2, 'Dupont', 'Henri', '0746783425', 'henri.dupont@gmail.com', 'ccccc', '2014-03-27', '2020-11-02'),
(3, 'Arles', 'Robert', '0745678932', 'robert.arles@gmail.com', 'ddddd', '2011-03-22', '2017-04-15'),
(4, 'Charles', 'Pierre', '0756794312', 'pierre.charles@gmail.com', 'eeeee', '2010-12-23', '2020-10-28'),
(5, 'Xavier', 'Charles', '0734786521', 'charles.xavier@gmail.com', 'fffff', '2010-09-14', '2020-11-03');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `IDResa` int(9) NOT NULL AUTO_INCREMENT,
  `descripReserv` varchar(20) DEFAULT NULL,
  `date_reservation` date DEFAULT NULL,
  `date_fin_reservation` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `payee` tinyint(1) DEFAULT NULL,
  `id_logement` int(6) DEFAULT NULL,
  PRIMARY KEY (`IDResa`),
  KEY `id_logement` (`id_logement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservationmateriel`
--

DROP TABLE IF EXISTS `reservationmateriel`;
CREATE TABLE IF NOT EXISTS `reservationmateriel` (
  `IDResa` int(9) NOT NULL AUTO_INCREMENT,
  `date_reservation` date DEFAULT NULL,
  `date_fin_reservation` date DEFAULT NULL,
  `IDEquip` int(6) NOT NULL,
  PRIMARY KEY (`IDResa`,`IDEquip`),
  KEY `IDEquip` (`IDEquip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `IDsaison` int(1) NOT NULL,
  PRIMARY KEY (`IDsaison`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`IDsaison`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Structure de la table `sousloc`
--

DROP TABLE IF EXISTS `sousloc`;
CREATE TABLE IF NOT EXISTS `sousloc` (
  `IDContratSousLoc` int(6) NOT NULL AUTO_INCREMENT,
  `SousLocDebut` date DEFAULT NULL,
  `SousLocFin` date DEFAULT NULL,
  PRIMARY KEY (`IDContratSousLoc`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sousloc`
--

INSERT INTO `sousloc` (`IDContratSousLoc`, `SousLocDebut`, `SousLocFin`) VALUES
(1, '2015-03-10', '2016-06-24'),
(2, '2016-02-10', '2016-12-29'),
(3, '2015-10-11', '2016-08-15'),
(4, '2015-02-20', '2016-06-30'),
(5, '2016-02-28', '2016-10-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
