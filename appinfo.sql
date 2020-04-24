-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 avr. 2020 à 12:39
-- Version du serveur :  8.0.18
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
-- Base de données :  `appinfo`
--
CREATE DATABASE IF NOT EXISTS `appinfo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `appinfo`;

-- --------------------------------------------------------

--
-- Structure de la table `boitier`
--

DROP TABLE IF EXISTS `boitier`;
CREATE TABLE IF NOT EXISTS `boitier` (
  `idBoitier` int(8) NOT NULL,
  `idCentre` int(6) NOT NULL,
  PRIMARY KEY (`idBoitier`),
  KEY `idCentre` (`idCentre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `boitier`
--

INSERT INTO `boitier` (`idBoitier`, `idCentre`) VALUES
(86, 1),
(89, 1),
(85, 6),
(50, 21),
(45, 22),
(37, 23),
(12, 24),
(18, 25),
(27, 26),
(28, 26);

-- --------------------------------------------------------

--
-- Structure de la table `centremedical`
--

DROP TABLE IF EXISTS `centremedical`;
CREATE TABLE IF NOT EXISTS `centremedical` (
  `numero` int(6) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `centremedical`
--

INSERT INTO `centremedical` (`numero`, `adresse`, `nom`) VALUES
(1, '45 Avenue du Maine, 75014 Paris', 'Cerballiance - Montparnasse'),
(6, '134B Rue de Vaugirard, 75015 Paris', 'BIOGROUP - Laboratoire Paris Vaugirard'),
(20, '15 rue Nationale, 86000 Poitier ', 'CRP'),
(21, '11 rue des tanneries, 87000 Limoges ', 'CHU de limoges'),
(22, '75 rue de Paris, 75001 Paris', 'Chu de Paris'),
(23, '37 rue bernard palissy, 37000 Tours', 'CHU de Tours'),
(24, 'ok', 'CHU ok'),
(25, '92014 Nanterre', 'CHU de Nanterre'),
(26, '37 rue des poissoniers Bordeaux', 'CHU de Bordeaux');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `idRequete` int(8) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL,
  PRIMARY KEY (`idRequete`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idRequete`, `question`, `reponse`) VALUES
(1, 'Comment allez-vous ?', 'bien, merci'),
(2, 'ça va ?', 'très bien');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `idMedecin` int(8) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(8) NOT NULL,
  `idCentre` int(6) NOT NULL,
  `numeroSS` int(13) NOT NULL,
  PRIMARY KEY (`idMedecin`),
  UNIQUE KEY `numeroSS` (`numeroSS`),
  UNIQUE KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idUtilisateur_2` (`idUtilisateur`),
  KEY `idCentre` (`idCentre`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`idMedecin`, `idUtilisateur`, `idCentre`, `numeroSS`) VALUES
(1, 3, 6, 1111111112),
(2, 4, 1, 1000000000),
(18, 26, 1, 12258746),
(19, 27, 0, 784595),
(20, 28, 0, 888745),
(21, 29, 26, 2147483647),
(22, 30, 22, 8574),
(24, 35, 25, 87779),
(25, 36, 22, 8796541),
(26, 38, 23, 987450),
(27, 40, 24, 784),
(28, 42, 25, 77458),
(29, 44, 26, 879965);

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `idMesure` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(10) NOT NULL,
  `fq` float NOT NULL,
  `temp` float NOT NULL,
  `audio` float NOT NULL,
  `reactivite` float NOT NULL,
  PRIMARY KEY (`idMesure`),
  KEY `idTest` (`idTest`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`idMesure`, `idTest`, `fq`, `temp`, `audio`, `reactivite`) VALUES
(1, 1, 80.2, 36.1, 87, 110),
(2, 3, 67.7, 36.7, 64, 45),
(3, 2, 110.1, 38.9, 90, 80),
(7, 28, 50, 50, 50, 100),
(8, 29, 50, 50, 50, 101),
(9, 30, 50, 50, 50, 50),
(10, 30, 50, 50, 50, 40),
(11, 32, 50, 50, 50, 100),
(12, 33, 50, 50, 50, 80),
(13, 34, 100, 100, 100, 100),
(14, 35, 100, 100, 100, 100),
(15, 36, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `idPatient` int(8) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(8) NOT NULL,
  `idCentre` int(6) NOT NULL,
  `numeroSS` int(13) NOT NULL,
  `idMedecin` int(11) NOT NULL,
  PRIMARY KEY (`idPatient`),
  UNIQUE KEY `numeroSS` (`numeroSS`),
  UNIQUE KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idCentre` (`idCentre`),
  KEY `idCentre_2` (`idCentre`),
  KEY `idUtilisateur_2` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`idPatient`, `idUtilisateur`, `idCentre`, `numeroSS`, `idMedecin`) VALUES
(1, 2, 1, 1234567891, 2),
(2, 5, 2, 1578454612, 0),
(3, 31, 1, 87779845, 2),
(5, 32, 1, 877549641, 2),
(6, 37, 22, 9877451, 25),
(7, 39, 23, 324785, 26),
(8, 41, 24, 8799, 27),
(9, 43, 25, 98556, 28),
(10, 45, 26, 84512, 29);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `idTest` int(10) NOT NULL AUTO_INCREMENT,
  `resultat` float NOT NULL,
  `date` date NOT NULL,
  `idPatient` int(11) NOT NULL,
  `idMedecin` int(11) NOT NULL,
  PRIMARY KEY (`idTest`),
  KEY `idPatient` (`idPatient`),
  KEY `idMedecin` (`idMedecin`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`idTest`, `resultat`, `date`, `idPatient`, `idMedecin`) VALUES
(1, 17.4, '2020-04-12', 2, 1),
(2, 9.9, '2020-04-11', 1, 2),
(3, 12.7, '2020-04-10', 1, 2),
(28, 0, '2020-04-19', 5, 2),
(29, 0, '2020-04-19', 1, 2),
(30, 0, '2020-04-20', 6, 25),
(31, 0, '2020-04-20', 6, 25),
(32, 0, '2020-04-20', 7, 26),
(33, 0, '2020-04-20', 5, 2),
(34, 0, '2020-04-20', 8, 27),
(35, 0, '2020-04-20', 9, 28),
(36, 0, '2020-04-20', 10, 29);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(8) NOT NULL AUTO_INCREMENT,
  `mail` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `role` varchar(16) NOT NULL,
  `motdepasse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mail`, `prenom`, `nom`, `adresse`, `role`, `motdepasse`) VALUES
(1, 'louis.delatullaye@gmail.com', 'Louis', 'de La Tullaye', '13 rue d\'Odessa,75014 Paris', 'administrateur', '123456789'),
(2, 'louis.de-la-tullaye@isep.fr', 'Louis', 'de La Tullaye', '13 rue d\'Odessa, 75014 Paris', 'patient', 'azertyuiop'),
(3, 'louis.de.la.tullaye@gmail.com', 'Louis', 'de La Tullaye', '13 rue d\'Odessa, 75014 Paris', 'medecin', '123aze'),
(4, 'drhouse@isep.fr', 'dr', 'house', '26 rue des enfers', 'medecin', 'imthebest'),
(5, 'patient@0.fr', 'oui', 'le patient', '00 rue de la maladie', 'patient', 'jesuispatient'),
(6, 'louis@gmail.com', 'pierre', 'crozet', '14 rue d\'Odessa,75014 Paris', 'administrateur', '123456789'),
(26, '7845@isep.fr', 'dr Pierre', 'Colomb', '754 rue du cahot', 'medecin', '7845'),
(27, 'delatullaye@gmail.com', 'tyu', 'rte', '78 avenue des tests', 'medecin', 'azertyuiop'),
(28, 'lozzauis.delatullaye@gmail.com', 'aze', 'aze', '13 Rue d\'Odessa', 'medecin', 'aze'),
(29, 'louis.delaazetullaye@gmail.com', 'Louis', 'De La Tullaye', '2 Pierrefitte', 'medecin', 'yui'),
(30, 'louis.delatullaye@laposte.net', 'Louis', 'De La Tullaye', '2 Pierrefitte', 'medecin', '78'),
(31, 'martinRichard@gmail.com', 'Martin', 'Richard', '37 rue Dalou 75015 Paris', 'patient', 'aze'),
(32, 'pierreMenier@g.f', 'Pierre', 'Menier', '87 rue des tanneries', 'patient', 'aze'),
(33, 'admin@infinite.fr', 'admin', 'de Infinite Measures', '18 route des infinies', 'administrateur', 'admin'),
(35, 'bertrandRenard@medecin.fr', 'Bertrand', 'Renard', '78 avenue des tests, 75015 Paris', 'medecin', 'medecin'),
(36, 'romainDucher@isep.fr', 'Romain', 'Ducher', '75 rue de Paris, 75001 Paris', 'medecin', 'medecin'),
(37, 'tanguyBerthoud@isep.fr', 'Tanguy', 'Berthoud', '87 rue des potiers, 75025 Paris', 'patient', '789'),
(38, 'clientDusite@Site.fr', 'client', 'dusite', '87 rue des clients, 87000 Site', 'medecin', '789'),
(39, 'patientLePatient@isep.fr', 'patient', 'LePatient', '87 rue des client, 88000 Site', 'patient', '789'),
(40, 'tyty@ici.fr', 'ok', 'mec', 'tyty', 'medecin', 'tyty'),
(41, 'lui@lui.fr', 'lui', 'ok', 'hihi', 'patient', 'ok'),
(42, 'fdupont@isep.fr', 'francois ', 'dupont', '42 rue de la rue 75015 paris', 'medecin', 'aze'),
(43, 'ouiok@ok.fr', 'oui', 'moi', '87 rue des clients ', 'patient', 'aze'),
(44, 'pierreDupont@chu.fr', 'Pierre', 'Dupont', '87 rues des tanneries', 'medecin', 'aze'),
(45, 'jeanmarie@patient.fr', 'Jean', 'Marie', '87 rue des potiers', 'patient', 'aze');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `medecin_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mesure`
--
ALTER TABLE `mesure`
  ADD CONSTRAINT `mesure_ibfk_1` FOREIGN KEY (`idTest`) REFERENCES `test` (`idTest`);

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`idPatient`) REFERENCES `patient` (`idPatient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`idMedecin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
