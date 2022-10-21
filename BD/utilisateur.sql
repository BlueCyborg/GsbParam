-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 21 oct. 2022 à 07:04
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbparam`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `mail` varchar(100) CHARACTER SET utf16 NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf16 NOT NULL,
  `nom` varchar(32) CHARACTER SET utf16 NOT NULL,
  `prenom` varchar(32) CHARACTER SET utf16 NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf16 NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf16 NOT NULL,
  `cp` varchar(10) CHARACTER SET utf16 NOT NULL,
  `ville` varchar(32) CHARACTER SET utf16 NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`mail`, `mdp`, `nom`, `prenom`, `telephone`, `adresse`, `cp`, `ville`) VALUES
('mail@mail.com', '$2y$10$U7HnzzhhcmjLFItS6B/uOOA7RZUdQy5Toq8v/ld3URQm8Ie11jyNu', 'nom', 'prenom', '07654654', 'adresse', '45000', 'ville');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
