-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 05:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sauna_mvc_4_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_url`, `title`, `post`, `image`, `date`, `slug`) VALUES
(19, '7xv8b2va9hc', 'Dsad', 'Khkjhkhjkhkhjk', 'uploads/pIdLxYEmg5qNVu9J59mPFXsD9lcXGjOSOspMRrb8KatoRDnjwRXjuU0tRQkx.jpg', '2024-09-06 12:00:51', 'dsad'),
(20, '7xv8b2va9hc', 'Sddsa D', 'Dsadsadasd', 'uploads/0Vj0ZfIqXRsKiKGzApjoghiI5ZuAU4bXHsc47Igdcse2RyHu2fUHwe5PwJbq.jpg', '2024-10-05 21:34:15', 'sddsa-d'),
(21, '7xv8b2va9hc', 'Grgdf', 'Gfdgdf', NULL, '0000-00-00 00:00:00', 'grgdf');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `disabled`, `views`) VALUES
(1, 'addidas', 1, 0),
(2, 'Nike', 1, 0),
(4, 'Wastro', 1, 0),
(5, 'LIAZ', 1, 0),
(6, 'Cvrčovice', 1, 0),
(7, 'Lind', 1, 0),
(8, 'Božkov', 1, 0),
(9, 'Absolut', 1, 0),
(10, 'Škoda', 1, 0),
(11, 'Opavia', 1, 0),
(12, 'BmD', 1, 0),
(15, 'Samsung', 1, 0),
(16, 'Tesla', 1, 0),
(17, 'Volvo', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `disabled`, `parent`, `views`) VALUES
(84, 'Fruts', 1, 150, 0),
(87, 'Nákladní Vozy', 1, 103, 18),
(88, 'Osobní Vozy', 1, 103, 11),
(89, 'Vybavení Domu', 1, 0, 8),
(91, 'Pečivo', 1, 98, 2),
(94, 'Zelená Jablka', 1, 84, 3),
(95, 'Exoticke Ovoce', 1, 84, 0),
(97, 'Sladkosti', 1, 98, 44),
(98, 'Food', 1, 0, 0),
(99, 'Nábytek', 1, 89, 2),
(100, 'Místní Ovoce', 1, 84, 0),
(101, 'Motocykly', 1, 103, 5),
(102, 'Sladké Pečivo', 1, 91, 31),
(103, 'Cars', 1, 0, 6),
(104, 'Drinks', 1, 98, 0),
(105, 'Elektronika', 1, 0, 18),
(106, 'Slané Pečivo', 1, 91, 15);

-- --------------------------------------------------------

--
-- Table structure for table `footer_menu`
--

DROP TABLE IF EXISTS `footer_menu`;
CREATE TABLE `footer_menu` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `shelf` text NOT NULL,
  `shelf_order` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `place` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer_menu`
--

