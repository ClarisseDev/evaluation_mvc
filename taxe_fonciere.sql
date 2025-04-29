-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 29 avr. 2025 à 08:21
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `taxe_fonciere`
--

-- --------------------------------------------------------

--
-- Structure de la table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `owners`
--

INSERT INTO `owners` (`id`, `first_name`, `last_name`) VALUES
(4, 'Michel', 'Blanc'),
(6, 'Patrick', 'Chauvet'),
(7, 'Céline', 'Marques'),
(8, 'Marion', 'Bellac'),
(9, 'Martin', 'Martin'),
(10, 'Justine', 'Bondin'),
(11, 'Claire', 'Chabal'),
(12, 'Marie', 'Fernadez'),
(13, 'Marie', 'Fernadez'),
(14, 'Marie', 'Fernadez'),
(15, 'Marie', 'Fernadez'),
(16, 'Marie', 'Fernadez'),
(17, 'Christian', 'Chambert'),
(46, 'Paul', 'Durand'),
(47, 'Martin', 'Martin');

-- --------------------------------------------------------

--
-- Structure de la table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `surface` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `floor` int(11) DEFAULT NULL,
  `has_pool` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `properties`
--

INSERT INTO `properties` (`id`, `owner_id`, `type`, `region`, `city`, `surface`, `tax`, `floor`, `has_pool`) VALUES
(3, 4, 'House', 'Autre', 'Bordeaux', 120, 1900, NULL, 1),
(5, 6, 'Flat', 'Occitanie', 'Toulouse', 40, 480, 3, 0),
(6, 7, 'Flat', 'Occitanie', 'Toulouse', 60, 720, 4, 0),
(7, 8, 'House', 'Occitanie', 'Limoux', 160, 2240, NULL, 0),
(8, 9, 'Flat', 'Autre', 'Guéret', 80, 1040, 1, 0),
(9, 10, 'Flat', 'Occitanie', 'Narbonne', 50, 600, 3, 0),
(10, 11, 'House', 'Occitanie', 'Carcassonne', 140, 2060, NULL, 1),
(11, 12, 'House', 'Occitanie', 'Montpellier', 90, 1360, NULL, 1),
(12, 13, 'House', 'Occitanie', 'Montpellier', 90, 1360, NULL, 1),
(13, 14, 'House', 'Occitanie', 'Montpellier', 90, 1360, NULL, 1),
(14, 14, 'House', 'Autre', 'Cannes', 50, 750, NULL, 0),
(15, 15, 'House', 'Occitanie', 'Montpellier', 90, 1360, NULL, 1),
(16, 15, 'House', 'Autre', 'Cannes', 50, 750, NULL, 0),
(17, 15, 'Flat', 'Occitanie', 'Béziers', 60, 720, 3, 0),
(18, 16, 'House', 'Occitanie', 'Montpellier', 90, 1360, NULL, 1),
(19, 16, 'House', 'Autre', 'Cannes', 50, 750, NULL, 0),
(20, 16, 'Flat', 'Occitanie', 'Béziers', 60, 720, 3, 0),
(69, 46, 'Flat', 'Occitanie', 'Carcassonne', 100, 1200, 3, 0),
(70, 46, 'Flat', 'RhoneAlpes', 'Lyon', 50, 650, 1, 0),
(71, 46, 'House', 'Paca', 'SaintTropez', 100, 1600, NULL, 1),
(72, 47, 'House', 'Occitanie', 'Narbonne', 150, 2100, NULL, 0),
(73, 47, 'Flat', 'Hérault', 'Béziers', 70, 910, 4, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
