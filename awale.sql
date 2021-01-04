-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 17 sep. 2020 à 12:33
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `awale`
--

-- --------------------------------------------------------

--
-- Structure de la table `combat`
--

DROP TABLE IF EXISTS `combat`;
CREATE TABLE IF NOT EXISTS `combat` (
  `id_joueur_1` int(11) NOT NULL,
  `id_joueur_2` int(11) NOT NULL,
  `id_match` int(11) NOT NULL AUTO_INCREMENT,
  `id_vaincqueur` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_match`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id_conversation` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_conversation`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id_conversation`, `theme`, `id_createur`, `date_creation`, `active`) VALUES
(1, 'La cuisine', 1, '2020-06-04', 1),
(2, 'Le sport', 5, '2020-06-04', 1),
(3, 'Le cinéma', 5, '2020-06-09', 1),
(4, 'Les voitures', 5, '2020-06-10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) DEFAULT 0,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL DEFAULT current_timestamp(),
  `date_naissance` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `rang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `admin`, `pseudo`, `pass`, `email`, `date_inscription`, `date_naissance`, `bio`, `pays`, `photo`, `rang`) VALUES
(1, 0, 'alexandre', '$2y$10$aa5QkEkHnfHKPOlSZDf6OuaBKTjbSwnpcFR47.Rnv2fnDU.aKSciq', 'alexandre.caumette@gmail.com', '2020-04-19', '1999-01-10', 'Ce site est super cool !', 'france', 'f0aecdc3c97922ad221360af31cd047a.jpg', 2),
(2, 0, 'ines', '$2y$10$f2x3sv8qmwqzV3CcUaagfe.AkCKKkPj/eIfdUGQG8Jwk5ta1sdsaG', 'mallevalines@gmail.com', '2020-04-19', '0000-00-00', '', '', '', 1),
(3, 0, 'wilfrid', '$2y$10$05MG7mywldNk060k4cTknu7R1HRZZbV4.FdH73V1YQ5oAdnrIbtT.', 'wilfrid.caumette@laposte.net', '2020-04-19', '0000-00-00', '', '', '', 3),
(4, 0, 'benjamin', '$2y$10$v2UhXNMx./HWR9DBQCGHfObusvfqshy67/8nF/mm3YF58BEuZLmd.', 'benjamin@gmail.com', '2020-04-19', '0000-00-00', '', '', '', 4),
(5, 0, 'luffy', 'fleur', 'luffy@gmail.com', '2020-06-02', NULL, 'Je suis un personnage de Manga.', 'japon', '77362.jpg', NULL),
(6, 0, 'hamtaro', 'pommedeterre', 'pommedeterre@mnms.fr', '2020-06-10', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_message`),
  KEY `num conversation` (`id_conversation`),
  KEY `num utilisateur` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_conversation`, `id_user`, `contenu`, `date_envoi`) VALUES
(25, 1, 5, 'bonjour les viewers', '2020-06-04 17:47:14'),
(26, 1, 5, 'je vais faire un gâteau', '2020-06-04 17:52:05'),
(27, 2, 5, 'Je m\'appelle sport', '2020-06-08 13:09:29'),
(28, 3, 5, 'Forest Gump', '2020-06-09 13:36:29'),
(29, 1, 6, 'mon message', '2020-06-10 13:32:13'),
(30, 1, 5, 'Test vidéo', '2020-06-11 13:29:20');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `contenu`) VALUES
(1, 'Coronavirus', 'une épidémie de coronavirus se répand dans le monde entier'),
(2, 'bourse', 'la bourse s\'effondre à cause de la pandémie mondiale '),
(3, 'santé', 'de nombreux décés dans les EPHAD');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `num conversation` FOREIGN KEY (`id_conversation`) REFERENCES `conversations` (`id_conversation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `num utilisateur` FOREIGN KEY (`id_user`) REFERENCES `membres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