INSERT INTO `footer_menu` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`, `place`) VALUES
(22, 1, 'Admin', 5, 'user_login', '', 'admin', 'service'),
(24, 1, 'Online Help', 1, '', '', 'online_help', 'service'),
(25, 2, 'Služby', 0, 'service_title', '', '#', 'service'),
(31, 1, 'FAQs', 4, '', '', 'FAQs', 'service'),
(32, 2, 'Časté Otázky', 4, '', '', 'FAQs', 'service'),
(33, 1, 'Service', 0, 'service_title', '', '#', 'service'),
(34, 2, 'Online Pomoc', 1, '', '', 'online_help', 'service'),
(35, 2, 'Kontakt', 2, '', '', 'contact', 'service'),
(36, 2, 'Admin', 5, 'user_login', '', 'admin', 'service'),
(37, 1, 'Policies', 0, 'policies_title', '', '', 'policies'),
(38, 1, 'Terms Of Use', 0, '', '', 'terms_of_use', 'policies'),
(39, 1, 'Privecy Policy', 0, '', '', 'privecy_policy', 'policies'),
(40, 1, 'Refund Policy', 0, '', '', 'refund_policy', 'policies'),
(41, 2, 'Obchodní Podmínky', 0, '', '', 'terms_of_use', 'policies'),
(42, 2, 'Soukromí', 0, '', '', 'privecy_policy', 'policies'),
(43, 2, 'Reklamace', 0, '', '', 'refund_policy', 'policies'),
(44, 2, 'Nakupování', 0, 'policies_title', '', '', 'policies'),
(45, 1, 'About Shopper', 0, 'about_shoper_titile', '', '', 'about_shoper'),
(46, 1, 'Company Information', 0, '', '', 'company-information', 'about_shoper'),
(48, 1, 'Store Location', 0, '', '', 'store-location', 'about_shoper'),
(49, 1, 'Careers', 0, '', '', 'careers', 'about_shoper'),
(50, 1, 'Affillate Program', 0, '', '', 'affillate-program', 'about_shoper'),
(51, 1, 'Copyright', 0, '', '', 'copyright', 'about_shoper'),
(52, 2, 'O Nás', 0, 'about_shoper_titile', '', '', 'about_shoper'),
(53, 2, 'O Nás', 0, '', '', 'company-information', 'about_shoper'),
(54, 2, 'Adresa', 0, '', '', 'store-location', 'about_shoper'),
(55, 2, 'Kariéra', 0, '', '', 'careers', 'about_shoper'),
(56, 2, 'Spolupráce-Reklama', 0, '', '', 'affillate-program', 'about_shoper'),
(57, 2, 'Copyright', 0, '', '', 'copyright', 'about_shoper'),
(59, 1, 'Copyright © 2024 E-SHOPPER Inc. All Rights Reserved.', 0, 'parapgaph', '', '', 'footer_down_left'),
(60, 1, 'Contact Us', 5, '', '', 'contact', 'service'),
(61, 2, 'Copyright © 2024 Sauna Klub Slaný All Rights Reserved.', 0, 'parapgaph', '', '', 'footer_down_left'),
(62, 1, 'Designed By', 0, 'ancor', '', 'http://www.saunaklubslany.cz', 'footer_down_right'),
(63, 2, 'Vyrobil', 0, 'ancor', '', 'http://www.saunaklubslany.cz', 'footer_down_right'),
(64, 1, 'Sauna Klub Slaný', 0, 'ancor_text', '', '', 'footer_down_right'),
(65, 2, 'Sauna Klub Slaný', 0, 'ancor_text', '', '', 'footer_down_right'),
(66, 2, '122 Kynského Slaný, Czech Republic (CR)', 0, 'paragraph', '', '', 'footer_img_popis'),
(67, 1, '122 Kynského Slaný, Czech Republic (CR)', 0, 'paragraph', '', '', 'footer_img_popis'),
(68, 1, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit,sed Do Eiusmod Tempor', 0, 'paragraph', '', '', 'footer_logo_popis'),
(69, 2, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit,sed Do Eiusmod Tempor', 0, 'paragraph', '', '', 'footer_logo_popis'),
(70, 2, 'Sauna-<span>Klub</span>-Slaný', 0, 'logo', '', '', 'footer_logo'),
(71, 1, 'Sauna-<span>Klub</span>-Slaný', 0, 'logo', '', '', 'footer_logo'),
(72, 1, 'Category', 0, 'title_category', '', '', 'sidebar'),
(73, 2, 'Kategorie', 0, 'title_category', '', '', 'sidebar'),
(74, 2, 'Pokročlé Vyhledávání', 0, 'title_search', '', '', 'sidebar'),
(75, 1, 'Advance Search', 0, 'title_search', '', '', 'sidebar'),
(76, 2, '--Vyber Kategorii--', 0, 'select_category', '', '', 'sidebar'),
(77, 1, '--Any Category--', 0, 'select_category', '', '', 'sidebar'),
(79, 1, 'Quantity', 0, 'quantity', '', '', 'sidebar'),
(80, 2, 'Množství', 0, 'quantity', '', '', 'sidebar'),
(81, 2, 'Rozsah Ceny', 0, 'price_range', '', '', 'sidebar'),
(82, 1, 'Price Range:', 0, 'price_range', '', '', 'sidebar'),
(83, 2, '--Vyber Rok--', 0, 'year', '', '', 'sidebar'),
(84, 1, '--Any Year--', 0, 'year', '', '', 'sidebar'),
(85, 2, 'Popis Produktu', 0, 'product_description', '', '', 'sidebar'),
(86, 1, 'Product Description', 0, 'product_description', '', '', 'sidebar'),
(87, 1, 'Features Items', 0, 'features_items', '', '', 'index_shop'),
(88, 2, 'Nábídka Zboží', 0, 'features_items', '', '', 'index_shop'),
(89, 2, 'Přidat Do Košíku', 0, 'card_add_buttons', '', '', 'index_shop'),
(90, 1, 'Add To Cart', 0, 'card_add_buttons', '', '', 'index_shop');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `shelf` varchar(15) NOT NULL,
  `shelf_order` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`) VALUES
