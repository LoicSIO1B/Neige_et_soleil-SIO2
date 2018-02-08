--
-- Structure de la table `calendrier_V4`
--

CREATE TABLE IF NOT EXISTS `calendrier_V4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `couleur` text NOT NULL,
  `couleur_texte` text NOT NULL,
  `id_logement` int(11) NOT NULL,
  `id_locataire` bigint(20) NOT NULL,
  `tarif` tinytext NOT NULL,
  `commentaires` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `calendrier_V4`
--
