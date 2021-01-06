-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 06 jan. 2021 à 13:16
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
-- Structure de la table `medecins`
--

DROP TABLE IF EXISTS `medecins`;
CREATE TABLE IF NOT EXISTS `medecins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) NOT NULL,
  `prenom` varchar(300) NOT NULL,
  `mail` varchar(300) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `adresse` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `prenom`, `mail`, `tel`, `adresse`) VALUES
(1, 'Ettendorf', 'Gilles', 'ettendorf@gillou.com', '0152568936', '1 rue de l\'école, Bonneuil-sur-Marne'),
(2, 'Cimes', 'Michel', 'michou93@gang.gang', '0123456789', '666 rue Tumetrouverasjamais, Jsaispasou-en-gohelle');

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
  `secu` varchar(100) NOT NULL COMMENT 'numéro de sécurité sociale',
  `tel` varchar(100) NOT NULL,
  `mail` varchar(300) NOT NULL COMMENT 'adresse électronique du patient',
  `adresse` varchar(500) NOT NULL COMMENT 'adresse postale du patient',
  `code_postal` int(11) NOT NULL COMMENT 'code postal du patient',
  `passe` varchar(200) NOT NULL COMMENT 'mot de passe du patient',
  `sexe` char(10) NOT NULL COMMENT 'sexe du patient (H, F, N)',
  `id_medecin` int(11) NOT NULL COMMENT 'id du médecin traitant',
  `risque` tinyint(1) NOT NULL COMMENT 'précise si le patient est à risque',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `nom`, `prenom`, `naissance`, `secu`, `tel`, `mail`, `adresse`, `code_postal`, `passe`, `sexe`, `id_medecin`, `risque`) VALUES
(1, 'Macud', 'Matyas', '1999-09-03', '0', '0', 'macud@macud.com', '1 avenue de la République, Chatillon', 92320, 'macud', 'M', 1, 0),
(3, 'Leleu', 'Tang', '1999-12-19', '0', '0', 'tang@tang.com', '10 clos de villemenon, Brie Comte Robert', 77170, 'tang', 'M', 2, 0),
(4, 'Mange', 'Jean', '1998-12-14', '198129105416395', '652158963', 'jean@mange.fr', '1 rue du pré, Soignolles', 77123, 'jean', 'M', 1, 0),
(5, 'Tran', 'Henri', '1993-12-27', '1931212325404', '0365215487', 'henri@tran.be', '10 rue de l\'aveyron, Bourg-Palette ', 12250, 'lerirejaune', 'N', 2, 0),
(6, 'Tahmouch', 'Sarah', '2000-09-20', '1256487945164', '0612345698', 'sarah@tahmouch@gmail.com', 'ici', 93120, 'sarah', 'F', 2, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