(22, 1, 'Home', 1, '', '', 'homeshop'),
(23, 1, 'Shop', 2, '', '', 'shop'),
(24, 1, 'Blog', 3, '', '', 'blog'),
(25, 1, 'Contact', 4, '', '', 'contact'),
(26, 2, 'Domů', 1, '', '', 'homeshop'),
(27, 2, 'Kontakt', 4, '', '', 'contact'),
(28, 2, 'Blog', 3, '', '', 'blog'),
(29, 2, 'Obchod', 2, '', '', 'shop'),
(30, 2, 'Sauna', -1, '', '', 'home'),
(31, 1, 'Sauna', -1, '', '', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `street` varchar(1024) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `country` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `shipping` double DEFAULT 0,
  `date` datetime NOT NULL,
  `sessionid` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_url`, `street`, `total`, `country`, `city`, `zip`, `tax`, `shipping`, `date`, `sessionid`, `phone`) VALUES
(159, 'b0zfhyge90ceb', 'Hořešovice 54,', 408, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:27:55', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(160, 'b0zfhyge90ceb', 'Hořešovice 54,', 50, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:38:41', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(161, 'b0zfhyge90ceb', 'Hořešovice 54,', 50, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:41:20', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(162, 'b0zfhyge90ceb', 'Hořešovice 54,', 456963, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:42:25', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(163, 'b0zfhyge90ceb', 'Hořešovice 54,', 154, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:43:29', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(164, 'b0zfhyge90ceb', 'Hořešovice 54,', 7891456, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:44:54', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(165, 'b0zfhyge90ceb', 'Hořešovice 54,', 7891456, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-27 17:46:51', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(166, 'b0zfhyge90ceb', 'Hořešovice 54,', 246, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-28 19:06:14', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(167, 'b0zfhyge90ceb', 'Hořešovice 54,', 246, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-28 19:07:52', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(168, 'b0zfhyge90ceb', 'Hořešovice 54,', 1704, 'Czechia', 'Slaný', '27374', 0, 0, '2024-11-28 19:20:21', '9lfkpmcim0lcjgg3bg7r0uefmm', '725574353'),
(169, 'b0zfhyge90ceb', 'Hořešovice 54,', 123, 'Czechia', 'Slaný', '27374', 0, 0, '2024-12-01 08:38:41', 'qudm3dfacb2p4kqu2tp7ekm9lm', '725574353'),
(170, 'b0zfhyge90ceb', 'Hořešovice 54,', 123, 'Czechia', 'Slaný', '27374', 0, 0, '2024-12-01 09:00:57', 'qudm3dfacb2p4kqu2tp7ekm9lm', '725574353'),
(171, '7xv8b2va9hc', 'Hořešovice 58,', 1578, 'Czechia', 'Hořešovice 58', '27374', 0, 0, '2024-12-05 17:20:11', 'v3aqg6eki74hfib50bj1qk2q3t', '725574353'),
(172, '7xv8b2va9hc', 'Hořešovice 58,', 789, 'Czechia', 'Hořešovice 58', '27374', 0, 0, '2024-12-05 17:24:27', 'v3aqg6eki74hfib50bj1qk2q3t', '725574353');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `qty`, `description`, `amount`, `total`, `product_id`) VALUES
(163, 159, 2, 'Pralinky', 154, 308, 167),
(164, 159, 2, 'Chléb', 50, 100, 166),
(165, 160, 1, 'Chléb', 50, 50, 166),
(166, 161, 1, 'Chléb', 50, 50, 166),
(167, 162, 1, 'Matez', 456963, 456963, 165),
(168, 163, 1, 'Pralinky', 154, 154, 167),
(169, 164, 1, 'Auto', 7891456, 7891456, 161),
(170, 165, 1, 'Auto', 7891456, 7891456, 161),
(171, 167, 2, 'Chléb', 123, 246, 166),
(172, 168, 3, 'Matez', 568, 1704, 165),
(173, 169, 1, 'Chléb', 123, 123, 166),
(174, 170, 1, 'Chléb', 123, 123, 166),
(175, 171, 2, 'Pralinky', 789, 1578, 167),
(176, 172, 1, 'Pralinky', 789, 789, 167);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `brand` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `image3` varchar(500) DEFAULT NULL,
  `image4` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_url`, `description`, `brand`, `image`, `image2`, `image3`, `image4`, `date`, `slag`) VALUES
