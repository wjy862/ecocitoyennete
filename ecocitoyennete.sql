-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 juin 2020 à 14:45
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecocitoyennete`
--

-- --------------------------------------------------------

--
-- Structure de la table `affiches`
--

CREATE TABLE `affiches` (
  `idAffiche` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `idTypeAffiche` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `affiches`
--

INSERT INTO `affiches` (`idAffiche`, `titre`, `description`, `photo`, `lieu`, `idTypeAffiche`, `idUser`) VALUES
(1, '1', 'concert dsfdsfdsfdsfsd', './Public/Images/1591715588.png', 'ut1 capitole', 1, 3),
(2, 'Brandon Grotesque', 'cinéma', 'Aucune', 'ancienne fac', 2, 1),
(3, 'League Gothic ', 'publicité', 'Aucune', 'manu', 2, 1),
(9, 'dededed', '<p>ededededed</p>\r\n', NULL, 'ededed', NULL, 3),
(10, 'azdazd', '<p>dszqdsqdsqdcxs</p>\r\n', NULL, 'azdzadz', NULL, 3),
(11, 'dsds', '<p>qsdqsd</p>\r\n', NULL, 'sqdqs', NULL, 3),
(13, '', '', './Public/Images/1591394372.png', '', 1, 3),
(14, 'test1', '<p>test</p>111', './Public/Images/1591394394.png', 'test1', 2, 3),
(15, 'fdsf', '<p>dsffffffffffffffffffffffffffffffffffffffffff</p', './Public/Images/1591395225.png', 'dfdsfsdfsdf', 1, 3),
(16, 'on', 'test', './Public/Images/1591415474.png', 'test', NULL, 3),
(17, 'on', 'test2', './Public/Images/1591415648.png', 'test2', NULL, 3),
(18, 'Ancienne faculté', '123456', './Public/Images/1591415780.png', '123456', NULL, 3),
(19, 'Manufacture', 'dzdzdzd', './Public/Images/1591415931.png', 'dzdzdz', NULL, 3),
(20, 'Ancienne faculté', 'lellellee', './Public/Images/1591416053.png', 'lellelelle', NULL, 3),
(21, 'Arsenal', 'fvresfvefsre', './Public/Images/1591416194.png', 'frfrfdsrcd', 1, 3),
(24, 'Manufacture', 'dvdv', './Public/Images/1591416822.png', 'dcd', 2, 3),
(25, '1', 'dfvdvdfgvdfvgdfdfdfsssssssssss', './Public/Images/1591422841.png', 'aa', 2, 3),
(26, 'Manufacture', 'dsfsdf', './Public/Images/1591424814.png', 'fefedrf', 1, 3),
(28, 'Manufacture', 'dcdc', './Public/Images/1591715567.png', 'cdc', 1, 3),
(30, 'Manufacture', 'dscds', './Public/Images/1591813300.png', 'dcdsc', 1, 3),
(31, 'Manufacture', 'dfvdf', './Public/Images/1591813635.png', 'vfdvdf', 1, 3),
(33, '1', 'test1', './Public/Images/1591869020.png', 'test1', 1, 3),
(34, 'Manufacture', 'fuit deau', './Public/Images/1591875147.png', '3 étage toilette', 1, 3),
(35, 'Manufacture', 'fuit d&#39;eau', './Public/Images/1591875300.png', '3 étage toilette', 1, 3),
(36, 'Arsenal', '3 l&#39;étage toilette', './Public/Images/1591875446.jpg', '3 l&#39;étage toilette', 1, 3),
(37, '1', 'j&#39;ai trouvé', './Public/Images/1591875733.png', '3 l&#39;étage toilette', 2, 3),
(38, '1', 'j&#39;ai trouvé ca', './Public/Images/1591875783.jpg', '3 l&#39;étage toilette l&#39;', 3, 3),
(39, '1', 'iphoe', './Public/Images/1591876495.png', '9 rue courier', 4, 3),
(40, '1', 'dfvdfvdfsv', './Public/Images/1591913856.jfif', 'fdvdfv', 1, 3),
(41, '1', 'rgrfvgf&#34;', './Public/Images/1591877304.jfif', 'refrefrdsfdsr&#39; &#39;njnj&#39;&#39;&#39;&#39; &', 4, 3),
(43, '1', '', './Public/Images/1591884112.png', '', 2, 3),
(44, 'Manufacture', 'dsfdsf', './Public/Images/1591884451.jfif', '', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `idArticle` int(11) NOT NULL,
  `titreArticle` varchar(50) DEFAULT NULL,
  `contenuArticle` varchar(500) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `titreArticle`, `contenuArticle`, `idUser`, `idCategorie`) VALUES
(1, 'ecologie avec ut1', 'C\'est dans le cadre de ses \"conférences sur l\'environnement\" que l\'EJUC a le plaisir de recevoir M. Gonzalo Sozzo, Professeur à l’Université nationale du littoral (Santa Fe, Argentine) et Directeur scientifique de l’Institut d’études avancées de Santa Fe.\r\n\r\nIl viendra présenter son nouveau livre intitulé \"El giro ecologico del derecho privado\" portant sur \"Le virage écologique du droit privé : le cas du code civil et commercial argentin\".', 1, 1),
(2, 'Le développement durable', 'Le développement durable est « un développement qui répond aux besoins du présent sans compromettre la capacité des générations futures à répondre aux leurs », citation de Mme Gro Harlem Brundtland, Premier Ministre norvégien (1987)', 1, 1),
(3, 'L\'énergie ', 'Les énergies renouvelables (EnR) sont des sources d\'énergie dont le renouvellement naturel est assez rapide pour qu\'elles puissent être considérées comme inépuisables à l\'échelle du temps humain.', 1, 1),
(4, 'Ecologie', 'L\'écologie ou écologie scientifique, parfois assimilée à la bioécologie ou à la bionomie, est une science qui étudie les êtres vivants dans leur milieu en tenant compte de leurs interactions. Cet ensemble, qui contient les êtres vivants, leur milieu de vie et les relations qu\'ils entretiennent, forme un écosystème', 1, 1),
(5, 'Conférence chez soi', 'a conférence est l\'une des formes de conversation entre personnes. Elle est une confrontation d\'idées sur un sujet jugé d\'importance par les participants. C\'est pourquoi son organisation est généralement formelle', 1, 1),
(6, 'nouvelle regle', 'Depuis le 1er avril 2017, une nouvelle réglementation relative à l’inspection des systèmes de réfrigération, de climatisation et des pompes à chaleur réversibles de plus de 12 kW est entrée en vigueur.\r\n\r\nQuels sont les systèmes concernés par cette réglementation ?\r\n\r\n- « Systèmes simples » : Systèmes de climatisation et pompes à chaleur réversibles dont la puissance frigorifique nominale utile est supérieure à 12 kW et qui sont utilisés pour satisfaire les exigences de confort des occupants.\r\n\r', 1, 1),
(7, 'Journée Mondiale de la Terre', 'Journée Mondiale de la Terre. Cet évènement a été célébré pour la première fois le 22 avril 1970. le Jour de la Terre est aujourd\'hui reconnu comme l\'événement environnemental populaire le plus important au monde. Le fondateur de cet événement est le sénateur américain Gaylord Nelson', 1, 1),
(9, 'La citoyenneté ', 'La citoyenneté est le fait pour un individu, pour une famille ou pour un groupe, d\'être reconnu officiellement comme citoyen, c\'est-à-dire membre d\'une ville ayant le statut de cité, ou plus généralement d\'un État.', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(30) NOT NULL COMMENT 'Gendre',
  `parentId` int(11) NOT NULL COMMENT 'PARENT ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`, `parentId`) VALUES
