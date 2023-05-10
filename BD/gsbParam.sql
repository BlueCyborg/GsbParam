-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 10 mai 2023 à 03:09
-- Version du serveur : 10.10.2-MariaDB
-- Version de PHP : 8.0.26

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
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` char(3) NOT NULL,
  `nom` char(32) NOT NULL,
  `mdp` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `mdp`) VALUES
('1', 'LeBoss', '$2y$10$aal8QxnYgVjTEH0Znr8yvuLsJ2i6cJVSFZiakTFINAKUZqjm7fQPq'),
('2', 'LeChefProjet', '$2y$10$j2gPIoH7tJxWGq3WZq0jV.tb4dLViAsGv.tHe0H8tETIdQWQ1pK.y'),
('3', 'admin', '$2y$10$otn2JK3w8mXDRv6FUf6RH.2CX7GOt3kFqhzIDzzUyZm.lHs2a0aRi');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` char(32) NOT NULL,
  `avis` char(50) NOT NULL,
  `note` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `avis_utilisateur_FK` (`id_utilisateur`),
  KEY `avis_produit0_FK` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` char(32) NOT NULL,
  `libelle` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
('CH', 'Cheveux'),
('FO', 'Forme'),
('PS', 'Protection Solaire');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` char(32) NOT NULL,
  `idClient` int(11) NOT NULL,
  `dateCommande` varchar(10) DEFAULT NULL,
  `etat` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_utilisateur_FK` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `idClient`, `dateCommande`, `etat`) VALUES
('1', 1, '2023/05/09', 'E'),
('2', 1, '2023/05/09', 'L'),
('3', 1, '2023/05/09', 'R'),
('4', 2, '2023/05/09', 'E'),
('5', 2, '2023/05/09', 'E'),
('6', 1, '2023/05/09', 'E');

-- --------------------------------------------------------

--
-- Structure de la table `contenance`
--

DROP TABLE IF EXISTS `contenance`;
CREATE TABLE IF NOT EXISTS `contenance` (
  `id` char(32) NOT NULL,
  `contenance` int(11) NOT NULL,
  `id_unite` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contenance_unite_FK` (`id_unite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `contenance`
--

INSERT INTO `contenance` (`id`, `contenance`, `id_unite`) VALUES
('1', 100, '1'),
('10', 4, '3'),
('11', 30, '1'),
('2', 200, '1'),
('3', 150, '1'),
('4', 15, '1'),
('5', 20, '2'),
('6', 40, '1'),
('7', 1, '4'),
('8', 500, '3'),
('9', 200, '3');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` char(32) NOT NULL,
  `idProduit` char(32) NOT NULL,
  `id_contenance` char(32) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`,`id_contenance`),
  KEY `contenir_produit0_contenance1_FK` (`idProduit`,`id_contenance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idCommande`, `idProduit`, `id_contenance`, `quantite`) VALUES
('1', 'c01', '1', 1),
('1', 'c02', '1', 1),
('1', 'c04', '3', 1),
('1', 'p01', '2', 1),
('2', 'c02', '1', 4),
('2', 'c03', '3', 4),
('2', 'c04', '3', 6),
('3', 'f02', '5', 5),
('3', 'f07', '9', 6),
('4', 'c03', '3', 3),
('4', 'c04', '3', 3),
('4', 'c05', '6', 3),
('5', 'c03', '3', 3),
('5', 'c04', '3', 4),
('5', 'f06', '8', 5),
('6', 'c01', '1', 1),
('6', 'c02', '1', 1),
('6', 'c03', '3', 1);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `mdp`, `mail`) VALUES
(1, '$2y$10$ErdDICsLzXZDbc3YChYQqu/k21WU/3S9rj9sZoWAvHPUFFtjhI1DG', 'matthias.larty@gmail.com'),
(2, '$2y$10$p1YXup1K8/k.Dsf16abxb.vNW8.CGAzC48j7i/1AoIcUbU26Z.s06', 'lanchard.leo@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` char(32) NOT NULL,
  `libelle` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `libelle`) VALUES
