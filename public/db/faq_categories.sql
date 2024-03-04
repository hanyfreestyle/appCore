-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 06:58 PM
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
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `photo`, `photo_thum_1`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'images/faq-cat/1/da-web-player-xVF2Iaqit2.webp', 'images/faq-cat/1/da-web-player-mUioixtn2Y.webp', 1, '2024-01-04 08:20:16', '2024-01-04 14:52:03'),
(2, 'images/faq-cat/2/installation-IgI1hT6mvP.webp', 'images/faq-cat/2/installation-oaa6X7wyoW.webp', 1, '2024-01-04 08:21:49', '2024-01-04 14:50:39'),
(3, NULL, NULL, 1, '2024-01-04 08:22:07', '2024-01-04 08:22:07'),
(4, NULL, NULL, 1, '2024-01-04 08:22:16', '2024-01-04 08:22:16'),
(5, NULL, NULL, 1, '2024-01-04 08:22:27', '2024-01-04 08:22:27'),
(6, NULL, NULL, 1, '2024-01-04 08:22:38', '2024-01-04 08:22:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
