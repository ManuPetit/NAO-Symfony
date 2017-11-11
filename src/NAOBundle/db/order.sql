-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 11 nov. 2017 à 10:55
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
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `name`) VALUES
(1, 'Accipitriformes'),
(2, 'Anseriformes'),
(3, 'Bucerotiformes'),
(4, 'Caprimulgiformes'),
(5, 'Charadriiformes'),
(6, 'Columbiformes'),
(7, 'Coraciiformes'),
(8, 'Cuculiformes'),
(9, 'Eurypygiformes'),
(10, 'Falconiformes'),
(11, 'Galliformes'),
(12, 'Gaviiformes'),
(13, 'Gruiformes'),
(14, 'Leptosomatiformes'),
(15, 'Opisthocomiformes'),
(16, 'Otidiformes'),
(17, 'Passeriformes'),
(18, 'Pelecaniformes'),
(19, 'Phaethontiformes'),
(20, 'Phoenicopteriformes'),
(21, 'Piciformes'),
(22, 'Podicipediformes'),
(23, 'Procellariiformes'),
(24, 'Psittaciformes'),
(25, 'Pterocliformes'),
(26, 'Sphenisciformes'),
(27, 'Strigiformes'),
(28, 'Tinamiformes'),
(29, 'Trogoniformes');

--
-- Déchargement des données de la table `families`
--

INSERT INTO `families` (`id`, `name`, `order_id`) VALUES
(1, 'Accipitridae', 1),
(2, 'Aegithalidae', 17),
(3, 'Aegothelidae', 4),
(4, 'Alaudidae', 17),
(5, 'Alcedinidae', 7),
(6, 'Alcidae', 5),
(7, 'Anatidae', 2),
(8, 'Anhimidae', 2),
(9, 'Anhingidae', 18),
(10, 'Apodidae', 4),
(11, 'Aramidae', 13),
(12, 'Ardeidae', 18),
(13, 'Artamidae', 17),
(14, 'Bombycillidae', 17),
(15, 'Bucconidae', 21),
(16, 'Burhinidae', 5),
(17, 'Cacatuidae', 24),
(18, 'Calcariidae', 17),
(19, 'Campephagidae', 17),
(20, 'Capitonidae', 21),
(21, 'Caprimulgidae', 4),
(22, 'Cardinalidae', 17),
(23, 'Cathartidae', 1),
(24, 'Certhiidae', 17),
(25, 'Charadriidae', 5),
(26, 'Chionidae', 5),
(27, 'Ciconiidae', 18),
(28, 'Cinclidae', 17),
(29, 'Cisticolidae', 17),
(30, 'Columbidae', 6),
(31, 'Conopophagidae', 17),
(32, 'Coraciidae', 7),
(33, 'Corvidae', 17),
(34, 'Cotingidae', 17),
(35, 'Cracidae', 11),
(36, 'Cuculidae', 8),
(37, 'Diomedeidae', 23),
(38, 'Donacobiidae', 17),
(39, 'Emberizidae', 17),
(40, 'Estrildidae', 17),
(41, 'Eurypygidae', 9),
(42, 'Falconidae', 10),
(43, 'Formicariidae', 17),
(44, 'Fregatidae', 18),
(45, 'Fringillidae', 17),
(46, 'Furnariidae', 17),
(47, 'Galbulidae', 21),
(48, 'Gaviidae', 12),
(49, 'Glareolidae', 5),
(50, 'Grallariidae', 17),
(51, 'Gruidae', 13),
(52, 'Haematopodidae', 5),
(53, 'Heliornithidae', 13),
(54, 'Hirundinidae', 17),
(55, 'Hydrobatidae', 23),
(56, 'Icteridae', 17),
(57, 'Jacanidae', 5),
(58, 'Laniidae', 17),
(59, 'Laridae', 5),
(60, 'Leiothrichidae', 17),
(61, 'Leptosomatidae', 14),
(62, 'Megapodiidae', 11),
(63, 'Meliphagidae', 17),
(64, 'Meropidae', 7),
(65, 'Mimidae', 17),
(66, 'Momotidae', 7),
(67, 'Monarchidae', 17),
(68, 'Motacillidae', 17),
(69, 'Muscicapidae', 17),
(70, 'Nectariniidae', 17),
(71, 'Numididae', 11),
(72, 'Nyctibiidae', 4),
(73, 'Oceanitidae', 23),
(74, 'Odontophoridae', 11),
(75, 'Opisthocomidae', 15),
(76, 'Oriolidae', 17),
(77, 'Otididae', 16),
(78, 'Oxyruncidae', 17),
(79, 'Pandionidae', 1),
(80, 'Pardalotidae', 17),
(81, 'Paridae', 17),
(82, 'Parulidae', 17),
(83, 'Passeridae', 17),
(84, 'Pelecanidae', 18),
(85, 'Petroicidae', 17),
(86, 'Phaethontidae', 19),
(87, 'Phalacrocoracidae', 18),
(88, 'Phasianidae', 11),
(89, 'Phoenicopteridae', 20),
(90, 'Picidae', 21),
(91, 'Pipridae', 17),
(92, 'Ploceidae', 17),
(93, 'Podicipedidae', 22),
(94, 'Polioptilidae', 17),
(95, 'Procellariidae', 23),
(96, 'Prunellidae', 17),
(97, 'Psittacidae', 24),
(98, 'Psophiidae', 13),
(99, 'Pteroclidae', 25),
(100, 'Pycnonotidae', 17),
(101, 'Rallidae', 13),
(102, 'Ramphastidae', 21),
(103, 'Recurvirostridae', 5),
(104, 'Regulidae', 17),
(105, 'Remizidae', 17),
(106, 'Rhynochetidae', 9),
(107, 'Saxicolidae', 17),
(108, 'Scolopacidae', 5),
(109, 'Sittidae', 17),
(110, 'Spheniscidae', 26),
(111, 'Steatornithidae', 4),
(112, 'Stercorariidae', 5),
(113, 'Strigidae', 27),
(114, 'Sturnidae', 17),
(115, 'Sulidae', 18),
(116, 'Sylviidae', 17),
(117, 'Sylviornithidae', 11),
(118, 'Thamnophilidae', 17),
(119, 'Thraupidae', 17),
(120, 'Threskiornithidae', 18),
(121, 'Tichodromadidae', 17),
(122, 'Tinamidae', 28),
(123, 'Tityridae', 17),
(124, 'Trochilidae', 4),
(125, 'Troglodytidae', 17),
(126, 'Trogonidae', 29),
(127, 'Turdidae', 17),
(128, 'Turnicidae', 5),
(129, 'Tyrannidae', 17),
(130, 'Tytonidae', 27),
(131, 'Upupidae', 3),
(132, 'Viduidae', 17),
(133, 'Vireonidae', 17),
(134, 'Zosteropidae', 17);

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `name`) VALUES
(1, 'Marin'),
(2, 'Eau douce'),
(3, 'Terrestre'),
(4, 'Marin et Eau douce'),
(5, 'Marin et Terrestre'),
(6, 'Eau saumâtre'),
(7, 'Continental (terrestre et/ou eau douce)'),
(8, 'Continental (terrestre et eau douce)');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
