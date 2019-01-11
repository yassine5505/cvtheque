-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2019 at 03:09 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cvtheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `competence` varchar(255) DEFAULT NULL,
  `niveau` varchar(100) DEFAULT NULL,
  `apogee_etudiant` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competences`
--

INSERT INTO `competences` (`id`, `competence`, `niveau`, `apogee_etudiant`) VALUES
(1, 'Guitar', 'MiFa', 'Saad'),
(2, 'Guitar', 'MiFa', 'Saad');

-- --------------------------------------------------------

--
-- Table structure for table `competences_requises`
--

CREATE TABLE `competences_requises` (
  `id` int(11) NOT NULL,
  `competence` varchar(255) NOT NULL,
  `offre_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Diplomes_etudiant`
--

CREATE TABLE `Diplomes_etudiant` (
  `id` int(11) NOT NULL,
  `etudiant_apogee` varchar(20) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Diplomes_etudiant`
--

INSERT INTO `Diplomes_etudiant` (`id`, `etudiant_apogee`, `titre`, `ville`, `annee`, `description`) VALUES
(1, 'Saad', 'Bac-99', 'naouz', '1018', 'Baccalauréat-99'),
(2, 'Saad', 'Bac-99', 'naouz', '1018', 'Baccalauréat-99');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `adresse` char(60) DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `logo` char(255) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `adresse`, `phone`, `description`, `logo`, `password`) VALUES
(14, 'Ensa tanger', 'Tanger', '053744552233', 'Ecole ingenieurs', 'New Logo ENSA HD.png', NULL),
(13, 'Capgemini', 'Technopark, Casablanca', '0537887744', 'IT', 'CapGemini-logo-carre.png', NULL),
(12, 'Atos', 'Technopark, Rabat', '0533222211', 'Spécialisée dans IT.', 'Atos-logo-880x660.png', 'Atoss');

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `numero_apogee` varchar(255) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `numero_apogee`, `nom`, `prenom`, `phone`, `email`, `description`, `image`, `video`) VALUES
(1, 'gh444', 'Mehdi', 'chaaaaaaaaaa', '0654889977', '', 'Genie informatique 1 - Interesse par le developpement web', 'mehdi-chaert.jpg', NULL),
(2, 'Saad', 'Belgnaoui', 'Saad', '0999999999', 'man@gmail.man', 'chaoui', 'saad-belgnaoui.jpg', 'Saad.mp4'),
(3, '447', 'Reda', 'Ennakouri', '0600098419', '', 'Etudiant GI1', 'zuck.jpg', NULL),
(4, '447788', 'Yassine', 'Chra', '022114455', '', 'Genie info 2', 'zuck.jpg', NULL),
(5, '741', 'Abdellah', 'Benkirane', '0669874521', '', 'Description de Abdellah benkirane\'d', 'random.jpg', NULL),
(6, 's', 's', 's', 's', 'sss@gmail.com', 's@gmail.com', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `experiences_etudiant`
--

CREATE TABLE `experiences_etudiant` (
  `id` int(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `sous_domaine` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `etudiant_apogee` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experiences_etudiant`
--

INSERT INTO `experiences_etudiant` (`id`, `annee`, `titre`, `sous_domaine`, `description`, `etudiant_apogee`) VALUES
(1, '1600', 'Java', 'Tabi3i', 'App 9waleb', 'Saad'),
(2, '1600', 'Java', 'Tabi3i', 'App 9waleb', 'Saad');

-- --------------------------------------------------------

--
-- Table structure for table `langues_etudiant`
--

CREATE TABLE `langues_etudiant` (
  `id` int(20) NOT NULL,
  `numero_apogee` varchar(20) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `niveau` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `langues_etudiant`
--

INSERT INTO `langues_etudiant` (`id`, `numero_apogee`, `langue`, `niveau`) VALUES
(1, 'Saad', 'english', 'B99'),
(2, 'Saad', 'english', 'B99');

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `intitule` char(40) DEFAULT NULL,
  `duree` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id`, `entreprise_id`, `intitule`, `duree`) VALUES
(1, 6, 'Offre de stage bac +3', '2 mois'),
(2, 7, 'Offre de stage en developpement', '3 mois');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competences_requises`
--
ALTER TABLE `competences_requises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Diplomes_etudiant`
--
ALTER TABLE `Diplomes_etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences_etudiant`
--
ALTER TABLE `experiences_etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `langues_etudiant`
--
ALTER TABLE `langues_etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `competences_requises`
--
ALTER TABLE `competences_requises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diplomes_etudiant`
--
ALTER TABLE `Diplomes_etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `experiences_etudiant`
--
ALTER TABLE `experiences_etudiant`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `langues_etudiant`
--
ALTER TABLE `langues_etudiant`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
