-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 25 mai 2019 à 22:08
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `bornes`
--

CREATE TABLE `bornes` (
  `idBornes` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresseMac` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresseIp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `bornes`
--

INSERT INTO `bornes` (`idBornes`, `prix`, `libelle`, `adresseMac`, `adresseIp`, `image`) VALUES
(4, 45, 'Borne 1', 'ABC123', '192.127.0.0', 'images/item-01.jpg'),
(5, 85, 'Borne 2', '123ABC', '192.127.0.1', 'images/item-02.jpg'),
(6, 115, 'Borne 3', '1A2B3C', '192.127.0.3', 'images/item-03.jpg'),
(7, 115, 'Borne 4', 'YGUUGMYI', '192.127.0.4', 'images/item-04.jpg'),
(8, 115, 'Borne 5', 'YGUUGMYI', '192.127.0.4', 'images/item-05.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `bornes_commandes`
--

CREATE TABLE `bornes_commandes` (
  `idBornes` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `debutDate` date NOT NULL,
  `finDate` date NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `borne_photo`
--

CREATE TABLE `borne_photo` (
  `idBornes` int(11) NOT NULL,
  `idPhotos` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `siret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validation` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`idClient`, `nom`, `prenom`, `email`, `tel`, `cp`, `ville`, `adresse`, `siret`, `passwd`, `validation`) VALUES
(2, 'DUPONT', 'Paul', 'oui@oui.fr', '06 15 15 1', '59000', 'Lille', 'Rue des paquerettes', '9852485', 'b2a5abfeef9e36964281a31e17b57c97', 1),
(3, 'Henry', 'Cantonnais', 'non@non.fr', '06 14 14 1', '59000', 'Douvrin', 'Rue des tulipes', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 1),
(4, 'Renuy', 'Greg', 'why@why.fr', '06 13 13 1', '59000', 'Lille', 'Rue des roses', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 1),
(5, 'Fallon', 'LoÃ¯c', 'fallonloic@hotmail.fr', '0627310104', '62138', 'Douvrin', '542 Bd Ouest', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 0),
(7, 'Antoine', 'Daniel', 'alors@alors.fr', '06 12 12 1', '59000', 'Lille', 'Rue des coquelicots', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 0),
(8, 'Zinedine', 'Zidane', 'zizou@zizou.fr', '06 11 11 1', '59000', 'Lille', 'Rue des champions du monde', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 1),
(13, 'Fabien ', 'BarthÃ¨s', 'uvli@ityvulb.fr', 'ytkufyligu', 'idtfy', 'ditfoyg', 'idtfuoyg', NULL, 'b2a5abfeef9e36964281a31e17b57c97', 0),
(14, 'uogyiu', 'touygipuoh', 'toufygiup@uyligu.fr', 'ouygiupoh', 'oufyi', 'oufygipuho', 'ouygiu', NULL, '57c1318a008d4ef7e71922815cda841e', 0),
(16, 'fcykvu', 'ctylg', 'g@h.fr', 'civ', 'ifogp', 'ifog', 'fog', 'Ã¨ogpi', '729712cf73dced5fa1dea4392faa2db2', 0),
(17, 'somon', 'gregoire', 'gregoiresomon@gmail.com', '0320355734', '59280', 'ArmentiÃ¨res', '25, boulevard faidherbe', '01020304', 'fda1fa8b6de13ce168a06e0e776673c0', 0),
(19, 'somon', 'gregoire', 'greg@gmail.com', '0320355734', '59280', 'ArmentiÃ¨res', '25, boulevard faidherbe', NULL, 'ab4f63f9ac65152575886860dde480a1', 0),
(22, 'somon', 'gregoire', 'entreprise@gmail.com', '0320355734', '59280', 'ArmentiÃ¨res', '25, boulevard faidherbe', '01020305', '937adde2c8a5b78369637ffc8ed0441d', 0),
(29, 'admin', 'admin', 'admin@gmail.com', '0606060606', '59280', 'ArmentiÃ¨res', '25 rue admin', NULL, '21232f297a57a5a743894a0e4a801fc3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `debutDate` date NOT NULL,
  `finDate` date NOT NULL,
  `codeEvent` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_client`
--

CREATE TABLE `commande_client` (
  `idClient` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consommables`
--

CREATE TABLE `consommables` (
  `idConsosommables` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `consommables`
--

INSERT INTO `consommables` (`idConsosommables`, `libelle`, `stock`, `description`, `prix`, `image`) VALUES
(14, 'L\'imprimante Epson', 150, 'Ze imprimante !', 5, 'images/items-4.jpg'),
(15, 'Cartouche d\'encre', 45, 'Plein de couleur !', 8, 'images/items-2.jpg'),
(16, 'Feuille de qualite', 96, 'Feuille gros grain', 12, 'images/items-1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `consommable_commande`
--

CREATE TABLE `consommable_commande` (
  `idCommande` int(11) NOT NULL,
  `idConsommables` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `idPhotos` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chemin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `selection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bornes`
--
ALTER TABLE `bornes`
  ADD PRIMARY KEY (`idBornes`);

--
-- Index pour la table `bornes_commandes`
--
ALTER TABLE `bornes_commandes`
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idBornes` (`idBornes`);

--
-- Index pour la table `borne_photo`
--
ALTER TABLE `borne_photo`
  ADD KEY `idBornes` (`idBornes`),
  ADD KEY `idPhotos` (`idPhotos`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `siret` (`siret`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `commande_client`
--
ALTER TABLE `commande_client`
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `consommables`
--
ALTER TABLE `consommables`
  ADD PRIMARY KEY (`idConsosommables`);

--
-- Index pour la table `consommable_commande`
--
ALTER TABLE `consommable_commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idConsommables` (`idConsommables`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`idPhotos`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bornes`
--
ALTER TABLE `bornes`
  MODIFY `idBornes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `consommables`
--
ALTER TABLE `consommables`
  MODIFY `idConsosommables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idPhotos` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bornes_commandes`
--
ALTER TABLE `bornes_commandes`
  ADD CONSTRAINT `bornes_commandes_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `bornes_commandes_ibfk_3` FOREIGN KEY (`idBornes`) REFERENCES `bornes` (`idBornes`);

--
-- Contraintes pour la table `borne_photo`
--
ALTER TABLE `borne_photo`
  ADD CONSTRAINT `borne_photo_ibfk_1` FOREIGN KEY (`idBornes`) REFERENCES `bornes` (`idBornes`),
  ADD CONSTRAINT `borne_photo_ibfk_2` FOREIGN KEY (`idPhotos`) REFERENCES `photos` (`idPhotos`),
  ADD CONSTRAINT `borne_photo_ibfk_3` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `commande_client`
--
ALTER TABLE `commande_client`
  ADD CONSTRAINT `commande_client_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `clients` (`idClient`),
  ADD CONSTRAINT `commande_client_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `consommable_commande`
--
ALTER TABLE `consommable_commande`
  ADD CONSTRAINT `consommable_commande_ibfk_1` FOREIGN KEY (`idConsommables`) REFERENCES `consommables` (`idConsosommables`),
  ADD CONSTRAINT `consommable_commande_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
