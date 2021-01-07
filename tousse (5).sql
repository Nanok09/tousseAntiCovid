-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 jan. 2021 à 21:38
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
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_send` int(11) NOT NULL,
  `id_receive` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `msg` varchar(400) NOT NULL,
  `isMedecin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `id_send`, `id_receive`, `date`, `msg`, `isMedecin`) VALUES
(1, 3, 2, '2021-01-07 17:28:19', 'Bonjour, pourrions nous convenir d\'une date pour vous rendre le vêtement ?', 0),
(2, 2, 3, '2021-01-07 17:28:54', 'Je suis disponible les mardi et mercredi après-midi pour le rendu de vêtements connectés.', 1),
(3, 2, 3, '2021-01-07 21:46:57', 'J\'ai une date mardi prochain.', 1),
(4, 2, 3, '2021-01-07 21:47:49', 'à 16h00', 1),
(5, 2, 3, '2021-01-07 22:20:36', 'Parfait ! Faisons comme ça', 1),
(6, 3, 2, '2021-01-07 22:23:47', 'Parfait ! Faisons comme ça', 0),
(7, 2, 3, '2021-01-07 22:24:59', 'coucou', 1),
(8, 2, 3, '2021-01-07 22:24:59', 'coucou', 1),
(9, 3, 2, '2021-01-07 22:25:58', 'bonjour', 0);

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
  `autre` varchar(300) NOT NULL,
  `date_symp` date NOT NULL COMMENT 'date d''apparition des symptômes',
  `date_depistage` date NOT NULL COMMENT 'date de dépistage',
  `date_fin` date NOT NULL COMMENT 'date de fin d''infection',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `data_pas_vetement`
--

INSERT INTO `data_pas_vetement` (`id`, `id_patient`, `sexe`, `imc`, `antecedent_cv`, `diabete`, `respiratoire_chronique`, `dialyse`, `cancer`, `perte_gout`, `perte_odorat`, `fievre`, `toux`, `autre`, `date_symp`, `date_depistage`, `date_fin`) VALUES
(1, 18, 'M', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'RAS', '2021-01-05', '2021-01-05', '0000-00-00'),
(3, 20, 'F', 20, 0, 0, 1, 0, 0, 1, 1, 1, 0, 'ras', '2021-01-01', '2021-01-01', '0000-00-00');

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
  `passe` varchar(200) NOT NULL,
  `adresse` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `prenom`, `mail`, `tel`, `passe`, `adresse`) VALUES
(1, 'Ettendorf', 'Gilles', 'ettendorf@gillou.com', '0152568936', 'gilles', '1 rue de l\'école, Bonneuil-sur-Marne'),
(2, 'Cimes', 'Michel', 'michou93@gang.gang', '0123456789', 'michel', '666 rue Tumetrouverasjamais, Jsaispasou-en-gohelle');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `nom`, `prenom`, `naissance`, `secu`, `tel`, `mail`, `adresse`, `code_postal`, `passe`, `sexe`, `id_medecin`, `risque`) VALUES
(1, 'Macud', 'Matyas', '1999-09-03', '0', '0', 'macud@macud.com', '1 avenue de la République, Chatillon', 92320, 'macud', 'M', 1, 0),
(3, 'Leleu', 'Tang', '1999-12-19', '0', '0', 'tang@tang.com', '10 clos de villemenon, Brie Comte Robert', 77170, 'tang', 'M', 2, 0),
(4, 'Mange', 'Jean', '1998-12-14', '198129105416395', '652158963', 'jean@mange.fr', '1 rue du pré, Soignolles', 77123, 'jean', 'M', 1, 0),
(5, 'Tran', 'Henri', '1993-12-27', '1931212325404', '0365215487', 'henri@tran.be', '10 rue de l\'aveyron, Bourg-Palette ', 12250, 'lerirejaune', 'N', 2, 0),
(6, 'Tahmouch', 'Sarah', '2000-09-20', '1256487945164', '0612345698', 'sarah@tahmouch@gmail.com', 'ici', 93120, 'sarah', 'F', 2, 0),
(7, 'nom', 'prenom', '2021-01-06', '12345678910', '0123456789', 'mail', 'adresse', 12345, 'passe', 'M', 2, 0),
(8, 'Lesnard', 'Eliot', '1999-03-30', '12345678945', '0656895623', 'yo.lesnard@gmail.com', '2 rue pasteur, Brie Comte Robert', 77170, 'yo', 'M', 1, 0),
(9, 'Guérin', 'Clément', '1999-03-30', '1990377063142', '0123456788', 'clement@guerin.com', '10 rue Pasteur, Brie Comte Robert', 77170, 'clement', 'M', 1, 0),
(10, 'Cochet', 'Corentin', '1999-03-30', '1990377063142', '0123456787', 'corentin@cochet.com', '10 rue Pasteur, Brie Comte Robert', 77170, 'corentin', 'M', 1, 0),
(18, 'Dubernet', 'Lucie', '1999-03-30', '1990377063142', '0123456787', 'lucie@dubernet.com', '10 rue Pasteur, Brie Comte Robert', 77170, 'lucie', 'M', 1, 0),
(20, 'Mas', 'Estelle', '2021-01-01', '0324567895', '7894561230', 'estelle@mas.com', '20 rue des fusilles, Nanterre', 89456, 'estelle', 'F', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
