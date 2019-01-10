-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 08:52 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvtheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `competence` varchar(255) DEFAULT NULL,
  `niveau` varchar(100) DEFAULT NULL,
  `etudiant_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `adresse` char(60) DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `logo` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `adresse`, `phone`, `description`, `logo`) VALUES
(14, 'Ensa tanger', 'Tanger', '053744552233', 'Ecole ingenieurs', 'New Logo ENSA HD.png'),
(13, 'Capgemini', 'Technopark, Casablanca', '0537887744', 'IT', 'CapGemini-logo-carre.png'),
(12, 'Atos', 'Technopark, Rabat', '0533222211', 'SpÃ©cialisÃ©e dans IT.', 'Atos-logo-880x660.png');

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
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `numero_apogee`, `nom`, `prenom`, `phone`, `email`, `description`, `image`) VALUES
(1, 'gh444', 'Mehdi', 'Chaou', '0654889977', '', 'Genie informatique 1 - Interesse par le developpement web', 'mehdi-chaert.jpg'),
(2, 'Saad', 'Belgnaoui', 'Saad', '0699441122', '', 'ElÃ¨ve ingÃ©nieur 3Ã¨me annÃ©e Informatique.\r\nEsprit d\'entreprenariat.', 'saad-belgnaoui.php'),
(3, '447', 'Reda', 'Ennakouri', '0600098419', '', 'Etudiant GI1', 'zuck.jpg'),
(4, '447788', 'Yassine', 'Chra', '022114455', '', 'Genie info 2', 'zuck.jpg'),
(5, '741', 'Abdellah', 'Benkirane', '0669874521', '', 'Description de Abdellah benkirane\'d', 'random.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `intitule` char(40) DEFAULT NULL,
  `duree` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
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
-- AUTO_INCREMENT for table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `competences_requises`
--
ALTER TABLE `competences_requises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
