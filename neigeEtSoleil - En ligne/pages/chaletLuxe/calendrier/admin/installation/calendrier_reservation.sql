-- phpMyAdmin SQL Dump


SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `calendrier` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `couleur` text NOT NULL,
  `couleur_texte` text NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_locataire` bigint(20) NOT NULL,
  `tarif` tinytext NOT NULL,
  `commentaires` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `calendrier`
--

