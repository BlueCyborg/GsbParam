-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 18 mai 2023 à 18:00
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` char(32) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `mdp`) VALUES
(1, 'LeBoss', '$2y$10$aal8QxnYgVjTEH0Znr8yvuLsJ2i6cJVSFZiakTFINAKUZqjm7fQPq'),
(2, 'LeChefProjet', '$2y$10$j2gPIoH7tJxWGq3WZq0jV.tb4dLViAsGv.tHe0H8tETIdQWQ1pK.y');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `avis` char(50) NOT NULL,
  `note` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` char(32) NOT NULL,
  `libelle` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenance`
--

CREATE TABLE `contenance` (
  `id` int(11) NOT NULL,
  `contenance` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `idCommande` int(11) NOT NULL,
  `idProduit` char(32) NOT NULL,
  `id_contenance` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `libelle` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE `posseder` (
  `id_contenance` int(11) NOT NULL,
  `id_produit` char(32) NOT NULL,
  `stock` int(11) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` char(32) NOT NULL,
  `description` char(50) NOT NULL,
  `image` char(100) NOT NULL,
  `id_categorie` char(32) NOT NULL,
  `id_marque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` char(32) NOT NULL,
  `id_produit` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE `unite` (
  `id` int(11) NOT NULL,
  `libelle` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` char(32) NOT NULL,
  `prenom` char(32) NOT NULL,
  `telephone` char(20) NOT NULL,
  `adresse` char(100) NOT NULL,
  `cp` char(10) NOT NULL,
  `ville` char(32) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avis_utilisateur_FK` (`id_utilisateur`),
  ADD KEY `avis_produit_FK` (`id_produit`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_utilisateur_FK` (`idClient`);

--
-- Index pour la table `contenance`
--
ALTER TABLE `contenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contenance_unite_FK` (`id_unite`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`idCommande`,`idProduit`,`id_contenance`),
  ADD KEY `contenir_produit_contenance_FK` (`idProduit`,`id_contenance`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD PRIMARY KEY (`id_contenance`,`id_produit`),
  ADD KEY `POSSEDER_produit_FK` (`id_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit_categorie_FK` (`id_categorie`),
  ADD KEY `produit_marque_FK` (`id_marque`);

--
-- Index pour la table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`,`id_produit`),
  ADD KEY `suggestion_produit0_FK` (`id_produit`);

--
-- Index pour la table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utilisateur_login_AK` (`id_login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenance`
--
ALTER TABLE `contenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_produit_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
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
  ADD CONSTRAINT `contenir_produit_contenance_FK` FOREIGN KEY (`idProduit`,`id_contenance`) REFERENCES `posseder` (`id_produit`, `id_contenance`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `POSSEDER_contenance_FK` FOREIGN KEY (`id_contenance`) REFERENCES `contenance` (`id`),
  ADD CONSTRAINT `POSSEDER_produit_FK` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `produit_marque_FK` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
