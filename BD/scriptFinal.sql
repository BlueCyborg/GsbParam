-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 05 avr. 2023 à 09:56
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
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` char(32) COLLATE utf8mb3_bin NOT NULL,
  `description` char(50) COLLATE utf8mb3_bin NOT NULL,
  `image` char(100) COLLATE utf8mb3_bin NOT NULL,
  `id_categorie` char(32) COLLATE utf8mb3_bin NOT NULL,
  `id_marque` char(32) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produit_categorie_FK` (`id_categorie`),
  KEY `produit_marque0_FK` (`id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `description`, `image`, `id_categorie`, `id_marque`) VALUES
('c01', 'Laino Shampooing Douche au Thé Vert BIO', 'images/laino-shampooing-douche-au-the-vert-bio-200ml.png', 'CH', NULL),
('c02', 'Klorane fibres de lin baume après shampooing', 'images/klorane-fibres-de-lin-baume-apres-shampooing-150-ml.jpg', 'CH', NULL),
('c03', 'Weleda Kids 2in1 Shower & Shampoo Orange fruitée', 'images/weleda-kids-2in1-shower-shampoo-orange-fruitee-150-ml.jpg', 'CH', NULL),
('c04', 'Weleda Kids 2in1 Shower & Shampoo vanille douce', 'images/weleda-kids-2in1-shower-shampoo-vanille-douce-150-ml.jpg', 'CH', NULL),
('c05', 'Klorane Shampooing sec à l\'extrait d\'ortie', 'images/klorane-shampooing-sec-a-l-extrait-d-ortie-spray-150ml.png', 'CH', NULL),
('c06', 'Phytopulp mousse volume intense', 'images/phytopulp-mousse-volume-intense-200ml.jpg', 'CH', NULL),
('c07', 'Bio Beaute by Nuxe Shampooing nutritif', 'images/bio-beaute-by-nuxe-shampooing-nutritif-200ml.png', 'CH', NULL),
('f01', 'Nuxe Men Contour des Yeux Multi-Fonctions', 'images/nuxe-men-contour-des-yeux-multi-fonctions-15ml.png', 'FO', NULL),
('f02', 'Tisane romon nature sommirel bio sachet 20', 'images/tisane-romon-nature-sommirel-bio-sachet-20.jpg', 'FO', NULL),
('f03', 'La Roche Posay Cicaplast crème pansement', 'images/la-roche-posay-cicaplast-creme-pansement-40ml.jpg', 'FO', NULL),
('f04', 'Futuro sport stabilisateur pour cheville', 'images/futuro-sport-stabilisateur-pour-cheville-deluxe-attelle-cheville.png', 'FO', NULL),
('f05', 'Microlife pèse-personne électronique weegschaal', 'images/microlife-pese-personne-electronique-weegschaal-ws80.jpg', 'FO', NULL),
('f06', 'Melapi Miel Thym Liquide 500g', 'images/melapi-miel-thym-liquide-500g.jpg', 'FO', NULL),
('f07', 'Meli Meliflor Pollen 200g', 'images/melapi-pollen-250g.jpg', 'FO', NULL),
('p01', 'Avène solaire Spray très haute protection', 'images/avene-solaire-spray-tres-haute-protection-spf50200ml.png', 'PS', NULL),
('p02', 'Mustela Solaire Lait très haute Protection', 'images/mustela-solaire-lait-tres-haute-protection-spf50-100ml.jpg', 'PS', NULL),
('p03', 'Isdin Eryfotona aAK fluid', 'images/isdin-eryfotona-aak-fluid-100-50ml.jpg', 'PS', NULL),
('p04', 'La Roche Posay Anthélios 50+ Brume Visage', 'images/la-roche-posay-anthelios-50-brume-visage-toucher-sec-75ml.png', 'PS', NULL),
('p05', 'Nuxe Sun Huile Lactée Capillaire Protectrice', 'images/nuxe-sun-huile-lactee-capillaire-protectrice-100ml.png', 'PS', NULL),
('p06', 'Uriage Bariésun stick lèvres SPF30 4g', 'images/uriage-bariesun-stick-levres-spf30-4g.jpg', 'PS', NULL),
('p07', 'Bioderma Cicabio creme SPF50+ 30ml', 'images/bioderma-cicabio-creme-spf50-30ml.png', 'PS', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `produit_marque0_FK` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
