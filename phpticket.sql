-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 20 avr. 2022 à 21:41
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpticket`
--

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `salle` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `dates` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('en attente','non traité','résolu') NOT NULL DEFAULT 'en attente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `nom`, `prénom`, `email`, `sujet`, `type`, `salle`, `msg`, `dates`, `statut`) VALUES
(2, 'Oblak', 'Jan', 'janoblak@gmail.com', 'Probleme pc', 'informatique', '117', 'qergegqeg', '2022-04-19 12:15:34', 'résolu'),
(3, 'qzfe', 'qzef', 'daz@gmail.com', 'qzg', 'qerg', '001', 'ergqeg', '2022-04-19 12:50:20', 'non traité'),
(4, 'azd ', 'azd', 'nathan.deroche@epsi.fr', 'azda', 'azd', '111', 'qzf', '2022-04-20 10:57:04', 'résolu'),
(5, 'qeg', 'qerg', 'nathan.deroche@epsi.fr', 'erg', 'egrr', '111', 'ezrg', '2022-04-20 11:02:14', 'résolu');

-- --------------------------------------------------------

--
-- Structure de la table `tickets_comments`
--

DROP TABLE IF EXISTS `tickets_comments`;
CREATE TABLE IF NOT EXISTS `tickets_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `dates` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tickets_comments`
--

INSERT INTO `tickets_comments` (`id`, `ticket_id`, `msg`, `dates`) VALUES
(1, 1, 'commentaire blabla', '2020-06-10 16:23:39'),
(2, 1, 'ianzidi ta grand mere\r\n', '2022-04-19 11:30:35'),
(3, 5, 'edrge', '2022-04-20 23:25:15');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `token` text NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `email`, `password`, `ip`, `token`, `date_inscription`) VALUES
(4, 'test', 'test@test.fr', '$2y$13$iPtutaVYdye7WgHcKbDAZOSa0ERvDU0p8vT8ZOtg99.eb9TM.UbY2', '::1', '49614bd5edfd11f76447411ab64503cbe99b649ccb710eb46c90ec7beaeae168618683fe7fe095968f7b341f9029028a3949f353467c0067c585204c6cf11f1e', '2022-04-14 16:52:15'),
(5, 'nana64', 'nathan.deroche@epsi.fr', '$2y$13$dRVK3nBwOS1bp5/6wL4jv.D6a7.eN6AqbNqSDA.aIOUz/IF4PwU5y', '::1', '2b949ec66a02f0f8740922e24860420b88a2e914c9b922ed9218a98f525428fde7195a7b4e15b228600a18989bbd9c63d477dcea5277aea90cb5ab71a1a624af', '2022-04-20 22:13:51'),
(6, 'axelito', 'axel.depoitre@epsi.fr', '$2y$13$ZIFM6.LlMIj6k3B6cl0FNuty6FS8iqXcQTCeJa81Mbo2CmMnj/ZUa', '::1', 'a7974d67e543e0b881251ba7387f572e5934909ebe4b4f7c3b7150ebe7d02544ae65de7c49cc3315292eb4dcae9cbe63d53424797f088064a1f51bc6524222e0', '2022-04-20 22:14:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