(161, 'b0zfhyge90ceb', 'Auto', 10, 'uploads/tHAAlochXHvRVIgJLOsJl4KelfNZv4rCLOxPRMEktUdF7EGtyItSKeMBegwy_skoda.jpg', 'uploads/7Yy2Ba7UT11qmU8eLYhnoEYXiYIKS3BXNSFpbyJ3jJyrvck3SmUo2WRMyWvb_iphone15.jpg', '', 'uploads/7dgpAAASSIGI2tAjyUkH6k14uOMtvUvh1HIsaGDL8oM2jgBZmwqYew6sb4gJ_rohlik.jpg', '2024-11-12 23:06:31', 'auto'),
(163, 'b0zfhyge90ceb', 'Rohlíky', 6, 'uploads/YIbaNV91JOUkzBXbKbDh0ms5ZLdTum9pzC2yikgUdH2zshyJpfDYjI1fRMFw_rohlik.jpg', '', '', '', '2024-11-27 13:08:50', 'rohliky'),
(164, 'b0zfhyge90ceb', 'Lázeňské Oplatky', 11, 'uploads/LuZgfx592BUs2Z4gICW7bYj3QbK4R57nUzS5mtu1ukNZQLfSK8fC8Td4Ww3I_oplatky.jpg', 'uploads/ssC0dOPJvm4bD9seKxH5CSc3qmbpOAEiPMmP50OoT2bpeDchWewS9A80DTAB_oplatky.jpg', '', '', '2024-11-14 17:30:45', 'lazeske-oplatky-2040'),
(165, 'b0zfhyge90ceb', 'Matez', 5, 'uploads/V4F4hl7cN87E3rW3rGfxnBKo1hDimaI3Nnmj4Yue10mPiWL5QkGPkWUESckp_mates.jpg', '', '', '', '2024-11-14 17:29:33', 'matez'),
(166, 'b0zfhyge90ceb', 'Chléb', 6, 'uploads/ojAGZVHSITndy2r2NklxAzikN06YGfooUT6PfH5duTsTva2EIzMZr9UvBMb9_chleba.jpg', '', '', '', '2024-11-27 13:08:28', 'chleb'),
(167, 'b0zfhyge90ceb', 'Pralinky', 7, 'uploads/uKRHRNMLoA3ti5o8wS89yazJyQuBjm2O3f1XVcNtqJ0UlLBdJnqCrr3av7ZV_pralinky.jpg', '', '', '', '2024-11-14 17:36:04', 'pralinky');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(161, 88),
(161, 103),
(163, 91),
(163, 98),
(163, 106),
(164, 91),
(164, 97),
(164, 98),
(164, 102),
(165, 87),
(165, 103),
(166, 91),
(166, 98),
(166, 106),
(167, 97),
(167, 98);

