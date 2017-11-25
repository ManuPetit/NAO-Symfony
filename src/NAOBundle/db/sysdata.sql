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

INSERT INTO `badges` (`id`, `name`, `image`, `description`) VALUES
(1, 'Nouvel observateur', 'observateur-1.png', '1 observation'),
(2, 'Observateur', 'observateur-2.png', '5+ observations'),
(3, 'Observateur confirmé', 'observateur-3.png', '20+ observations'),
(4, 'Observateur expert', 'observateur-4.png', '50+ observations'),
(5, 'Nouveau photographe', 'photographe-1.png', '1 photo'),
(6, 'Photographe', 'photographe-2.png', '10+ photos'),
(7, 'Photographe confirmé', 'photographe-3.png', '50+ photos'),
(8, 'Photographe expert', 'photographe-4.png', '100+ photos'),
(9, 'Nouveau membre', 'anciennete-1.png', 'inscription'),
(10, 'Membre', 'anciennete-2.png', '6+ mois'),
(11, 'Membre confirmé', 'anciennete-3.png', '1+ an'),
(12, 'Membre expert', 'anciennete-4.png', '2+ ans');

--
-- Déchargement des données de la table `main_statuses`
--

INSERT INTO `main_statuses` (`id`, `name`, `verb`) VALUES
(1, 'Brouillon', 'Enregistrer'),
(2, 'En attente de validation', 'Attendre validation'),
(3, 'Publié', 'Publier'),
(4, 'Masqué', 'Masquer'),
(5, 'Supprimé', 'Supprimer');

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

INSERT INTO `user_statuses` (`id`, `name`, `verb`) VALUES
(1, 'Actif', 'Activer'),
(2, 'Inactif', 'Désactiver'),
(3, 'Supprimé', 'Supprimer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
