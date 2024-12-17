-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 déc. 2024 à 10:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `purchase_order_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT ' 1 = Active, 0 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `status`, `date_created`) VALUES
(1, 'Item 1', 'Sample Item Only. Test 101', 1, '2021-09-08 10:17:19'),
(2, 'Item 102', 'Sample Only', 1, '2021-09-08 10:21:42'),
(3, 'Item 3', 'Sample product 103. 3x25 per boxes', 1, '2021-09-08 10:22:10'),
(5, 'Test Product', 'TEst ', 1, '2024-11-17 13:06:28'),
(8, 'Samsung', 'Téléphone ou équipement Samsung', 1, '2024-12-09 11:38:04'),
(9, 'PC Portable', 'Ordinateur portable polyvalent pour usage bureautique', 1, '2024-12-09 11:38:04'),
(10, 'RAM', 'Barrettes de mémoire vive DDR4 16GB', 1, '2024-12-09 11:38:04'),
(11, 'Caisse NCR', 'Caisse enregistreuse avec lecteur de codes-barres', 1, '2024-12-09 11:38:04'),
(12, 'ThinkPad', 'Ordinateur portable robuste pour les professionnels', 1, '2024-12-09 11:38:04'),
(13, 'Câble Réseaux', 'Câble Ethernet catégorie 6', 1, '2024-12-09 11:38:04'),
(14, 'HP', 'Imprimante multifonction HP LaserJet', 1, '2024-12-09 11:38:04'),
(15, 'Clavier', 'Clavier mécanique avec rétroéclairage', 1, '2024-12-09 11:38:04'),
(16, 'Souris', 'Souris optique sans fil avec capteur haute précision', 1, '2024-12-09 11:38:04'),
(17, 'Caméra', 'Caméra de surveillance HD avec vision nocturne', 1, '2024-12-09 11:38:04'),
(18, 'Écran Dell', 'Écran 27 pouces Full HD pour usage professionnel', 1, '2024-12-09 11:38:04'),
(19, 'Serveur Rack', 'Serveur Dell PowerEdge pour centre de données', 1, '2024-12-09 11:38:04'),
(20, 'Disque SSD', 'Disque SSD 1TB NVMe pour performances élevées', 1, '2024-12-09 11:38:04'),
(21, 'Onduleur APC', 'Onduleur de 1500 VA pour protection électrique', 1, '2024-12-09 11:38:04'),
(22, 'Casque Audio', 'Casque audio sans fil avec réduction de bruit', 1, '2024-12-09 11:38:04'),
(23, 'Routeur Cisco', 'Routeur Cisco avec capacités VPN', 1, '2024-12-09 11:38:04'),
(24, 'Switch Réseaux', 'Switch 24 ports Gigabit Ethernet', 1, '2024-12-09 11:38:04'),
(25, 'Projecteur Epson', 'Projecteur Full HD pour présentations', 1, '2024-12-09 11:38:04'),
(26, 'Scanner', 'Scanner A4 pour numérisation de documents', 1, '2024-12-09 11:38:04'),
(27, 'Tablette', 'Tablette Samsung Galaxy Tab S7', 1, '2024-12-09 11:38:04');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `unit_price` float NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`po_id`, `item_id`, `unit`, `unit_price`, `quantity`) VALUES
(30, 5, 'pcs', 220, 22),
(31, 5, 'pcs', 111, 17),
(36, 1, 'PCS', 2130, 22),
(37, 5, 'pcs', 2330, 22),
(34, 2, 'pcs', 700, 22),
(34, 1, 'KG', 900, 22),
(34, 5, 'pcs', 1209, 11),
(38, 3, 'pcs', 777, 22),
(42, 5, 'pcs', 500, 33),
(43, 5, 'pcs', 10000000, 2),
(35, 13, 'pcs', 1111, 11),
(1, 1, 'boxes', 15000, 10),
(1, 2, 'pcs', 17999.9, 6),
(1, 3, 'PCS', 222222, 22);

-- --------------------------------------------------------

--
-- Structure de la table `po_list`
--

CREATE TABLE `po_list` (
  `id` int(30) NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `discount_percentage` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_amount` float NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status_sales` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied',
  `status_finance` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `po_list`
--

INSERT INTO `po_list` (`id`, `po_no`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `notes`, `status`, `date_created`, `date_updated`, `status_sales`, `status_finance`) VALUES
(1, '2024-0004', 4, 5, 257344, 10, 514688, 'Purchase request for office supplies', 1, '2021-09-08 15:20:57', '2024-12-13 15:35:15', 1, 1),
(30, 'PO-08610063363', 2, 0, 0, 0, 0, 'RF', 2, '2024-11-17 13:26:25', '2024-11-21 12:06:18', 2, 2),
(31, 'PO-09069922300', 2, 10, 188.7, 0, 0, 'TESTTT', 1, '2024-11-17 13:47:55', '2024-11-21 15:17:00', 2, 1),
(34, 'PO-78676275997', 2, 0, 0, 0, 0, 'AFFRICA', 1, '2024-11-20 16:08:42', '2024-11-20 16:28:23', 1, 0),
(35, 'PO-37739194066', 4, 0, 0, 0, 0, '', 1, '2024-11-21 15:31:05', '2024-11-21 15:37:51', 1, 0),
(36, '2024-0001', 1, 0, 0, 0, 0, '', 0, '2024-11-22 09:02:10', NULL, 0, 0),
(37, '2024-0002', 1, 0, 0, 0, 0, '', 0, '2024-11-22 09:02:40', NULL, 0, 0),
(38, '2024-0003', 1, 0, 0, 0, 0, '', 0, '2024-11-22 09:19:10', NULL, 0, 0),
(42, '2024-0005', 1, 5, 825, 8, 1320, '.OK', 2, '2024-12-06 10:13:28', NULL, 2, 2),
(43, '2024-0006', 4, 0, 0, 0, 0, '', 0, '2024-12-08 15:48:13', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pr_list`
--