('1', 'Laino'),
('10', 'Romon'),
('11', 'Futuro sport'),
('12', 'Melapi'),
('13', 'Avene'),
('14', 'Mustela'),
('15', 'Isdin'),
('16', 'Uriage'),
('2', 'Klorane'),
('3', 'Weleda'),
('4', 'Phytopulp'),
('5', 'Nuxe'),
('6', 'La Roche Posay'),
('7', 'Futuro sport'),
('8', 'Microlife'),
('9', 'Bioderma');

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `id_contenance` char(32) NOT NULL,
  `id_produit` char(32) NOT NULL,
  `stock` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_contenance`,`id_produit`),
  KEY `POSSEDER_produit0_FK` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`id_contenance`, `id_produit`, `stock`, `prix`) VALUES
('1', 'c01', 0, 3.25),
('1', 'c02', 0, 2.75),
('10', 'f01', 0, 14.89),
('11', 'f01', 0, 14.99),
('2', 'c01', 0, 4.99),
('2', 'c07', 0, 11.79),
('2', 'p01', 0, 11.77),
('2', 'p02', 0, 12.37),
('3', 'c03', 0, 4.99),
('3', 'c04', 0, 4.99),
('5', 'f02', 0, 3.74),
('6', 'c05', 0, 2.75),
('6', 'f03', 0, 8.45),
('6', 'p03', 0, 12.35),
('6', 'p04', 0, 11.45),
('6', 'p07', 0, 15.32),
('7', 'f04', 0, 31.45),
('7', 'f05', 0, 50.64),
('7', 'p06', 0, 17.68),
('8', 'f06', 0, 12.35),
('9', 'f07', 0, 8.65);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` char(32) NOT NULL,
  `description` char(50) NOT NULL,
  `image` char(100) NOT NULL,
  `idCategorie` char(32) NOT NULL,
  `id_marque` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produit_categorie_FK` (`idCategorie`),
  KEY `produit_marque0_FK` (`id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `description`, `image`, `idCategorie`, `id_marque`) VALUES
('c01', 'Laino Shampooing Douche au Thé Vert BIO', 'images/laino-shampooing-douche-au-the-vert-bio-200ml.png', 'CH', '1'),
('c02', 'Klorane fibres de lin baume après shampooing', 'images/klorane-fibres-de-lin-baume-apres-shampooing-150-ml.jpg', 'CH', '2'),
('c03', 'Weleda Kids 2in1 Shower & Shampoo Orange fruitée', 'images/weleda-kids-2in1-shower-shampoo-orange-fruitee-150-ml.jpg', 'CH', '3'),
('c04', 'Weleda Kids 2in1 Shower & Shampoo vanille douce', 'images/weleda-kids-2in1-shower-shampoo-vanille-douce-150-ml.jpg', 'CH', '3'),
('c05', 'Klorane Shampooing sec à l\'extrait d\'ortie', 'images/klorane-shampooing-sec-a-l-extrait-d-ortie-spray-150ml.png', 'CH', '2'),
('c06', 'Phytopulp mousse volume intense', 'images/phytopulp-mousse-volume-intense-200ml.jpg', 'CH', '4'),
('c07', 'Bio Beaute by Nuxe Shampooing nutritif', 'images/bio-beaute-by-nuxe-shampooing-nutritif-200ml.png', 'CH', '5'),
('f01', 'Nuxe Men Contour des Yeux Multi-Fonctions', 'images/nuxe-men-contour-des-yeux-multi-fonctions-15ml.png', 'FO', '5'),
('f02', 'Tisane romon nature sommirel bio sachet 20', 'images/tisane-romon-nature-sommirel-bio-sachet-20.jpg', 'FO', '10'),
('f03', 'La Roche Posay Cicaplast crème pansement', 'images/la-roche-posay-cicaplast-creme-pansement-40ml.jpg', 'FO', '6'),
('f04', 'Futuro sport stabilisateur pour cheville', 'images/futuro-sport-stabilisateur-pour-cheville-deluxe-attelle-cheville.png', 'FO', '7'),
('f05', 'Microlife pèse-personne électronique weegschaal', 'images/microlife-pese-personne-electronique-weegschaal-ws80.jpg', 'FO', '8'),
('f06', 'Melapi Miel Thym Liquide 500g', 'images/melapi-miel-thym-liquide-500g.jpg', 'FO', '12'),
('f07', 'Meli Meliflor Pollen 200g', 'images/melapi-pollen-250g.jpg', 'FO', '12'),
('p01', 'Avène solaire Spray très haute protection', 'images/avene-solaire-spray-tres-haute-protection-spf50200ml.png', 'PS', '13'),
('p02', 'Mustela Solaire Lait très haute Protection', 'images/mustela-solaire-lait-tres-haute-protection-spf50-100ml.jpg', 'PS', '14'),
('p03', 'Isdin Eryfotona aAK fluid', 'images/isdin-eryfotona-aak-fluid-100-50ml.jpg', 'PS', '15'),
('p04', 'La Roche Posay Anthélios 50+ Brume Visage', 'images/la-roche-posay-anthelios-50-brume-visage-toucher-sec-75ml.png', 'PS', '6'),
('p06', 'Uriage Bariésun stick lèvres SPF30 4g', 'images/uriage-bariesun-stick-levres-spf30-4g.jpg', 'PS', '16'),
('p07', 'Bioderma Cicabio creme SPF50+ 30ml', 'images/bioderma-cicabio-creme-spf50-30ml.png', 'PS', '9');

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

