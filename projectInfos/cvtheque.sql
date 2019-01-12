-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2019 at 12:42 AM
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
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `candidatures`
--

CREATE TABLE `candidatures` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `offre_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidatures`
--

INSERT INTO `candidatures` (`id`, `etudiant_id`, `offre_id`) VALUES
(1, 0, 3),
(2, 0, 4),
(21, 0, 4),
(20, 0, 3);

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
(61, 'Word', 'Intermediaire', '123');

-- --------------------------------------------------------

--
-- Table structure for table `competences_requises`
--

CREATE TABLE `competences_requises` (
  `id` int(11) NOT NULL,
  `competence` varchar(255) NOT NULL,
  `offre_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competences_requises`
--

INSERT INTO `competences_requises` (`id`, `competence`, `offre_id`) VALUES
(1, 'word', 3),
(2, 'excel', 4),
(3, 'programmation', 4);

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
(165, '123', 'Bac+3', 'Kenitra', '2015', 'Ensa Kenitra'),
(167, '123', 'Bac', 'Kenitra', '2013', 'Bachelier sc. math A');

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
(16, 'cocacola', 'cocacola@gmail.com', '056474849', 'Une marque nord américaine de soda', '1280px-Coca-Cola_logo.svg.png', 'COCACOLA'),
(15, 'IBM', 'ibm@email.com', '0575757575', 'IBM Inc, une entreprise de l\'informatique', '1280px-IBM_logo.svg.png', 'IBM');

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
(0, '123', 'Chaou', 'Salma', '0672727272', 'SalmaChaou@gmail.com', 'Elève-ingénieur génie industriel Ensa Kenitra', '123.jpeg', '');

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
(168, '2016', 'Stage', 'Industriel', 'Stage PFA de la 2eme année', '123'),
(170, '2015', 'Stage', 'Industriel', 'Stage PFA de la 2eme année', '123');

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
(90, '123', 'Arab', 'Maternelle'),
(91, '123', 'Français', 'B2'),
(92, '123', 'Anglais', 'B1');

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
(4, 16, 'stage pfa', '2'),
(3, 16, 'stage pfe', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidatures`
--
ALTER TABLE `candidatures`
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
-- AUTO_INCREMENT for table `candidatures`
--
ALTER TABLE `candidatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `competences_requises`
--
ALTER TABLE `competences_requises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Diplomes_etudiant`
--
ALTER TABLE `Diplomes_etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `experiences_etudiant`
--
ALTER TABLE `experiences_etudiant`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `langues_etudiant`
--
ALTER TABLE `langues_etudiant`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
