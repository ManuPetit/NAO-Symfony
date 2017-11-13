-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 11 nov. 2017 à 11:18
-- Version du serveur :  10.1.25-MariaDB
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Déchargement des données de la table `badges`
--

INSERT INTO `badges` (`id`, `name`, `image`) VALUES
(1, 'Nouvel observateur', 'observateur-1.png'),
(2, 'Observateur', 'observateur-2.png'),
(3, 'Observateur confirmé', 'observateur-3.png'),
(4, 'Observateur expert', 'observateur-4.png'),
(5, 'Nouveau photographe', 'photographe-1.png'),
(6, 'Photographe', 'photographe-2.png'),
(7, 'Photographe confirmé', 'photographe-3.png'),
(8, 'Photographe expert', 'photographe-4.png'),
(9, 'Nouveau membre', 'anciennete-1.png'),
(10, 'Membre', 'anciennete-2.png'),
(11, 'Membre confirmé', 'anciennete-3.png'),
(12, 'Membre expert', 'anciennete-4.png');

--
-- Déchargement des données de la table `main_statuses`
--

INSERT INTO `main_statuses` (`id`, `name`) VALUES
(1, 'Brouillon'),
(2, 'En attente de validation'),
(3, 'Publié'),
(4, 'Masqué'),
(5, 'Supprimé');

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `current_name`) VALUES
(1, 'ROLE_ADMIN', 'Administrateur'),
(2, 'ROLE_PRO', 'Naturaliste'),
(3, 'ROLE_MEMBRE', 'Membre');

--
-- Déchargement des données de la table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`) VALUES
(1, 'Actif'),
(2, 'Inactif'),
(3, 'Supprimé');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
