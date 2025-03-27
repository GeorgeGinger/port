-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 07. úno 2025, 18:44
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `nebudsam`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `blogs`
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
-- Vypisuji data pro tabulku `blogs`
--

INSERT INTO `blogs` (`id`, `user_url`, `title`, `post`, `image`, `date`, `slug`) VALUES
(28, 'q3foa13r89yza81m4dm5inzl07vzc8e0znbrozv69xo45ewv', 'Sdadsd', 'Dsadddddddddddddddddd', NULL, '0000-00-00 00:00:00', 'sdadsd-9834');

-- --------------------------------------------------------

--
-- Struktura tabulky `main_menu`
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
-- Vypisuji data pro tabulku `main_menu`
--

INSERT INTO `main_menu` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`) VALUES
(22, 1, 'Home', 1, '', '', 'home'),
(24, 1, 'Blog', 4, '', '', 'blog'),
(25, 1, 'Contact', 5, '', '', 'contact'),
(26, 2, 'Domů', 1, '', '', 'home'),
(27, 2, 'Kontakt', 5, '', '', 'contact'),
(28, 2, 'Blog', 4, '', '', 'blog'),
(30, 1, 'Rules', 3, '', '', 'rules'),
(32, 2, 'Pravidla', 3, '', '', 'rules'),
(34, 1, 'Game', 2, '', '', 'game'),
(35, 2, 'Hra', 2, '', '', 'game');

-- --------------------------------------------------------

--
-- Struktura tabulky `messages`
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
-- Struktura tabulky `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `login_date` datetime NOT NULL,
  `death_date` datetime DEFAULT NULL,
  `user_url` varchar(60) NOT NULL,
  `player_url` varchar(60) NOT NULL,
  `player_order` int(11) DEFAULT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 1,
  `rank` varchar(10) NOT NULL DEFAULT 'player'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `players`
--

INSERT INTO `players` (`id`, `name`, `password`, `login_date`, `death_date`, `user_url`, `player_url`, `player_order`, `disabled`, `rank`) VALUES
(107, 'jiri', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 18:22:56', NULL, '0hz10cy3c05vf3b0tdgvv6omy8rw27lxyo97jr5fonkqjgsp', 'gp9tc0icnoygyt02g5', 0, 1, 'admin'),
(108, 'ferda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 18:22:56', NULL, '0hz10cy3c05vf3b0tdgvv6omy8rw27lxyo97jr5fonkqjgsp', 'hs94e35284ejkljwy6letzw', 1, 1, 'player'),
(109, 'ferda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 18:21:10', '2025-02-07 18:21:40', 'bzarwy8dsq16', '5l0ung93drx3ka1libz3wuido81yv6sbdw93xbcq', 1, 0, 'admin'),
(110, 'tonda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 18:21:09', '2025-02-07 18:21:39', 'bzarwy8dsq16', 'djplcamsar87v83lnno4y', 1, 0, 'player'),
(111, 'ruza', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 18:21:09', '2025-02-07 18:21:39', 'bzarwy8dsq16', 'xwk8mml18n8tlodnfinf2792i5uznw3n7lg4hre0la3dx92k64y2m', 2, 0, 'player');

-- --------------------------------------------------------

--
-- Struktura tabulky `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `score` text NOT NULL,
  `player_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `score`
--

INSERT INTO `score` (`id`, `score`, `player_id`) VALUES
(28, '3', 109);

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(30) DEFAULT NULL,
  `setting_value` varchar(2048) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `settings`
--

INSERT INTO `settings` (`id`, `setting`, `setting_value`, `type`) VALUES
(1, 'email', '', ''),
(2, 'facebook_link', 'https://www.facebook.com', ''),
(37, 'phone', '', ''),
(38, 'company_name', 'Nebuď sám', NULL),
(39, 'company_address', '', NULL),
(40, 'company_state', 'Česká Republika', NULL),
(41, 'company_phone', '', NULL),
(42, 'bank_account', '0000001265098001', NULL),
(43, 'bank_code', '5500', NULL),
(54, 'company_ico', '123456789', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `shop_menu`
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
-- Vypisuji data pro tabulku `shop_menu`
--

INSERT INTO `shop_menu` (`id`, `style_id`, `shelf`, `shelf_order`, `type`, `class`, `url`) VALUES
(7, 1, 'Logout', 5, 'user_login', 'fa fa-lock', 'logout'),
(13, 1, 'Login', 5, 'user_logout', 'fa fa-lock', 'login'),
(16, 2, 'Přihlásit', 5, 'user_logout', 'fa fa-lock', 'login'),
(17, 2, 'Odhlásit', 5, 'user_login', 'fa fa-lock', 'logout'),
(25, 2, 'Admin_player', 4, 'admin_player', 'fa fa-user', 'admin_player'),
(26, 1, 'Admin Player', 4, 'admin_player', 'fa fa-user', 'admin_player'),
(27, 1, 'Login_player', 5, 'player_logout', 'fa fa-lock', 'login_player'),
(28, 1, 'Logout_player', 5, 'player_login', 'fa fa-lock', 'logout_player'),
(29, 2, 'Odhlásit_hráč', 5, 'player_login', 'fa fa-lock', 'logout_player'),
(30, 2, 'Přihlásit_hráč', 5, 'player_logout', 'fa fa-lock', 'login_player'),
(31, 1, 'Admin Game', 4, 'admin_game', 'fa fa-user', 'admin'),
(32, 2, 'Admin Game', 4, 'admin_game', 'fa fa-user', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `styles`
--

DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `style` varchar(20) NOT NULL,
  `flag` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `styles`
--

INSERT INTO `styles` (`id`, `style`, `flag`) VALUES
(1, 'UK', '<span class=\"fi fi-gb fis\"></span>'),
(2, 'CR', '<span class=\"fi fi-cz fis\"></span>');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
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
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `user_url`, `name`, `last_name`, `email`, `password`, `date`, `rank`) VALUES
(71, '0hz10cy3c05vf3b0tdgvv6omy8rw27lxyo97jr5fonkqjgsp', 'hory', 'unnown', 'neco@neco.cz', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-06 16:04:37', 'customer'),
(72, 'bzarwy8dsq16', 'doma', 'unnown', 'neco@neco.cz', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2025-02-07 16:29:30', 'customer');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_url` (`user_url`),
  ADD KEY `title` (`title`),
  ADD KEY `date` (`date`);

--
-- Indexy pro tabulku `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexy pro tabulku `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `subject` (`subject`),
  ADD KEY `name` (`name`);

--
-- Indexy pro tabulku `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_url` (`user_url`);

--
-- Indexy pro tabulku `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seting` (`setting`);

--
-- Indexy pro tabulku `shop_menu`
--
ALTER TABLE `shop_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Indexy pro tabulku `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `rank` (`rank`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pro tabulku `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pro tabulku `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pro tabulku `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pro tabulku `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pro tabulku `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pro tabulku `shop_menu`
--
ALTER TABLE `shop_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pro tabulku `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `shop_menu`
--
ALTER TABLE `shop_menu`
  ADD CONSTRAINT `shop_menu_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_menu_ibfk_2` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
