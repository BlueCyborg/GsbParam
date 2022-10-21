-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 21 oct. 2022 à 06:08
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
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` char(3) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `nom` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `mdp` char(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `mdp`) VALUES
('1', 'LeBoss', 'TheBest$147#'),
('2', 'LeChefProjet', 'NearlyTheBest$280@');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `libelle` char(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
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
  `id` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `idProd` char(32) COLLATE utf8mb3_bin DEFAULT NULL,
  `qteProd` int(11) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `rue` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `cp` varchar(5) COLLATE utf8mb3_bin NOT NULL,
  `ville` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `mailUtilisateur` varchar(100) CHARACTER SET utf16 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_util_commande` (`mailUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `idProduit` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `I_FK_CONTENIR_COMMANDE` (`idCommande`),
  KEY `I_FK_CONTENIR_Produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `qte` int(11) NOT NULL,
  `description` char(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` char(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `idCategorie` char(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `I_FK_Produit_CATEGORIE` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `qte`, `description`, `prix`, `image`, `idCategorie`) VALUES
('c01', 1, 'Laino Shampooing Douche au Thé Vert BIO', '4.00', 'images/laino-shampooing-douche-au-the-vert-bio-200ml.png', 'CH'),
('c02', 1, 'Klorane fibres de lin baume après shampooing', '10.80', 'images/klorane-fibres-de-lin-baume-apres-shampooing-150-ml.jpg', 'CH'),
('c03', 1, 'Weleda Kids 2in1 Shower & Shampoo Orange fruitée', '4.00', 'images/weleda-kids-2in1-shower-shampoo-orange-fruitee-150-ml.jpg', 'CH'),
('c04', 1, 'Weleda Kids 2in1 Shower & Shampoo vanille douce', '4.00', 'images/weleda-kids-2in1-shower-shampoo-vanille-douce-150-ml.jpg', 'CH'),
('c05', 1, 'Klorane Shampooing sec à l\'extrait d\'ortie', '6.10', 'images/klorane-shampooing-sec-a-l-extrait-d-ortie-spray-150ml.png', 'CH'),
('c06', 1, 'Phytopulp mousse volume intense', '18.00', 'images/phytopulp-mousse-volume-intense-200ml.jpg', 'CH'),
('c07', 1, 'Bio Beaute by Nuxe Shampooing nutritif', '8.00', 'images/bio-beaute-by-nuxe-shampooing-nutritif-200ml.png', 'CH'),
('f01', 1, 'Nuxe Men Contour des Yeux Multi-Fonctions', '12.05', 'images/nuxe-men-contour-des-yeux-multi-fonctions-15ml.png', 'FO'),
('f02', 1, 'Tisane romon nature sommirel bio sachet 20', '5.50', 'images/tisane-romon-nature-sommirel-bio-sachet-20.jpg', 'FO'),
('f03', 1, 'La Roche Posay Cicaplast crème pansement', '11.00', 'images/la-roche-posay-cicaplast-creme-pansement-40ml.jpg', 'FO'),
('f04', 1, 'Futuro sport stabilisateur pour cheville', '26.50', 'images/futuro-sport-stabilisateur-pour-cheville-deluxe-attelle-cheville.png', 'FO'),
('f05', 1, 'Microlife pèse-personne électronique weegschaal', '63.00', 'images/microlife-pese-personne-electronique-weegschaal-ws80.jpg', 'FO'),
('f06', 1, 'Melapi Miel Thym Liquide 500g', '6.50', 'images/melapi-miel-thym-liquide-500g.jpg', 'FO'),
('f07', 1, 'Meli Meliflor Pollen 200g', '8.60', 'images/melapi-pollen-250g.jpg', 'FO'),
('p01', 1, 'Avène solaire Spray très haute protection', '22.00', 'images/avene-solaire-spray-tres-haute-protection-spf50200ml.png', 'PS'),
('p02', 1, 'Mustela Solaire Lait très haute Protection', '17.50', 'images/mustela-solaire-lait-tres-haute-protection-spf50-100ml.jpg', 'PS'),
('p03', 1, 'Isdin Eryfotona aAK fluid', '29.00', 'images/isdin-eryfotona-aak-fluid-100-50ml.jpg', 'PS'),
('p04', 1, 'La Roche Posay Anthélios 50+ Brume Visage', '8.75', 'images/la-roche-posay-anthelios-50-brume-visage-toucher-sec-75ml.png', 'PS'),
('p05', 1, 'Nuxe Sun Huile Lactée Capillaire Protectrice', '15.00', 'images/nuxe-sun-huile-lactee-capillaire-protectrice-100ml.png', 'PS'),
('p06', 1, 'Uriage Bariésun stick lèvres SPF30 4g', '5.65', 'images/uriage-bariesun-stick-levres-spf30-4g.jpg', 'PS'),
('p07', 1, 'Bioderma Cicabio creme SPF50+ 30ml', '13.70', 'images/bioderma-cicabio-creme-spf50-30ml.png', 'PS');

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
('mail@mail.com', '$2y$10$U7HnzzhhcmjLFItS6B/uOOA7RZUdQy5Toq8v/ld3URQm8Ie11jyNu', 'mail', 'mail', 'mail', 'mail', '45000', 'mail');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_util_commande` FOREIGN KEY (`mailUtilisateur`) REFERENCES `utilisateur` (`mail`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
