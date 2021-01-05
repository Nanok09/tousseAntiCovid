-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 05 jan. 2021 à 08:27
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tousse`
--

-- --------------------------------------------------------

--
-- Structure de la table `data_pas_vetement`
--

DROP TABLE IF EXISTS `data_pas_vetement`;
CREATE TABLE IF NOT EXISTS `data_pas_vetement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `sexe` char(10) NOT NULL,
  `imc` int(11) NOT NULL,
  `antecedent_cv` tinyint(1) NOT NULL COMMENT 'présence d''antécédents cardio vasculaires',
  `diabete` tinyint(1) NOT NULL,
  `respiratoire_chronique` tinyint(1) NOT NULL COMMENT 'présence de troubles respiratoires chroniques',
  `dialyse` tinyint(1) NOT NULL,
  `cancer` tinyint(1) NOT NULL,
  `perte_gout` tinyint(1) NOT NULL,
  `perte_odorat` tinyint(1) NOT NULL,
  `fievre` tinyint(1) NOT NULL,
  `toux` tinyint(1) NOT NULL,
  `autre` tinyint(1) NOT NULL,
  `date_symp` date NOT NULL COMMENT 'date d''apparition des symptômes',
  `date_depistage` date NOT NULL COMMENT 'date de dépistage',
  `date_fin` date NOT NULL COMMENT 'date de fin d''infection',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `data_vetement`
--

DROP TABLE IF EXISTS `data_vetement`;
CREATE TABLE IF NOT EXISTS `data_vetement` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de l''entrée de données',
  `id_patient` int(11) NOT NULL COMMENT 'id du patient concerné par les données',
  `temp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'température du corps' CHECK (json_valid(`temp`)),
  `toux_seche` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'précise si le patient est sujet à une toux sèche' CHECK (json_valid(`toux_seche`)),
  `rythme_respiratoire` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rythme_respiratoire`)),
  `allongement_tissus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`allongement_tissus`)),
  `oxygenation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`oxygenation`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du patient',
  `nom` varchar(200) NOT NULL COMMENT 'nom du patient',
  `prenom` varchar(200) NOT NULL COMMENT 'prénom du patient',
  `naissance` date NOT NULL COMMENT 'date de naissance du patient',
  `mail` varchar(300) NOT NULL COMMENT 'adresse électronique du patient',
  `adresse` varchar(500) NOT NULL COMMENT 'adresse postale du patient',
  `code postal` int(11) NOT NULL COMMENT 'code postal du patient',
  `passe` varchar(200) NOT NULL COMMENT 'mot de passe du patient',
  `sexe` char(10) NOT NULL COMMENT 'sexe du patient (H, F, N)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
