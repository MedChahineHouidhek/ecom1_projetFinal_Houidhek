-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 12:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `numero_appartement` varchar(10) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `totale` float DEFAULT NULL,
  `date_commande` varchar(50) DEFAULT NULL,
  `id_personne` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commandeproduit`
--

CREATE TABLE `commandeproduit` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `chemin` varchar(255) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `chemin`, `id_produit`) VALUES
(1, 'images/img1.jpg', 1),
(2, 'images/img2.jpg', 2),
(3, 'images/img4.jpg', 3),
(4, 'images/img5.jpg', 4),
(5, 'images/img6.jpg', 5),
(6, 'images/img7.jpg', 6),
(7, 'images/img8.jpg', 7),
(8, 'images/img9.jpg', 8),
(12, 'images/img10.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_creation` varchar(50) DEFAULT NULL,
  `date_mis_a_jour` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `email`, `mot_de_passe`, `date_creation`, `date_mis_a_jour`) VALUES
(7, 'chahine', 'chahinehouidhek2@gmail.com', '$2y$10$LHFbKu19Hk/uG/eUYbZz/.HdHx5uJP53KsTGau/JfjLDbBeRwsctC', NULL, NULL),
(8, 'chahine', 'chahine@admin.com', '123456', NULL, NULL),
(9, 'chahine', 'chahinehouidhek@gmail.com', '$2y$10$9DmqWHYNrbjFROCXgzdgE.Rl9hr0OUGz7b91.C6nISO5PTf/Ra4Em', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personneadresse`
--

CREATE TABLE `personneadresse` (
  `id_personne` int(11) NOT NULL,
  `id_adresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnerole`
--

CREATE TABLE `personnerole` (
  `id_role` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnerole`
--

INSERT INTO `personnerole` (`id_role`, `id_personne`) VALUES
(1, 8),
(2, 7),
(2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `descreption` varchar(255) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `descreption`, `prix`, `quantite`) VALUES
(1, 'Collier', 'Illuminez chaque instant avec l\'éclat éblouissant de notre collier. Votre style, magnifié.', 32.89, 5),
(2, 'Broche', 'Exprimez-vous avec élégance à chaque épinglage. Notre broche sublime, votre style mis en lumière', 15.99, 6),
(3, 'Collier', 'Illuminez chaque instant avec l\'éclat éblouissant de notre collier. Votre style, magnifié.', 26.89, 4),
(4, 'Bracelet', 'Enveloppez votre poignet d\'élégance pure. Notre bracelet, votre signature de style', 40.99, 5),
(5, 'Pochette', 'Élevez votre style avec notre pochette raffinée. L\'élégance pratique à portée de main.', 18.99, 8),
(6, 'Sac fourre-tout', 'Explorez le luxe du quotidien avec notre sac fourre-tout. Votre style, votre espace, votre déclaration.', 15.99, 6),
(7, 'Sac a dox', 'Emportez tout ce dont vous avez besoin, avec style. Notre sac à dos : la fusion parfaite entre fonctionnalité et élégance.', 19.89, 4),
(8, 'Sac fourre-tout', 'Explorez le luxe du quotidien avec notre sac fourre-tout. Votre style, votre espace, votre déclaration.', 16.99, 7),
(12, 'Sac A doc', 'Emportez tout ce dont vous avez besoin, avec style. Notre sac à dos : la fusion parfaite entre fonctionnalité et élégance.', 45.99, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `titre`) VALUES
(1, 'admin'),
(2, 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fk_commande_personne` (`id_personne`);

--
-- Indexes for table `commandeproduit`
--
ALTER TABLE `commandeproduit`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `fk_produit_commande` (`id_produit`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_produit` (`id_produit`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personneadresse`
--
ALTER TABLE `personneadresse`
  ADD PRIMARY KEY (`id_personne`,`id_adresse`);

--
-- Indexes for table `personnerole`
--
ALTER TABLE `personnerole`
  ADD PRIMARY KEY (`id_role`,`id_personne`),
  ADD KEY `fk_personne` (`id_personne`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commandeproduit`
--
ALTER TABLE `commandeproduit`
  ADD CONSTRAINT `fk_commande_produit` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit_commande` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personnerole`
--
ALTER TABLE `personnerole`
  ADD CONSTRAINT `fk_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnerole_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