CREATE TABLE `pr_list` (
  `id` int(30) NOT NULL,
  `pr_no` varchar(100) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `discount_percentage` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_amount` float NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status_sales` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied',
  `status_finance` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= Approved, 2 = Denied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pr_list`
--

INSERT INTO `pr_list` (`id`, `pr_no`, `requestor_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `notes`, `status`, `date_created`, `date_updated`, `status_sales`, `status_finance`) VALUES
(2, '2024-0005', 3, 10, 1500, 5, 750, 'Request for IT equipment', 1, '2021-09-09 09:00:00', '2024-12-05 14:30:00', 1, 1),
(3, '2024-0006', 3, 8, 1200, 12, 1440, 'Purchase request for office furniture', 0, '2021-09-10 12:00:00', '2024-12-05 15:00:00', 0, 1),
(4, '2024-0007', 14, 15, 2500, 20, 5000, 'Office renovation supplies', 0, '2021-09-11 08:30:00', '2024-12-06 10:00:00', 0, 0),
(5, '2024-0008', 11, 5, 7171.85, 18, 25818.7, 'Siege', 1, '2021-09-12 11:15:00', '2024-12-13 16:06:25', 1, 1),
(6, '2024-0009', 11, 12, 5000, 8, 4000, 'Urgent purchase for maintenance', 0, '2021-09-13 13:45:00', '2024-12-07 16:00:00', 0, 0),
(27, '2024-0001', 14, 10, 9800, 5, 4900, 'First Purshse Requisition', 2, '2024-12-09 11:09:18', '2024-12-09 12:49:07', 2, 2),
(29, '2024-0002', 11, 20, 51576.8, 5, 12894.2, 'Second Purshase Requisition', 2, '2024-12-09 11:10:52', NULL, 1, 0),
(31, '2024-0003', 3, 5, 1111.1, 2, 444.44, 'Third Purshase Requisition', 1, '2024-12-09 11:12:02', '2024-12-09 11:40:31', 1, 1),
(32, '2024-0010', 15, 0, 0, 0, 0, 'Siége', 1, '2024-12-16 14:41:20', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `req_items`
--

CREATE TABLE `req_items` (
  `pr_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `Description_Item` varchar(250) NOT NULL,
  `unit_price` float NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `req_items`
--

INSERT INTO `req_items` (`pr_id`, `item_id`, `unit`, `Description_Item`, `unit_price`, `quantity`) VALUES
(1, 1, 'boxes', '', 15000, 10),
(1, 2, 'pcs', '', 17999.9, 6),
(2, 5, 'pcs', '', 220, 22),
(2, 5, 'pcs', '', 111, 17),
(3, 1, 'PCS', '', 2130, 22),
(0, 5, 'pcs', '', 2000, 22),
(4, 5, 'PCS', '', 100, 222),
(6, 5, 'pcs', '', 222, 11),
(8, 5, 'pcs', '', 2000, 111),
(9, 5, 'pcs', '', 2000, 111),
(10, 5, 'pcs', '', 2000, 111),
(11, 5, 'pcs', '', 2000, 111),
(12, 2, 'pcs', '', 11223, 11),
(13, 2, 'pcs', '', 11223, 11),
(14, 2, 'pcs', '', 11223, 11),
(15, 2, 'pcs', '', 11223, 11),
(22, 5, 'pcs', 'BK CASA', 111, 111),
(22, 2, 'pcs', 'BK CASA', 1121, 111),
(23, 5, 'PCS', 'TTTTT', 4000, 2),
(26, 5, 'PCS', 'TTTTT', 4444, 1),
(29, 3, 'pcs', 'BK CASA', 10000, 11),
(29, 2, 'pcs', 'BK CASA', 11111, 11),
(29, 1, 'boxes', 'BK CASA', 1111, 11),
(29, 5, 'pcs', 'BK CASA', 111, 11),
(31, 12, 'pcs', 'BK CASA', 22222, 1),
(2, 8, 'pcs', 'Samsung Galaxy A52', 2200, 5),
(2, 9, 'pcs', 'Lenovo ThinkPad E15', 8500, 3),
(3, 10, 'pcs', 'Office Chair', 200, 20),
(3, 11, 'pcs', 'Work Desk', 1500, 10),
(4, 12, 'pcs', 'Paint Supplies', 50, 50),
(4, 13, 'pcs', 'Construction Tools', 1200, 8),
(6, 16, 'pcs', 'Power Tools', 2000, 15),
(6, 17, 'pcs', 'Safety Equipment', 800, 10),
(27, 5, 'pcs', 'BK CASA', 2000, 15),
(27, 2, 'boxes', 'BK SETTAT', 2000, 14),
(27, 1, 'boxes', 'BK SETTAT', 2000, 20),
(5, 2, 'PCS', 'SA', 1111, 111),
(5, 5, 'boxes', 'tsT', 30, 33),
(5, 14, 'pcs', 'Notebooks', 20, 100),
(5, 15, 'pcs', 'Pens and Markers', 5, 300),
(5, 13, 'PCS', '', 30, 33),
(5, 11, 'boxes', 'Caisse ', 333, 22),
(5, 20, 'boxes', 'Disque ', 388, 10),
(5, 12, 'boxes', 'PC', 343, 10),
(32, 8, 'boxes', 'Siége', 500, 10),
(32, 16, 'boxes', 'Siége', 500, 10),
(32, 25, 'boxes', 'Siége', 500, 10),
(32, 19, 'boxes', 'Siége', 500, 10),
(32, 9, 'boxes', 'Siége', 500, 10),
(32, 19, 'boxes', 'Siége', 500, 10),
(32, 27, 'boxes', 'Siége', 500, 10),
(32, 11, 'boxes', 'Siége', 500, 10),
(32, 23, 'boxes', 'Siége', 500, 10),
(32, 17, 'boxes', 'Siége', 500, 10),
(32, 24, 'boxes', 'Siége', 500, 10);

-- --------------------------------------------------------

--
-- Structure de la table `req_list`
--

CREATE TABLE `req_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 0 = Inactive, 1 = Active',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `address`, `contact_person`, `contact`, `email`, `status`, `date_created`) VALUES
(1, 'Supplier 101', 'Sample Address Only', 'George Wilson', '09123459879', 'supplier101@gmail.com', 1, '2021-09-08 09:46:45'),
(2, 'Supplier 102', 'Supplier 102 Address, 23rd St, Sample City, Test Province, ####', 'Samantha Lou', '09332145889', 'sLou@supplier102.com', 1, '2021-09-08 10:25:12'),
(4, 'Alhamd Informatique', '4317 Raccoon Run Seattle, WA 98101', 'abdelkarim', '', 'achrafmobile56@gmail.com', 1, '2024-11-21 15:28:47'),
(5, 'TEST REQUISITOR', 'AIN SEBAA CASABLANCA', '', '', 'hammouachraf56@gmail.com', 1, '2024-12-05 10:27:54');

-- --------------------------------------------------------

--
-- Structure de la table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'GENERALE FIRST FOOD SERVICES SAS'),
(6, 'short_name', 'BK-Orders'),
(11, 'logo', 'uploads/1731842160_Burger-King-Logo.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1733739660_Silver-Blur-Background-Wallpaper.jpg'),
(15, 'company_name', 'GENERALE FIRST FOOD SERVICES SAS'),
(16, 'company_email', ''),
(17, 'company_address', '73, BD ANFA ANGEL 1 RUE CLOS PROVENCE, \r\n1er ETAGE CASABLANCA');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `Email_User` varchar(250) DEFAULT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `Email_User`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', 'hammouachraf@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/1731842640_rekrute.jpg', NULL, 1, '2021-01-20 14:02:37', '2024-12-16 12:18:12'),
(3, 'Saler', 'Williams', 'mwilliams', 'userbk@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'uploads/1630999200_avatar5.png', NULL, 2, '2021-09-07 15:20:40', '2024-12-16 12:20:38'),
(11, 'sales Departement', 'Achraf', 'achraf', 'userbk@gmail.com', 'cb9f6ab19a8f292a0b0723bdbb45148b', 'uploads/1733736780_3135715.png', NULL, 2, '2024-11-19 10:14:38', '2024-12-16 12:21:04'),
(13, 'dg', 'Director ', 'dg', 'userbk@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/1733736780_3135715.png', NULL, 4, '2024-11-19 12:05:35', '2024-12-16 12:18:32'),
(14, 'finance departement', 'financer', 'finance', 'userbk@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/1733736780_3135715.png', NULL, 3, '2024-11-19 12:06:00', '2024-12-16 12:21:24'),
(15, 'IT', 'Ilyass EL Idrissi', 'ilyass', 'ilyassbkit@gmail.com', '73753dff83eab72c09e1849997965a73', NULL, NULL, 4, '2024-12-16 14:38:27', NULL),
(16, 'HUMAN RESSOURCES', 'RH GFFS ', 'GFFS', 'RhGffsbkit@gmail.com', '6d701280101ecb69c7767026284212a4', NULL, NULL, 1, '2024-12-17 09:53:06', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_no` (`item_id`);

--
-- Index pour la table `po_list`
--
ALTER TABLE `po_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Index pour la table `pr_list`
--
ALTER TABLE `pr_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pr_list_ibfk_1` (`requestor_id`);

--
-- Index pour la table `req_items`
--
ALTER TABLE `req_items`
  ADD KEY `pr_id` (`pr_id`),
  ADD KEY `req_items_ibfk_1` (`item_id`);

--
-- Index pour la table `req_list`
--
ALTER TABLE `req_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `po_list`
--
ALTER TABLE `po_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `pr_list`
--
ALTER TABLE `pr_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `req_list`
--
ALTER TABLE `req_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `po_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `po_list`
--
ALTER TABLE `po_list`
  ADD CONSTRAINT `po_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pr_list`
--
ALTER TABLE `pr_list`
  ADD CONSTRAINT `pr_list_ibfk_1` FOREIGN KEY (`requestor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `req_items`
--
ALTER TABLE `req_items`
  ADD CONSTRAINT `req_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
