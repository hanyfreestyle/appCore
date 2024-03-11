-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 10:56 PM
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
-- Dumping data for table `pro_attribute_option_translations`
--

INSERT INTO `pro_attribute_option_translations` (`id`, `option_id`, `locale`, `slug`, `name`, `count`) VALUES
(1, 1, 'ar', '90-سم', '90 سم', NULL),
(2, 1, 'en', '90-سم', '90 سم', NULL),
(3, 2, 'ar', '100-سم', '100 سم', NULL),
(4, 2, 'en', '100-سم', '100 سم', NULL),
(5, 3, 'ar', '110-سم', '110 سم', NULL),
(6, 3, 'en', '110-سم', '110 سم', NULL),
(7, 4, 'ar', '120-سم', '120 سم', NULL),
(8, 4, 'en', '120-سم', '120 سم', NULL),
(9, 5, 'ar', '130-سم', '130 سم', NULL),
(10, 5, 'en', '130-سم', '130 سم', NULL),
(11, 6, 'ar', '15-سم', '15 سم', NULL),
(12, 6, 'en', '15-سم', '15 سم', NULL),
(13, 7, 'ar', '17-سم', '17 سم', NULL),
(14, 7, 'en', '17-سم', '17 سم', NULL),
(15, 8, 'ar', '18-سم', '18 سم', NULL),
(16, 8, 'en', '18-سم', '18 سم', NULL),
(17, 9, 'ar', 'بيلوتوب', 'بيلوتوب', NULL),
(18, 9, 'en', 'بيلوتوب', 'بيلوتوب', NULL),
(19, 10, 'ar', 'قطن', 'قطن', NULL),
(20, 10, 'en', 'قطن', 'قطن', NULL),
(21, 11, 'ar', 'لاتكس', 'لاتكس', NULL),
(22, 11, 'en', 'لاتكس', 'لاتكس', NULL),
(23, 12, 'ar', 'ميموري-فوم', 'ميموري فوم', NULL),
(24, 12, 'en', 'ميموري-فوم', 'ميموري فوم', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