(1, 'Écologie urbaine', 0),
(2, 'Revenu citoyen', 0),
(3, 'Géographie', 0),
(4, 'Environnement', 0),
(5, 'Consomaction', 0),
(6, 'Environnement Toulouse', 4),
(7, 'Environnement Paris', 4),
(8, 'Agenda ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idCommentaire` int(11) NOT NULL,
  `commentaire` varchar(50) DEFAULT NULL,
  `idAffiche` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`idCommentaire`, `commentaire`, `idAffiche`, `idUser`) VALUES
(1, ' attention', 1, 1),
(2, 'teste', 2, 1),
(3, 'modifier', 3, 1),
(9, 'dede', 25, 3),
(10, 'hello', 25, 3),
(11, 'fdfdfdfdfgggggggggggggggggggggggggggggggggggggggg', 40, 3),
(12, 'cs', 40, 3),
(13, 'cdschhhey', 40, 3);

-- --------------------------------------------------------

--
-- Structure de la table `concernerplat`
--

CREATE TABLE `concernerplat` (
  `idRestaurant` int(11) NOT NULL,
  `idTypeP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `concernerplat`
--

INSERT INTO `concernerplat` (`idRestaurant`, `idTypeP`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `contactrestaurant`
--

CREATE TABLE `contactrestaurant` (
  `idContactR` int(11) NOT NULL,
  `nomContactR` varchar(50) NOT NULL,
  `prenomContactR` varchar(50) NOT NULL,
  `mailContactR` varchar(50) NOT NULL,
  `telephoneContactR` varchar(50) DEFAULT NULL,
  `idRestaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contactrestaurant`
--

INSERT INTO `contactrestaurant` (`idContactR`, `nomContactR`, `prenomContactR`, `mailContactR`, `telephoneContactR`, `idRestaurant`) VALUES
(1, ' Chevalier', 'Francois', 'Chevalier.Francois@gmail.com', '0712457898', 1),
(2, 'Duval', 'Giraud', 'Duval.Giraudàgmail.com', '0732659841', 2),
(3, ' Renaud', 'Olivier', 'Renaud.Olivier@gmail.com', '0752698412', 3);

-- --------------------------------------------------------

--
-- Structure de la table `fournir`
--

CREATE TABLE `fournir` (
  `idPanier` int(11) NOT NULL,
  `idRestaurant` int(11) NOT NULL,
  `qteStock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournir`
--

INSERT INTO `fournir` (`idPanier`, `idRestaurant`, `qteStock`) VALUES
(1, 1, 4),
(2, 2, 3),
(3, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `manipuleraffiche`
--

CREATE TABLE `manipuleraffiche` (
  `idUser` int(11) NOT NULL,
  `idAffiche` int(11) NOT NULL,
  `idTypeManipulation` int(11) NOT NULL,
  `dateAff` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manipuleraffiche`
--

INSERT INTO `manipuleraffiche` (`idUser`, `idAffiche`, `idTypeManipulation`, `dateAff`) VALUES
(3, 13, 3, '0000-00-00'),
(3, 19, 3, '0000-00-00'),
(3, 44, 3, '0000-00-00'),
(3, 3, 3, '2015-11-21'),
(2, 2, 2, '2019-07-21'),
(1, 1, 1, '2020-03-21');

-- --------------------------------------------------------

--
-- Structure de la table `manipulerarticle`
--

CREATE TABLE `manipulerarticle` (
  `idUser` int(11) NOT NULL,
  `dateArt` date NOT NULL,
  `idTypeManipulation` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `manipulercommentaire`
--

CREATE TABLE `manipulercommentaire` (
  `idTypeManipulation` int(11) NOT NULL,
  `dateC` date NOT NULL,
  `idCommentaire` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manipulercommentaire`
--

INSERT INTO `manipulercommentaire` (`idTypeManipulation`, `dateC`, `idCommentaire`, `idUser`) VALUES
(1, '2020-03-21', 1, 1),
(2, '2020-02-08', 2, 2),
(3, '0000-00-00', 2, 3),
(3, '2019-01-20', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `nourritures`
--

CREATE TABLE `nourritures` (
  `idNourriture` int(11) NOT NULL,
  `nomNourriture` varchar(50) DEFAULT NULL,
  `descriptionNourriture` varchar(50) DEFAULT NULL,
  `graphe` varchar(50) DEFAULT NULL,
  `idTypePP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nourritures`
--

INSERT INTO `nourritures` (`idNourriture`, `nomNourriture`, `descriptionNourriture`, `graphe`, `idTypePP`) VALUES
(1, 'Bounty ', 'aucune', 'aucun', 1),
(2, 'Muffin', 'aucune', 'aucun', 2),
(3, ' Amande', 'aucune', 'aucun', 3);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `idPanier` int(11) NOT NULL,
  `nompanier` varchar(50) DEFAULT NULL,
  `prixpanier` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`idPanier`, `nompanier`, `prixpanier`) VALUES
(1, 'Fruits ', '2.00'),
(2, 'légumes', '4.00'),
(3, 'boisson', '6.00');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `idReservation` int(11) NOT NULL,
  `dateP` date NOT NULL,
  `mailContenu` varchar(50) DEFAULT NULL,
  `IdContactRE` int(11) DEFAULT NULL,
  `IdContactRV` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idRestaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`idReservation`, `dateP`, `mailContenu`, `IdContactRE`, `IdContactRV`, `idUser`, `idRestaurant`) VALUES
(1, '0000-00-00', 'beb12345@gmail.com', 1, 1, 1, 1),
(2, '0000-00-00', 'jui12345@gmail.com', 2, 2, 2, 2),
(3, '0000-00-00', 'sbbnj12345@gmail.com', 3, 3, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `restaurants`
--

CREATE TABLE `restaurants` (
  `idRestaurant` int(11) NOT NULL,
  `nomRestaurant` varchar(50) DEFAULT NULL,
  `adresseRestaurant` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `restaurants`
--

INSERT INTO `restaurants` (`idRestaurant`, `nomRestaurant`, `adresseRestaurant`) VALUES
(1, 'Crous capitole ', '2 Rue du Doyen-Gabriel-Marty'),
(2, 'Crous manu', '21 Allée de Brienne'),
(3, 'Crous ancienne fac', '2 rue Lautman');

-- --------------------------------------------------------

--
-- Structure de la table `typesaffiche`
--

CREATE TABLE `typesaffiche` (
  `idTypeAffiche` int(11) NOT NULL,
  `nomTypeAffiche` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typesaffiche`
--

INSERT INTO `typesaffiche` (`idTypeAffiche`, `nomTypeAffiche`) VALUES
(0, 'Tous'),
(1, 'Protect my UT1'),
(2, 'FindMySac'),
(3, 'FindMyclé'),
(4, 'FindMyappareils'),
(5, 'FindMyElctroniques');

-- --------------------------------------------------------

--
-- Structure de la table `typesmanipulation`
--

CREATE TABLE `typesmanipulation` (
  `idTypeManipulation` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typesmanipulation`
--

INSERT INTO `typesmanipulation` (`idTypeManipulation`, `description`) VALUES
(1, 'ajouter'),
(2, 'modifier '),
(3, 'supprimer'),
(4, 'consulter');

-- --------------------------------------------------------

--
-- Structure de la table `typesplat`
--

CREATE TABLE `typesplat` (
  `idTypeP` int(11) NOT NULL,
  `nomTypeP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typesplat`
--

INSERT INTO `typesplat` (`idTypeP`, `nomTypeP`) VALUES
(1, ' Tartiflette'),
(2, 'Steak tartare'),
(3, 'Cassoulet');

-- --------------------------------------------------------

--
-- Structure de la table `typesplatprecis`
--

CREATE TABLE `typesplatprecis` (
  `idTypePP` int(11) NOT NULL,
  `nomTypePP` varchar(50) DEFAULT NULL,
  `idTypeP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typesplatprecis`
--

INSERT INTO `typesplatprecis` (`idTypePP`, `nomTypePP`, `idTypeP`) VALUES
(1, 'Tarte aux pommes', 1),
(2, 'Bœuf bourguignon', 2),
(3, ' Raclette', 3);

-- --------------------------------------------------------

--
-- Structure de la table `typeuser`
--

CREATE TABLE `typeuser` (
  `idTypeUser` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typeuser`
--

INSERT INTO `typeuser` (`idTypeUser`, `description`) VALUES
(1, 'étudiant'),
(2, 'professeur'),
(3, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nomUser` varchar(50) NOT NULL,
  `prenomUser` varchar(50) NOT NULL,
  `mailUser` varchar(50) NOT NULL,
  `idTypeUser` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `etat` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `nomUser`, `prenomUser`, `mailUser`, `idTypeUser`, `password`, `etat`) VALUES
(1, 'Bernard ', 'Petit', 'Bernard.Petit@gmail.com', 1, 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Dubois ', 'David', 'Dubois.David@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'Bonnet ', 'Lambert', 'Bonnet.Lambert@gmail.com', 3, 'e10adc3949ba59abbe56e057f20f883e', 1),
(9, 'tim', 'tom', 'mail1@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 0),
(11, 'Bonnet1', 'Bonnet1', 'mbert@gmail.com', 1, 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affiches`
--
ALTER TABLE `affiches`
  ADD PRIMARY KEY (`idAffiche`),
  ADD KEY `fk_idTypeAffiche_idx` (`idTypeAffiche`),
  ADD KEY `fk_affiches_idUsers` (`idUser`),
  ADD KEY `I_FK_Affiches_typesAffiche` (`idTypeAffiche`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `fk_Users_Articles` (`idUser`),
  ADD KEY `FK_articles_category` (`idCategorie`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `fk_idAffiche_idx` (`idAffiche`),
  ADD KEY `fk_commentaires_idUsers` (`idUser`),
  ADD KEY `I_FK_commentaires_Affiches` (`idAffiche`);

--
-- Index pour la table `concernerplat`
--
ALTER TABLE `concernerplat`
  ADD PRIMARY KEY (`idRestaurant`,`idTypeP`),
  ADD KEY `fk_idRestaurant_idx` (`idRestaurant`),
  ADD KEY `fk_idTypeP_idx` (`idTypeP`);

--
-- Index pour la table `contactrestaurant`
--
ALTER TABLE `contactrestaurant`
  ADD PRIMARY KEY (`idContactR`),
  ADD KEY `fk_idRestaurant_idx` (`idRestaurant`),
  ADD KEY `I_FK_contactRestaurant_restaurants` (`idRestaurant`);

--
-- Index pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD PRIMARY KEY (`idPanier`,`idRestaurant`),
  ADD KEY `fk_idPanier_idx` (`idPanier`),
  ADD KEY `fk_idRestaurant_idx` (`idRestaurant`);

--
-- Index pour la table `manipuleraffiche`
--
ALTER TABLE `manipuleraffiche`
  ADD PRIMARY KEY (`dateAff`,`idUser`,`idAffiche`,`idTypeManipulation`),
  ADD KEY `fk_idUser_idx` (`idUser`),
  ADD KEY `fk_idAffiche_idx` (`idAffiche`),
  ADD KEY `fk_idTypeManipulation_idx` (`idTypeManipulation`),
  ADD KEY `fk_dateAff_idx` (`dateAff`);

--
-- Index pour la table `manipulerarticle`
--
ALTER TABLE `manipulerarticle`
  ADD PRIMARY KEY (`dateArt`,`idUser`,`idTypeManipulation`,`idArticle`),
  ADD KEY `fk_idUser_idx` (`idUser`),
  ADD KEY `fk_dateArt_idx` (`dateArt`),
  ADD KEY `fk_idTypeManipulation_idx` (`idTypeManipulation`),
  ADD KEY `fk_idArticle_idx` (`idArticle`);

--
-- Index pour la table `manipulercommentaire`
--
ALTER TABLE `manipulercommentaire`
  ADD PRIMARY KEY (`idTypeManipulation`,`dateC`,`idCommentaire`,`idUser`),
  ADD KEY `fk_idTypeManipulation_idx` (`idTypeManipulation`),
  ADD KEY `fk_dateC_idx` (`dateC`),
  ADD KEY `fk_idCommentaire_idx` (`idCommentaire`),
  ADD KEY `fk_idUser_idx` (`idUser`);

--
-- Index pour la table `nourritures`
--
ALTER TABLE `nourritures`
  ADD PRIMARY KEY (`idNourriture`),
  ADD KEY `fk_ idTypePP_idx` (`idTypePP`),
  ADD KEY `I_FK_nourritures_typesPlatPrecis` (`idTypePP`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`idPanier`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`idReservation`,`dateP`),
  ADD KEY `fk_IdContactR_idxE` (`IdContactRE`),
  ADD KEY `fk_IdContactR_idxV` (`IdContactRV`),
  ADD KEY `fk_dateP_idx` (`dateP`),
  ADD KEY `fk_IdUser_idx` (`idUser`),
  ADD KEY `fk_idRestaurant_idx` (`idRestaurant`),
  ADD KEY `I_FK_reservations_contactRestaurantE` (`IdContactRE`),
  ADD KEY `I_FK_reservations_contactRestaurantV` (`IdContactRV`),
  ADD KEY `I_FK_reservations_User` (`idUser`),
  ADD KEY `I_FK_reservations_restaurants` (`idRestaurant`);

--
-- Index pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`idRestaurant`);

--
-- Index pour la table `typesaffiche`
--
ALTER TABLE `typesaffiche`
  ADD PRIMARY KEY (`idTypeAffiche`);

--
-- Index pour la table `typesmanipulation`
--
ALTER TABLE `typesmanipulation`
  ADD PRIMARY KEY (`idTypeManipulation`);

--
-- Index pour la table `typesplat`
--
ALTER TABLE `typesplat`
  ADD PRIMARY KEY (`idTypeP`);

--
-- Index pour la table `typesplatprecis`
--
ALTER TABLE `typesplatprecis`
  ADD PRIMARY KEY (`idTypePP`),
  ADD KEY `fk_idTypeP_idx` (`idTypeP`),
  ADD KEY `I_FK_typesPlatPrecis_typesPlat` (`idTypeP`);

--
-- Index pour la table `typeuser`
--
ALTER TABLE `typeuser`
  ADD PRIMARY KEY (`idTypeUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_IdTypeUser_idx` (`idTypeUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affiches`
--
ALTER TABLE `affiches`
  MODIFY `idAffiche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `contactrestaurant`
--
ALTER TABLE `contactrestaurant`
  MODIFY `idContactR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `nourritures`
--
ALTER TABLE `nourritures`
  MODIFY `idNourriture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `idRestaurant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typesaffiche`
--
ALTER TABLE `typesaffiche`
  MODIFY `idTypeAffiche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `typesmanipulation`
--
ALTER TABLE `typesmanipulation`
  MODIFY `idTypeManipulation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typesplat`
--
ALTER TABLE `typesplat`
  MODIFY `idTypeP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typesplatprecis`
--
ALTER TABLE `typesplatprecis`
  MODIFY `idTypePP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typeuser`
--
ALTER TABLE `typeuser`
  MODIFY `idTypeUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affiches`
--
ALTER TABLE `affiches`
  ADD CONSTRAINT `fk_affiches_idTypeAffiche` FOREIGN KEY (`idTypeAffiche`) REFERENCES `typesaffiche` (`idTypeAffiche`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_affiches_idUsers` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_articles_category` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Users_Articles` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_commentaires_idAffiche` FOREIGN KEY (`idAffiche`) REFERENCES `affiches` (`idAffiche`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commentaires_idUsers` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `concernerplat`
--
ALTER TABLE `concernerplat`
  ADD CONSTRAINT `fk_ConcernerPlat_idRestaurant` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurants` (`idRestaurant`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ConcernerPlat_idTypePP` FOREIGN KEY (`idTypeP`) REFERENCES `typesplat` (`idTypeP`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `contactrestaurant`
--
ALTER TABLE `contactrestaurant`
  ADD CONSTRAINT `fk_contactRestaurant_idRestaurant` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurants` (`idRestaurant`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD CONSTRAINT `fk_Fournir_idPanier` FOREIGN KEY (`idPanier`) REFERENCES `paniers` (`idPanier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Fournir_idRestaurant` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurants` (`idRestaurant`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `manipuleraffiche`
--
ALTER TABLE `manipuleraffiche`
  ADD CONSTRAINT `fk_ManipulerAffiche_idAffiche` FOREIGN KEY (`idAffiche`) REFERENCES `affiches` (`idAffiche`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerAffiche_idTypeManipulation` FOREIGN KEY (`idTypeManipulation`) REFERENCES `typesmanipulation` (`idTypeManipulation`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerAffiche_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `manipulerarticle`
--
ALTER TABLE `manipulerarticle`
  ADD CONSTRAINT `fk_ManipulerArticle_idArticle` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerArticle_idTypeManipulation` FOREIGN KEY (`idTypeManipulation`) REFERENCES `typesmanipulation` (`idTypeManipulation`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerArticle_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `manipulercommentaire`
--
ALTER TABLE `manipulercommentaire`
  ADD CONSTRAINT `fk_ManipulerCommentaire_idCommentaire` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaires` (`idCommentaire`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerCommentaire_idTypeManipulation` FOREIGN KEY (`idTypeManipulation`) REFERENCES `typesmanipulation` (`idTypeManipulation`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ManipulerCommentaire_idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `nourritures`
--
ALTER TABLE `nourritures`
  ADD CONSTRAINT `fk_nourritures_idTypePP` FOREIGN KEY (`idTypePP`) REFERENCES `typesplatprecis` (`idTypePP`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_IdUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservations_contactRestaurantE` FOREIGN KEY (`IdContactRE`) REFERENCES `contactrestaurant` (`idContactR`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservations_contactRestaurantV` FOREIGN KEY (`IdContactRV`) REFERENCES `contactrestaurant` (`idContactR`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservations_idRestaurant` FOREIGN KEY (`idRestaurant`) REFERENCES `restaurants` (`idRestaurant`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `typesplatprecis`
--
ALTER TABLE `typesplatprecis`
  ADD CONSTRAINT `fk_typesPlatPrecis_idTypeP` FOREIGN KEY (`idTypeP`) REFERENCES `typesplat` (`idTypeP`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_IdTypeUser` FOREIGN KEY (`idTypeUser`) REFERENCES `typeuser` (`idTypeUser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