DROP TABLE IF EXISTS `suggestion`;
CREATE TABLE IF NOT EXISTS `suggestion` (
  `id` char(32) NOT NULL,
  `id_produit` char(32) NOT NULL,
  PRIMARY KEY (`id`,`id_produit`),
  KEY `suggestion_produit0_FK` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `suggestion`
--

INSERT INTO `suggestion` (`id`, `id_produit`) VALUES
('c06', 'p02'),
('p03', 'c07'),
('p03', 'p02');

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `id` char(32) NOT NULL,
  `libelle` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`id`, `libelle`) VALUES
('1', 'ml'),
('2', 'sachet'),
('3', 'g'),
('4', 'piece');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(32) NOT NULL,
  `prenom` char(32) NOT NULL,
  `telephone` char(20) NOT NULL,
  `adresse` char(100) NOT NULL,
  `cp` char(10) NOT NULL,
  `ville` char(32) NOT NULL,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utilisateur_login_AK` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `adresse`, `cp`, `ville`, `id_login`) VALUES
(1, 'Matthias', 'Larty', '0622532206', '45 Rue de la paix', '45000', 'Orléans', 1),
(2, 'Lanchard', 'Leo', '0623562307', '27 Rue de la paix', '45160', 'Orléans', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_produit0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `avis_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_utilisateur_FK` FOREIGN KEY (`idClient`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `contenance`
--
ALTER TABLE `contenance`
  ADD CONSTRAINT `contenance_unite_FK` FOREIGN KEY (`id_unite`) REFERENCES `unite` (`id`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_commande_FK` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `contenir_produit0_contenance1_FK` FOREIGN KEY (`idProduit`,`id_contenance`) REFERENCES `posseder` (`id_produit`, `id_contenance`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `POSSEDER_contenance_FK` FOREIGN KEY (`id_contenance`) REFERENCES `contenance` (`id`),
  ADD CONSTRAINT `POSSEDER_produit0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `produit_marque0_FK` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`);

--
-- Contraintes pour la table `suggestion`
--
ALTER TABLE `suggestion`
  ADD CONSTRAINT `suggestion_produit0_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `suggestion_produit_FK` FOREIGN KEY (`id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_login_FK` FOREIGN KEY (`id_login`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