-- --------------------------------------------------------

--
-- Table structure for table `product_prodej`
--

DROP TABLE IF EXISTS `product_prodej`;
CREATE TABLE `product_prodej` (
  `id` int(11) NOT NULL,
  `cenaProdej` int(11) NOT NULL,
  `dph_prodej` int(11) NOT NULL,
  `sklad_id_sklad` int(11) NOT NULL,
  `pocet_prodejnych_kusu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `product_prodej`
--

INSERT INTO `product_prodej` (`id`, `cenaProdej`, `dph_prodej`, `sklad_id_sklad`, `pocet_prodejnych_kusu`) VALUES
(5, 568, 2245, 8, 0),
(6, 123, 22, 13, 0),
(7, 15000, 22, 14, 0),
(10, 3, 22, 15, 0),
(11, 789, 22, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sauna_text`
--

DROP TABLE IF EXISTS `sauna_text`;
CREATE TABLE `sauna_text` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `shelf` text NOT NULL,
  `shelf_order` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `place` varchar(30) NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sauna_text`
--

INSERT INTO `sauna_text` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`, `place`, `disabled`) VALUES
(91, 2, 'Kynskeho 122, Slany', 0, '_blank', '<i class=\"bi bi-geo-alt-fill pe-2\"></i>', 'https://mapy.cz/s/lelonubete', 'up_left_header', 1),
(92, 1, 'Kynskeho 122, Slany', 0, '_blank', '<i class=\"bi bi-geo-alt-fill pe-2\"></i>', 'https://mapy.cz/s/lelonubete', 'up_left_header', 1),
(93, 1, '+420 776 740 434', 0, '', '<i class=\"bi bi-telephone-fill pe-2\"></i>', 'tel:+420 776 740 434', 'up_left_header', 1),
(94, 2, '+420 776 740 434', 0, '', '<i class=\"bi bi-telephone-fill pe-2\"></i>', 'tel:+420 776 740 434', 'up_left_header', 1),
(95, 1, 'Sauna Klub Slaný', 0, 'anchor', 'fs-1 text-light', 'home', 'header_logo', 1),
(96, 2, 'Sauna Klub Slaný', 0, 'anchor', 'fs-1 text-light', 'home', 'header_logo', 1),
(97, 1, 'Home', 1, 'anchor', '', 'home', 'sauna_main_menu', 1),
(98, 1, 'Služby', 1, 'anchor', '', 'sluzby', 'sauna_main_menu', 1),
(99, 1, 'Obsazenost', 1, 'anchor', '', 'obsazenost', 'sauna_main_menu', 1),
(100, 1, 'Kudyknam', 1, 'anchor', '', 'kudyknam', 'sauna_main_menu', 1),
(101, 1, 'Galerie', 1, 'anchor', '', 'galerie', 'sauna_main_menu', 1),
(102, 1, 'Shop', 1, 'anchor', '', 'homeshop', 'sauna_main_menu', 1),
(103, 1, 'Pravidelná Sauna', 1, 'anchor', '', 'sluzby?pravidelnaSauna', 'home_body_shortcut', 1),
(104, 1, 'Privátní Sauna', 1, 'anchor', '', 'sluzby?privatniSauna', 'home_body_shortcut', 1),
(105, 1, 'Saunování Dětí', 1, 'anchor', '', 'sluzby?saunovaniDeti', 'home_body_shortcut', 1),
(106, 1, 'Masáže', 1, 'anchor', '', 'sluzby?masaze', 'home_body_shortcut', 1),
(107, 1, '2021 Sauna Klub Slaný', 0, 'anchor', 'mb-md-0 text-body-secondary', 'home', 'logo_footer', 1),
(108, 1, 'Saunaslany@seznam.cz', 1, '', '<i class=\"bi bi-envelope p-2\"></i>', 'mailto:saunaslany@seznam.cz', 'socials_footer', 1),
(109, 1, '+420 776 740 434', 0, '', '<i class=\"bi bi-telephone-fill pe-2\"></i>', 'tel:+420 776 740 434', 'socials_footer', 1),
(110, 1, 'Kynskeho 122, Slany', 1, '_blank', '<i class=\"bi bi-geo-alt-fill p-2\"></i>', 'https://mapy.cz/s/lelonubete', 'socials_footer', 1),
(111, 1, 'Facebook', 1, '_blank', '<i class=\"bi bi-facebook\"></i>', 'https://www.facebook.com/profile.php?id=100083707954063', 'socials_footer_icon', 1),
(112, 1, 'Instagram', 1, '_blank', '<i class=\"bi bi-instagram\"></i>', 'https://instagram.com/saunaklubslany?igshid=NTc4MTIwNjQ2YQ==', 'socials_footer_icon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(30) DEFAULT NULL,
  `setting_value` varchar(2048) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting`, `setting_value`, `type`) VALUES
(1, 'email', 'zazworka@seznam.cz', ''),
(2, 'facebook_link', 'https://', ''),
(3, 'twiter_link', 'https://www.twiter.com', ''),
(6, 'linkedin_link', 'https://www.linkedin.com', ''),
(7, 'google_plus_link', 'https://www.google.com', ''),
(37, 'phone', '725574353', ''),
(38, 'company_name', 'E-Shopper Inc.', NULL),
(39, 'company_address', 'Hořešovice 58', NULL),
(40, 'company_state', 'Česká Republika', NULL),
(41, 'company_phone', '+42072557435', NULL),
(42, 'bank_account', '0000001265098001', NULL),
(43, 'bank_code', '5500', NULL),
(54, 'company_ico', '123456789', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_menu`
--

DROP TABLE IF EXISTS `shop_menu`;
CREATE TABLE `shop_menu` (
  `id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `shelf` varchar(15) NOT NULL,
  `shelf_order` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_menu`
--

INSERT INTO `shop_menu` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`) VALUES
(3, 1, 'Account', 4, 'user_login', 'fa fa-user', 'profile'),
(4, 1, 'Wishlist', 3, '0', 'fa fa-star', 'checkout'),
(5, 1, 'Checkout', 2, '0', 'fa fa-crosshairs', 'checkout'),
(6, 1, 'Cart', 1, '0', 'fa fa-shopping-cart', 'cart'),
(7, 1, 'Logout', 5, 'user_login', 'fa fa-lock', 'logout'),
(13, 1, 'Login', 5, 'user_logout', 'fa fa-lock', 'login'),
(16, 2, 'Přihlásit', 5, 'user_logout', 'fa fa-lock', 'login'),
(17, 2, 'Odhlásit', 5, 'user_login', 'fa fa-lock', 'logout'),
(18, 2, 'Košík', 1, '0', 'fa fa-shopping-cart', 'cart'),
(19, 2, 'Checkout', 2, '0', 'fa fa-crosshairs', 'checkout'),
(20, 2, 'Přání', 3, '0', 'fa fa-star', 'checkout'),
(24, 2, 'Účet', 4, 'user_login', 'fa fa-user', 'profile');

-- --------------------------------------------------------

--
-- Table structure for table `sklad`
--

DROP TABLE IF EXISTS `sklad`;
CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `cenaNakup` int(11) NOT NULL,
  `dph_sklad` int(11) NOT NULL,
  `skladem` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `sklad`
--

INSERT INTO `sklad` (`id`, `cenaNakup`, `dph_sklad`, `skladem`, `product_id`) VALUES
(8, 0, 22, 0, 165),
(13, 0, 22, 0, 166),
(14, 50000, 22, 12, 161),
(15, 2, 22, 1000, 163),
(16, 1230, 22, 456, 167);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `header` varchar(20) NOT NULL,
  `header1` varchar(30) DEFAULT NULL,
  `text` varchar(200) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `image1` varchar(500) DEFAULT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `header`, `header1`, `text`, `link`, `image`, `image1`, `disabled`) VALUES
(29, 'Banány', 'Kupujte Kupujte', 'Žluťoučké Banány Přímo Z Afriky', 'Wwwwwwwwwww', 'uploads/z9vPJGVxEuT1OhH2h5me0ux3DGpwBAIEB7Fdi4qSHRNE8qQx4ejrktpJGp95_banany.jpg', 'uploads/FShMic2gH5DbexOqo87TCn9NGuHUMljWqEj17xCXQAN5KiTBZ8GuBwMYJG8u_banany.jpg', 0),
(30, 'Vodka', 'Dovoz Z Ruska', 'Nejlépe Chutná Vychlazená', 'Wwwwwwwwwww', 'uploads/30IUCzsp4AeRWZEoQVsfNTds2tVagAoQOQolaoI6Po0rOQwlhPIgefSbPFNI_vodka.jpg', 'uploads/T2or4zIhydLQh4C676IQd9YhvJnhxphj5WZad5M5bmdIZWLNx3Y7GtNCVrPO_banany.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `style` varchar(20) NOT NULL,
  `flag` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `style`, `flag`) VALUES
(1, 'UK', '<span class=\"fi fi-gb fis\"></span>'),
(2, 'CR', '<span class=\"fi fi-cz fis\"></span>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date` datetime NOT NULL,
  `rank` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_url`, `name`, `last_name`, `email`, `password`, `date`, `rank`) VALUES
(48, '7xv8b2va9hc', 'Jiři', 'Zázvorka', 'zazworka@seznam.cz', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2024-12-01 09:57:00', 'admin'),
(58, '9katb', 'Retez', 'Řetězovič', 'retez600@gmail.com', 'd5f12e53a182c062b6bf30c1445153faff12269a', '2024-12-01 15:42:50', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vzkazy`
--

DROP TABLE IF EXISTS `vzkazy`;
CREATE TABLE `vzkazy` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `title1` varchar(60) NOT NULL,
  `post` text NOT NULL,
  `post1` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `image1` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `vzkazy_order` int(11) NOT NULL DEFAULT 0,
  `disabled` tinyint(4) NOT NULL DEFAULT 1,
  `slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `vzkazy`
--

INSERT INTO `vzkazy` (`id`, `user_url`, `title`, `title1`, `post`, `post1`, `image`, `image1`, `date`, `vzkazy_order`, `disabled`, `slug`) VALUES
(37, '7xv8b2va9hc', 'Dárkové Poukazy', 'Dárkové Poukazy', '', '<p>10x Vstup Do Finské Sauny 2000 Kč</p>\n						<p>1x Privátní Sauna Pro Dvě Osoby 60min + (20min Převlečení) 1000Kč</p>\n						<p>1x Privátní Sauna 90min + (20min Převlečení)  1250Kč</p>\n						<p>1x Privátní Sauna 120min + (20min Převlečení)  1500Kč</p>\n						<p>Přírodní Hnědá Obálka Zdarma</p>', 'uploads/vzkazy_sauna/5h5SCs70TpqbmnPt6lRvBaC6LsE0Q2Owg8dJC2fmgwFtYwyU297gf4Ziq6eb_vzkazy_sauna_poukazy.jpg', '', '2024-12-04 23:05:50', 0, 1, 'darkove-poukazy'),
(40, '7xv8b2va9hc', 'OTEVÍRACÍ DOBA', '', '<table>\n						<tbody>\n							<tr>\n								<th colspan=\"3\">\n									<p><span style=\"color: #ba372a; font-size: 18pt;\">Pravidelné saunování od <span\n												style=\"color: #e03e2d;\">září</span> do <span\n												style=\"color: #e03e2d;\">května</span></span></p>\n								</th>\n							</tr>\n							<tr>\n								<td>PO</td>\n								<td>\n									<p>SPOLEČNÁ</p>\n								</td>\n								<td>\n									<p>16:00 – 21:00</p>\n								</td>\n							</tr>\n							<tr>\n								<td>ÚT</td>\n								<td>DĚTSKÁ SAUNA</td>\n								<td>15:00 – 16:30</td>\n							</tr>\n							<tr>\n								<td></td>\n								<td>DÁMSKÁ SAUNA</td>\n								<td>17:00 – 21:00</td>\n							</tr>\n							<tr>\n								<td>ST</td>\n								<td>\n									<p>----</p>\n								</td>\n								<td>\n									<p>----</p>\n								</td>\n							</tr>\n							<tr>\n								<td>ČT</td>\n								<td>\n									<p>SPOLEČNÁ</p>\n								</td>\n								<td>\n									<p>16:00 – 21:00</p>\n								</td>\n							</tr>\n							<tr>\n								<td>PÁ</td>\n								<td>\n									<p>----</p>\n								</td>\n								<td>\n									<p>----</p>\n								</td>\n							</tr>\n							<tr>\n								<td>SO</td>\n								<td>\n									<p>----</p>\n								</td>\n								<td>\n									<p>----</p>\n								</td>\n							</tr>\n							<tr>\n								<td>NE</td>\n								<td>\n									<p>----</p>\n								</td>\n								<td>\n									<p>----</p>\n								</td>\n							</tr>\n						</tbody>\n					</table>', '', NULL, '', '2024-12-05 10:49:29', 3, 1, 'oteviraci-doba'),
(41, '7xv8b2va9hc', '', '', '', '', 'uploads/vzkazy_sauna/zHu0ALka2oMlB5BxMTJPHr8xuBRgEwdErpmyYLajdUrWKsheRkFLuonO2A1w_vzkazy_sauna_oteviracka_vanoce.jpg', '', '2024-12-05 14:49:49', 2, 1, '-2774');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_url` (`user_url`),
  ADD KEY `title` (`title`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`brand`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `views` (`views`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `parent` (`parent`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `footer_menu`
--
ALTER TABLE `footer_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `subject` (`subject`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_url`),
  ADD KEY `date` (`date`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slag` (`slag`),
  ADD KEY `date` (`date`),
  ADD KEY `description` (`description`),
  ADD KEY `user_url` (`user_url`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`) USING BTREE;

--
-- Indexes for table `product_prodej`
--
ALTER TABLE `product_prodej`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sauna_text`
--
ALTER TABLE `sauna_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seting` (`setting`);

--
-- Indexes for table `shop_menu`
--
ALTER TABLE `shop_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexes for table `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_address` (`user_url`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `rank` (`rank`);

--
-- Indexes for table `vzkazy`
--
ALTER TABLE `vzkazy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_url` (`user_url`),
  ADD KEY `title` (`title`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `footer_menu`
--
ALTER TABLE `footer_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `product_prodej`
--
ALTER TABLE `product_prodej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sauna_text`
--
ALTER TABLE `sauna_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `shop_menu`
--
ALTER TABLE `shop_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vzkazy`
--
ALTER TABLE `vzkazy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shop_menu`
--
ALTER TABLE `shop_menu`
  ADD CONSTRAINT `shop_menu_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_menu_ibfk_2` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
