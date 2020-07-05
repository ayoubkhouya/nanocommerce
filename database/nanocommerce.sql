-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2018 at 09:13 PM
-- Server version: 5.7.13-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nanocommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` text NOT NULL,
  `description_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cat`, `nom_cat`, `description_cat`) VALUES
(1, 'ordinateurs', 'cette catégorie contient des différent ordinateur de différent marque, des ordinateur bureau, des pc portable et des différent matériel de l\'ordinateur.'),
(2, 'telephone', 'Tous ce qui est concerne les telephone mobile, de tout marques.'),
(3, 'Imprimantes', 'Cette catégorie contient des produit des imprimantes est des scanner.'),
(4, 'TV', 'Tous les marques de televisions.');

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `id_cmd` int(11) NOT NULL,
  `date_cmd` date NOT NULL,
  `address_cmd` text NOT NULL,
  `state_cmd` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id_cmd`, `date_cmd`, `address_cmd`, `state_cmd`, `id_user`) VALUES
(1, '2017-02-03', 'Errachidia Hey El Qoudss', 0, 1),
(5, '2017-02-11', 'Ksar Igharghar Goulmima', 0, 1),
(6, '2017-02-11', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(7, '2017-02-12', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(8, '2017-02-12', 'Ksar Igharghar Goulmima', 0, 1),
(9, '2017-02-12', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(10, '2017-02-12', 'KSAR IGHARGHAR GOULMIMA', 0, 4),
(11, '2017-02-14', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(12, '2017-02-14', 'Ksar Igharghar Goulmima', 0, 1),
(13, '2017-02-15', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(14, '2017-02-17', 'Tighramt N Igrann Goulmima', 0, 3),
(15, '2017-02-19', 'Ksar Igharghar Goulmima', 0, 1),
(16, '2017-02-19', 'KSAR IGHARGHAR GOULMIMA', 0, 4),
(17, '2017-02-20', 'Ksar Igharghar Goulmima', 0, 1),
(18, '2017-02-20', 'Ksar Igharghar Goulmima', 0, 1),
(19, '2017-02-20', 'Ksar Igharghar Goulmima', 0, 1),
(20, '2017-02-20', 'Ksar Igharghar Goulmima', 0, 1),
(21, '2017-02-25', 'Errachidia Rue 15 Lehdeb n°36', 0, 1),
(22, '2017-03-04', 'Ksar Igharghar Goulmima', 0, 1),
(23, '2017-03-04', 'KSAR IGHARGHAR GOULMIMA', 0, 4),
(24, '2017-03-04', 'Ksar Igharghar Goulmima', 0, 1),
(25, '2017-03-04', 'Ksar Igharghar Goulmima', 0, 1),
(26, '2017-03-22', 'Ksar Igharghar Goulmima', 0, 1),
(27, '2017-04-06', 'Ksar Igharghar Goulmima', 0, 1),
(28, '2017-04-14', '', 0, 1),
(29, '2017-04-15', 'Ksar Igharghar Goulmima', 0, 1),
(30, '2017-06-18', 'Fes, aiiodu', 0, 1),
(31, '2017-08-15', 'Ksar Igharghar Goulmima', 0, 1),
(32, '2017-09-25', 'Settat centre ville rue 17', 0, 1),
(33, '2018-03-15', '18, rue al jiniral hey smaalla, settat', 0, 1),
(34, '2018-04-02', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detcommands`
--

CREATE TABLE `detcommands` (
  `id_det` int(11) NOT NULL,
  `qtte_det` int(11) NOT NULL,
  `prix_det` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_cmd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detcommands`
--

INSERT INTO `detcommands` (`id_det`, `qtte_det`, `prix_det`, `id_pro`, `id_cmd`) VALUES
(1, 3, 3900, 5, 1),
(2, 1, 3600, 6, 1),
(3, 5, 1056, 4, 1),
(4, 7, 3120, 5, 2),
(5, 2, 2520, 1, 1),
(6, 3, 1320, 2, 2),
(7, 3, 7500, 6, 5),
(8, 1, 3900, 5, 5),
(9, 5, 3600, 1, 5),
(10, 4, 1500, 2, 5),
(11, 5, 7500, 6, 6),
(12, 3, 3900, 5, 6),
(13, 4, 1500, 2, 6),
(14, 3, 7500, 6, 7),
(15, 3, 3900, 5, 7),
(16, 5, 1500, 2, 8),
(17, 2, 7500, 6, 8),
(18, 3, 850, 12, 9),
(19, 8, 1500, 2, 10),
(20, 2, 7500, 6, 10),
(21, 4, 850, 12, 10),
(22, 3, 3600, 1, 11),
(23, 5, 4200, 4, 12),
(24, 3, 1830, 7, 12),
(25, 4, 3600, 1, 12),
(26, 7, 850, 12, 12),
(27, 5, 3200, 5, 12),
(28, 1, 2560, 6, 12),
(29, 6, 1500, 3, 12),
(30, 4, 3200, 5, 13),
(31, 3, 1520, 2, 13),
(32, 3, 3600, 1, 13),
(33, 4, 1520, 2, 0),
(34, 2147483647, 4200, 4, 14),
(35, 4, 3600, 1, 15),
(36, 4, 1520, 2, 15),
(37, 3, 3200, 5, 15),
(38, 6, 2560, 6, 15),
(39, 5, 3200, 5, 16),
(40, 1, 2560, 6, 16),
(41, 2147483647, 1830, 7, 16),
(42, 4, 4200, 4, 17),
(43, 3, 1830, 7, 17),
(44, 7, 850, 12, 18),
(45, 5, 850, 12, 19),
(46, 1, 3600, 1, 19),
(47, 3, 4200, 4, 20),
(48, 3, 3200, 5, 20),
(49, 1, 1830, 7, 20),
(50, 2, 850, 12, 21),
(51, 4, 4200, 4, 21),
(52, 4, 1300, 11, 22),
(53, 3, 1300, 11, 23),
(54, 2, 1520, 2, 23),
(55, 5, 850, 12, 23),
(56, 2, 850, 12, 24),
(57, 1, 1500, 3, 24),
(58, 3, 1500, 3, 25),
(59, 1, 1830, 7, 25),
(60, 2, 850, 12, 25),
(61, 4, 850, 12, 26),
(62, 4, 4200, 4, 27),
(63, 4, 3200, 5, 28),
(64, 2, 1500, 3, 28),
(65, 3, 3600, 1, 29),
(66, 2, 4200, 4, 29),
(67, 3, 2560, 6, 29),
(68, 5, 850, 12, 30),
(69, 3, 4200, 4, 31),
(70, 2, 3200, 5, 32),
(71, 1, 1830, 7, 32),
(72, 2, 2560, 6, 32),
(73, 2, 1520, 2, 32),
(74, 3, 3600, 1, 32),
(75, 1, 4200, 4, 32),
(76, 4, 1500, 3, 33),
(77, 2, 4200, 4, 34);

-- --------------------------------------------------------

--
-- Table structure for table `fichetech`
--

CREATE TABLE `fichetech` (
  `id_fiche` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `content` text NOT NULL,
  `id_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id_pic` int(11) NOT NULL,
  `pic` text NOT NULL,
  `id_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id_pic`, `pic`, `id_pro`) VALUES
(1, 'img/product-1.jpg', 1),
(2, 'img/product-2.jpg', 2),
(3, 'img/product-1.jpg', 1),
(4, 'img/product-5.jpg', 2),
(5, 'img/product-4.jpg', 2),
(6, 'img/product-3.jpg', 2),
(7, 'img/product-1.jpg', 3),
(8, 'img/product-2.jpg', 4),
(9, 'img/product-4.jpg', 5),
(10, 'img/product-3.jpg', 1),
(19, 'img/products/product-1.jpg', 11),
(20, 'img/products/product-4.jpg', 11),
(21, 'img/products/product-5.jpg', 11),
(22, 'img/products/product-3.jpg', 11),
(23, 'img/products/product-1.jpg', 12),
(24, 'img/products/product-5.jpg', 12),
(25, 'img/products/product-4.jpg', 12),
(26, 'img/products/product-1.jpg', 12),
(27, 'img/products/product-4.jpg', 13),
(28, 'img/products/product-5.jpg', 13),
(29, 'img/products/product-1.jpg', 13),
(30, 'img/products/product-5.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_pro` int(11) NOT NULL,
  `nom_pro` text NOT NULL,
  `prix_pro` int(11) NOT NULL,
  `stock_pro` int(11) NOT NULL,
  `vignette_pro` text NOT NULL,
  `notation_pro` text NOT NULL,
  `description_pro` text NOT NULL,
  `promo_pro` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `isbanner` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_pro`, `nom_pro`, `prix_pro`, `stock_pro`, `vignette_pro`, `notation_pro`, `description_pro`, `promo_pro`, `views`, `isbanner`, `id_cat`) VALUES
(1, 'HP Laptop 77e', 3600, 121, 'img/product-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 20, 184, 0, 1),
(2, 'Samsung Galaxy S3', 1520, 19, 'img/product-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 30, 17, 0, 2),
(3, 'Samsung Galaxy Core Prime', 1500, 33, 'img/product-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 15, 25, 1, 2),
(4, 'Samsung TV', 4200, 51, 'img/product-5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 23, 193, 0, 4),
(5, 'Acer Aspire 5573z', 3200, 60, 'img/product-4.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 14, 173, 0, 1),
(6, 'Samsung Galaxy S4', 2560, 57, 'img/product-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 0, 61, 1, 2),
(7, 'Nokia Lumia 720', 1830, 88, 'img/product-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 8, 49, 0, 2),
(11, 'HP Lazer 547a8', 1300, 44, 'img/product-5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 8, 10, 0, 3),
(12, 'Accent Tablet', 850, 32, 'img/products/product-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. tempor incididunt ut labore et dolore.', 'RAM|1 GB\nVersion android|5.1\nNuméro du modél|acent fast 7 3G\n', 0, 13, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pub`
--

CREATE TABLE `pub` (
  `id_pub` int(11) NOT NULL,
  `pub` text NOT NULL,
  `link_pub` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pub`
--

INSERT INTO `pub` (`id_pub`, `pub`, `link_pub`) VALUES
(1, 'img/ads1.jpg', 'http://www.iam.ma/promotion/'),
(2, 'img/ads2.jpg', 'http://www.iam.ma/promotion/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom_user` text NOT NULL,
  `prenom_user` text NOT NULL,
  `avatar_user` text NOT NULL,
  `pwd_user` text NOT NULL,
  `email_user` text NOT NULL,
  `address_user` text NOT NULL,
  `country_user` text NOT NULL,
  `codezip_user` int(11) NOT NULL,
  `newsletterable` int(11) NOT NULL,
  `state_user` int(11) NOT NULL,
  `account_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `avatar_user`, `pwd_user`, `email_user`, `address_user`, `country_user`, `codezip_user`, `newsletterable`, `state_user`, `account_type`) VALUES
(1, 'HBA', 'Zakaria', 'img/product-2.jpg', '123', 'zakaria.hba.97@gmail.com', 'Ksar Igharghar Goulmima', 'Morocco', 25025, 1, 0, 1),
(3, 'ARIBA', 'Ibrahim', 'img/avatars/acent front.jpg', '123', 'ibrahim@gmail.com', 'Tighramt N Igrann Goulmima', 'MA', 32132, 1, 0, 0),
(4, 'LAMRABTI', 'Abdellatif', 'img/avatars/brand3.png', '123', 'lamrabtia@gmail.com', 'KSAR IGHARGHAR GOULMIMA', 'MA', 25025, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id_cmd`);

--
-- Indexes for table `detcommands`
--
ALTER TABLE `detcommands`
  ADD PRIMARY KEY (`id_det`);

--
-- Indexes for table `fichetech`
--
ALTER TABLE `fichetech`
  ADD PRIMARY KEY (`id_fiche`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id_pic`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_pro`);

--
-- Indexes for table `pub`
--
ALTER TABLE `pub`
  ADD PRIMARY KEY (`id_pub`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `detcommands`
--
ALTER TABLE `detcommands`
  MODIFY `id_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `fichetech`
--
ALTER TABLE `fichetech`
  MODIFY `id_fiche` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
