-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 15. úno 2024, 14:35
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `db-saunaklub`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `stranka`
--

DROP TABLE IF EXISTS `stranka`;
CREATE TABLE `stranka` (
  `id` varchar(255) NOT NULL,
  `titulek` text DEFAULT NULL,
  `menu` text DEFAULT NULL,
  `obsah` text DEFAULT NULL,
  `poradi` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `stranka`
--

INSERT INTO `stranka` (`id`, `titulek`, `menu`, `obsah`, `poradi`) VALUES
('404', 'Stránka neexistuje', '', '<div class=\"stranka-neexistuje\">\r\n<h1>Stránka neexistuje</h1>\r\n<div class=\"obrazek\"><img src=\"img/error.png\" alt=\"Stránka neexistuje\" /></div>\r\n</div>', 5),
('domu', 'Sauna Klub Slaný - Domů', 'Domů', '<div class=\"ramecek\">\r\n<div class=\"zprava\">\r\n<div class=\"nadpis\">\r\n<h2>Saunovací sezóna začala, přijďte se ohřát!</h2>\r\n</div>\r\n<div class=\"content\"></div>\r\n</div>\r\n</div>\r\n<div class=\"ramecek\">\r\n<div class=\"zprava cenik\">\r\n<div class=\"nadpis\">\r\n<h2>CENÍK</h2>\r\n</div>\r\n<div class=\"content\">\r\n<ul>\r\n<li>\r\n<p>jednorázový vstup - 230kč</p>\r\n</li>\r\n<li>\r\n<p>klubová permice 10 vstupů – 2.000kč</p>\r\n</li>\r\n<li>\r\n<p>MULTISPORT KARTA nelze u nás využívat, momentálně nesplňujeme podminky</p>\r\n</li>\r\n<li>\r\n<p><a href=\"sluzby?privat\">PRIVÁT</a> do 5 osob</p>\r\n<ul>\r\n<li>\r\n<p>90 minut – 1.250kč - osoba navíc 100kč</p>\r\n</li>\r\n<li>\r\n<p>120 minut – 1.500kč - osoba navíc 100kč</p>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><a href=\"sluzby?masaz\">MASÁŽE</a> Pro objednání volejte na <a href=\"tel:+420 602 175 988\">tel. +420 602 175 988</a> masérka Kamila</p>\r\n<ul>\r\n<li>\r\n<p>Protahovací masáž kombinovaná s olejovou masáží zad 60 minut 950kč</p>\r\n</li>\r\n<li>\r\n<p>Relaxační masáž s vůněmi 60 minut 950kč</p>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"ramecek\">\r\n<div class=\"zprava navod\"><dic class=\"nadpis\">\r\n<h2>JAK SE U NÁS VYSAUNOVAT</h2>\r\n</dic>\r\n<div class=\"content\">\r\n<ul>\r\n<li>\r\n<p>ZAVOLEJ NEBO NAPIŠ, ŽE PŘIJDEŠ, DOSTANEŠ KÓD KE DVEŘÍM</p>\r\n</li>\r\n<li>\r\n<p>PLATBA MOŽNÁ NA ÚČET NEBO NA MÍSTĚ HOTOVĚ A QR kódem</p>\r\n</li>\r\n<li>\r\n<p>VEM SI SEBOU OBUV (na půjčení popř. jsou)</p>\r\n</li>\r\n<li>\r\n<p>CENA 230kč za vstup NEBO permice 2000kč (10 vstupů - napiš si o ní)</p>\r\n</li>\r\n<li>\r\n<p>V CENĚ MÁŠ - RUČNÍK, PROSTĚRADLO, VODU, PÉČI O TĚLO (sprchové gely, tělová mléka), FÉN</p>\r\n</li>\r\n<li>\r\n<p>K VYUŽITÍ LEDNIČKA (alko a nealko), CENY UVEDENÉ A VEDLE PLECHÁČEK</p>\r\n</li>\r\n<li>\r\n<p>NAJDEŠ U NÁS JEDNU FINSKOU SAUNU, STUDENOU SPRCHU, <br />OCHLAZOVACÍ BAZÉNEK A VNITŘNÍ a VENKOVNÍ ODPOČÍVARNU</p>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"ramecek\">\r\n<div class=\"zprava oteviraci_doba\">\r\n<div class=\"nadpis\">\r\n<h2>OTEVÍRACÍ DOBA</h2>\r\n</div>\r\n<div class=\"content\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>PO</td>\r\n<td>\r\n<p>SPOLEČNÁ</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>16:00 – 21:00</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>ÚT</td>\r\n<td>DĚTSKÁ SAUNA</td>\r\n<td>16:00 – 17:00</td>\r\n<td></td>\r\n</tr>\r\n<tr>\r\n<td></td>\r\n<td>DÁMSKÁ SAUNA</td>\r\n<td></td>\r\n<td>17:00 – 21:00</td>\r\n</tr>\r\n<tr>\r\n<td>ST</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>ČT</td>\r\n<td>\r\n<p>SPOLEČNÁ</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>16:00 – 21:00</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>PÁ</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>SO</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>NE</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n<td>\r\n<p></p>\r\n</td>\r\n<td>\r\n<p>----</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Po dohodě jsou prostory sauny k dispozici 24/7</p>\r\n</div>\r\n</div>\r\n</div>', 0),
('galerie', 'Sauna Klub Slaný - Galerie', 'Galerie', '<h1>Galerie</h1>\r\n<p>[fotogalerie slozka=\"sauna-slany\"]</p>', 1),
('kudyKnam', 'Sauna Klub Slaný - poloha', 'Kudy k nám', '<div class=\"ramecek\">\r\n<div class=\"zprava\"></div>\r\n<div class=\"nadpis\">\r\n<h2>Plechového miláčka můžete zaparkovat na náměstí nebo v přilehlých ulicích po 17. hodině parkování zdarma</h2>\r\n</div>\r\n</div>\r\n<div class=\"ramecek\">\r\n<div class=\"zprava\">\r\n<div class=\"nadpis\"><iframe style=\"border: none;\" src=\"https://frame.mapy.cz/s/cosumanana\" height=\"380\" frameborder=\"0\"></iframe></div>\r\n</div>\r\n</div>', 3),
('obsazenost', 'Sauna Klub Slaný - Obsazenost', 'Obsazenost', '<div class=\"ramecek\">\r\n<div class=\"scroll\">\r\n<div class=\"obsazeni\"><iframe src=\"https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23F6BF26&amp;ctz=Europe%2FPrague&amp;showCalendars=0&amp;showTz=1&amp;showTabs=1&amp;showPrint=0&amp;showNav=1&amp;mode=WEEK&amp;src=NzIxNTQ0Yjg4ZjUyZDIzNzkwMzEwNDhmZmM4ODgxMDg0ZDNkZmY1NGViYTQ2ZTRkYzgzMmE1ZmU3NGVmMGY1MUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y3MuY3plY2gjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23D81B60&amp;color=%230B8043\" style=\"border: solid 1px #777;\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe></div>\r\n</div>\r\n</div>', 4),
('sluzby', 'Sauna Klub Slaný - Služby', 'Služby', '<div class=\"ramecek\">\r\n<div class=\"zprava privat\">\r\n<div class=\"nadpis\">\r\n<h2>Privátní sauna</h2>\r\n</div>\r\n<div class=\"content\">\r\n<p>Pokud chcete soukromí, můžete si pronajmout celý prostor sauny.</p>\r\n<p>PRIVÁT do 5 osob</p>\r\n<p>90 minut - 1.250kč - osoba navíc 100kč</p>\r\n<p>120 minut - 1.500kč - osoba navíc 100kč</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"ramecek\">\r\n<div class=\"zprava masaz\">\r\n<div class=\"nadpis\">\r\n<h2>Masáže</h2>\r\n</div>\r\n<div class=\"content\">\r\n<p>Protahovací masáž kombinovaná s olejovou masáží zad 60&amp;nbspminut&amp;nbsp950&amp;nbspkč.</p>\r\n<p>Relaxační masáž s vůněmi 60&amp;nbspminut&amp;nbsp950&amp;nbspkč.</p>\r\n<p>Pro objednání volejte na <a href=\"tel:+420 602 175 988\">tel. +420 602 175 988</a> masérka Kamila</p>\r\n<p>[fotogalerie slozka=\"masaze\"]</p>\r\n</div>\r\n</div>\r\n</div>', 2);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `stranka`
--
ALTER TABLE `stranka`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
