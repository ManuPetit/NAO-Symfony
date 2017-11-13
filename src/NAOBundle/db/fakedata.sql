-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 13 nov. 2017 à 16:30
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_status_id`, `email`, `login`, `mdp`, `salt`, `town`, `phone`, `avatar`, `date_joined`) VALUES
(1, 1, 1, 'michel.dujardin@gmail.com', 'michel', 'michel', 'michel', 'Rémuzat', '04 75 27 18 12', 'mdujardin.jpg', '2017-04-02'),
(2, 2, 1, 'pierre@free.fr', 'pierre', 'pierre', 'pierre', 'Saintes Maries de la Mer', NULL, 'pontdugau.jpg', '2017-08-12'),
(3, 3, 1, 'e.vernay@laposte.net', 'emily', 'emily', 'emily', 'Fontainebleau', '0633524568', 'evernay.jpg', '2017-08-24'),
(4, 3, 2, 'georges@live.fr', 'georges', 'georges', 'georges', 'Arnay le Duc', '0685652452', 'georges.png', '2017-08-12'),
(5, 3, 3, 'fanfan@gmail.com', 'françois', 'françois', 'françois', 'Reims', NULL, NULL, '2017-07-04'),
(6, 2, 1, 'carole@live.fr', 'carole', 'carole', 'carole', 'Bourg en Bresse', NULL, 'carole.jpg', '2017-06-25'),
(7, 3, 1, 'dominique@sfr.fr', 'doumé', 'doumé', 'doumé', 'Cargèse', '0495452352', 'doume.jpg', '2017-07-14'),
(8, 3, 1, 'gina@free.fr', 'gina', 'gina', 'gina', NULL, NULL, 'gina.jpg', '2017-08-01');

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `main_status_id`, `user_id`, `title`, `content`, `date`) VALUES
(1, 3, 1, 'Histoire de notre association', '<p>En 2000, je participais au tournage du film \"Le peuple migrateur\" en tant que conseiller technique. C\'est là, que je rencontrais le musicien percussionniste Laurent Julia, lui aussi passionné d\'oiseaux. Nous nous lions d\'amitié l\'un pour l\'autre.</p><p>En 2003, Laurent me convint de me lancer dans le monde associatif, et avec Jean Pierre Bouvier, nous créons \"Nos Amis Les Oiseaux\".</p><p>Nous commençons par nous occuper principalement de la protection de la faune sauvage et de ses biotopes dans les départements de la Drôme et de l’Isère. A partir de 2007, l\'association prend un nouvel essor en prenant une envergure nationale.</p><p>Un an plus tard, notre association a enfin la possibilité d’agir pour la sauvegarde de la nature dans le cadre défini par son objet, y compris le cas échéant en saisissant quelque juridiction que ce soit. Nous prenons également part à la réalisation d’expertises scientifiques.</p><p>En 2017, j\'ai souhaité ouvrir notre association au plus grand nombre, et c\'est pour cela que ce site internet a été mis en place, pour permettre la collecte d\'observation d\'oiseaux sur le territoire par tous les passionnés d\'oiseaux.</p><p>A vous de faire vivre ce site...</p>\r\n', '2017-10-24 00:00:00'),
(2, 3, 6, 'Choisir ses jumelles', '<p>Pour l\'ornithologie et observer la nature en général, les jumelles de format 10x42 sont idéales. Le facteur de grossissement 10x est favorable pour les oiseaux, sujets de petite taille et qui ne se laissent pas approcher. Le diamètre de 42 mm donne une très bonne luminosité pour l’utilisation de jour, tout en permettant aux jumelles de rester assez légères : 700 gr environ.</p><p>Des jumelles avec une mise au point minimale de 5 mètres ou moins conviendront parfaitement pour observer les oiseaux et autres animaux. Ceux qui préfèrent avoir une vision plus large, quitte à grossir un peu moins pourront opter pour des jumelles universelles de format 8x42. Et ceux qui aiment combiner un peu plus de luminosité avec le grossissement 10x choisiront le format 10x52.</p>', '2017-10-27 00:00:00'),
(3, 3, 2, 'Observer les oiseaux', '<p>Voir est une chose, identifier une autre. Un guide d\'identification est le complément indispensable. Les classiques, disponibles dans toutes les grandes librairies sont le Peterson, le Jonsson, le Heinzel et le Svenson ( intitulé Le guide ornitho ) dernier paru que la plupart des pratiquants considèrent comme le meilleur actuellement.</p><p>Quand observer les oiseaux ? Toute l\'année! Quant aux nicheurs, le printemps, on s\'en doute, est le point fort. Il commence dès la fin février, par exemple pour le hibou moyen-duc et la mésange à longue queue, pour atteindre son apogée en avril et mai. À cette période, leur activité intense de construction des nids et de nourrissage des couvées, oblige les oiseaux à se découvrir plus que d\'habitude.</p><p>Les migrations d\'automne qui commencent en juillet et s\'étalent jusqu\'en novembre donnent lieu à des observations qui se substituent avantageusement à ceux du printemps, tant du point des espèces de passage à découvrir que des groupes massifs et spectaculaires en vol.</p><p>Où voir les oiseaux ? Partout pour les plus communs, à grande plasticité écologique, comme le pinson des arbres, le rougegorge, le chardonneret etc. Dans les milieux adéquats voire exclusifs pour bien d\'autres, comme les oiseaux d\'eau, dont la variété des canards, fuligules, échassiers etc.</p>', '2017-11-01 00:00:00'),
(4, 1, 6, 'Trucs et astuces', '<p>Bien connaître les oiseaux communs</p><p>Être habitué de voir les oiseaux communs, ça aide à les reconnaître. Quand on voit un oiseau qui ne correspond pas à ce qu’on est habitué de voir, alors on s’arrête et on regarde de plus près.</p><p>Apprendre les oiseaux communs, c’est probablement la première chose que vous ferez. N’oubliez pas que cela restera toujours pratique pour vous, même quand vous serez un pro!</p>', '2017-11-13 00:00:00');

--
-- Déchargement des données de la table `blog_image`
--

INSERT INTO `blog_image` (`id`, `post_id`, `file`) VALUES
(1, 1, 'xqs856mol.jpg'),
(2, 1, 'dhf878kil85.jpg'),
(3, 2, 'po78mlo69m.jpg'),
(4, 3, 'iuk74pol653nh.jpg'),
(5, 3, '45df74Kil.jpg'),
(6, 3, 'pokIlJ78Mol5.jpg');

--
-- Déchargement des données de la table `observations`
--

INSERT INTO `observations` (`id`, `user_id`, `bird_id`, `main_status_id`, `date`, `title`, `content`, `latitude`, `longitude`, `place`) VALUES
(1, 3, 1062, 3, '2017-08-25 00:00:00', 'Mésange à Coubon', 'Observation faite près du Puy en Velay dans le jardin d\'une amie.', '45.021631', '3.962909', 'Coubon'),
(2, 8, 2418, 3, '2017-09-04 00:00:00', 'Moineau dans mon jardin', NULL, '48.453003', '-0.484892', 'Lassay les Châteaux'),
(3, 1, 3290, 3, '2017-10-16 00:00:00', 'Chouette Hulotte', NULL, '44.380885', '5.430322', 'Verclause'),
(4, 8, 1062, 3, '2017-10-08 00:00:00', 'Mésange en ', NULL, '48.387012', '-1.173717', 'Laignelet'),
(5, 2, 2570, 3, '2017-09-29 00:00:00', 'Flamant Rose', 'Magnifique spécimens sur les étangs de Camargue ', '43.573141', '4.545368', 'Arles'),
(6, 7, 2418, 3, '2017-10-11 00:00:00', 'Moineau domestique', 'Près de l\'aéroport', '41.934122', '8.786203', 'Ajaccio'),
(7, 7, 3290, 3, '2017-11-03 00:00:00', 'La chouette', NULL, '41.975388', '8.894508', 'Cuttoli-Corticchiato'),
(8, 3, 2418, 3, '2017-10-11 00:00:00', 'Moineau', 'dans la forêt', '48.356386', '2.660570', 'Fontainebleau'),
(9, 8, 2570, 2, '2017-11-12 00:00:00', 'Flamant', 'Magnifiques', '43.505391', '4.267980', 'Saintes Maries de la Mer'),
(10, 1, 1062, 3, '2017-11-11 00:00:00', 'Mésange dans le jardin', 'Dans mon jardin dans la Drôme', '44.411090', '5.356531', 'Rémuzat'),
(11, 2, 2418, 3, '2017-11-12 00:00:00', 'Moineau en ville', NULL, '43.673193', '4.134283', 'Lunel'),
(12, 3, 2418, 1, '2017-10-05 00:00:00', 'Moineaux', NULL, '48.309734', '4.111077', 'Saint-Parres-aux-Tertres'),
(13, 4, 3290, 5, '2017-09-03 00:00:00', 'Moineau', 'ou pas!!!', '47.120066', '4.448808', 'Magnien'),
(14, 7, 2570, 4, '2017-11-01 00:00:00', 'Flamants', NULL, '42.254452', '9.190217', 'Riventosa');

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `observation_id`, `file`) VALUES
(1, 1, 'hJuk85Mp54.jpg'),
(2, 1, 'mpOlk765LosJ4.jpg'),
(3, 1, 'az45Qs52Yui63.jpg'),
(4, 2, 'po85Po63Lm85.jpg'),
(5, 2, 'PmOl54lk586.jpg'),
(6, 5, 'sq52df96FDq.jpg'),
(7, 5, '85Nj63JkLo4.jpg'),
(8, 4, 'gYn86M47Ui.jpg'),
(9, 4, 'ed47Mo69Ioj.jpg'),
(10, 6, 'f85GhY25ms6.jpg'),
(11, 6, 'd74Ki36Ki85M1.jpg'),
(12, 6, 'hikPmo7485.jpg'),
(13, 6, '8Kyg754BvYh74.jpg'),
(14, 9, 'Pmol7485mlI.jpg'),
(15, 14, 'sq52fhdy7485.jpg'),
(16, 6, 'tyhd74mdp25dd631.jpg'),
(17, 6, 'PmOaz74za32.jpg'),
(18, 7, 'sdf852gbvf458Ju4.jpg'),
(19, 7, 'sad74M52Q1z.jpg'),
(20, 7, 'a63Qa52lzak.jpg'),
(21, 7, 'mn252LdHgNh45.jpg'),
(22, 7, 'w52gb63XC5Sd23.jpg'),
(23, 8, '7a47Qsq5835ze.jpg'),
(24, 8, 'loKid485Mpo545.jpg'),
(25, 10, 'gf7d58d69WQ4.jpg'),
(26, 10, 'dlo45ds36e5.jpg'),
(27, 12, 'ohg54f69zaAA65.jpg'),
(28, 13, 'ds4QA8hbc236li.jpg');

--
-- Déchargement des données de la table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `observation_id`) VALUES
(7, 1),
(7, 2);

--
-- Déchargement des données de la table `rewards`
--

INSERT INTO `rewards` (`user_id`, `badge_id`) VALUES
(1, 1),
(1, 5),
(1, 9),
(1, 10),
(2, 1),
(2, 5),
(2, 9),
(3, 1),
(3, 5),
(3, 9),
(4, 1),
(4, 5),
(4, 9),
(5, 1),
(5, 5),
(5, 9),
(6, 1),
(6, 5),
(6, 9),
(7, 1),
(7, 5),
(7, 6),
(7, 9),
(8, 1),
(8, 5),
(8, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
