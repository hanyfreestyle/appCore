-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 05:06 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_cart`
--

--
-- Dumping data for table `pro_category_translations`
--

INSERT INTO `pro_category_translations` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'عتمان', 'عتمان', NULL, 'عتمان', ''),
(2, 2, 'ar', 'عتمان-جروب', 'عتمان جروب', NULL, 'عتمان جروب', ''),
(3, 3, 'ar', 'اسكوتش', 'اسكوتش', NULL, 'اسكوتش', ''),
(4, 4, 'ar', 'اسكوتش-فاتح', 'اسكوتش فاتح', NULL, 'اسكوتش فاتح', ''),
(5, 5, 'ar', 'اسكوتش-غامق', 'اسكوتش غامق', NULL, 'اسكوتش غامق', ''),
(6, 6, 'ar', 'dsfdsfdsf', 'اسكوتش برتقالى', NULL, 'dsfsdfds', ''),
(7, 7, 'ar', 'ورق-تصوير', 'ورق تصوير', NULL, 'ورق تصوير', ''),
(8, 8, 'ar', 'اكواب-ورقيه', 'اكواب ورقيه', NULL, 'اكواب ورقيه', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
