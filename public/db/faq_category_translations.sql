-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 08:31 PM
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
-- Database: `apptv_20240102`
--

--
-- Dumping data for table `faq_category_translations`
--

INSERT INTO `faq_category_translations` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'en', 'da-web-player', 'DA WEB PLAYER', NULL, 'DA WEB PLAYER', 'DA WEB PLAYER'),
(2, 2, 'en', 'installation', 'Installation', NULL, 'Installation', 'Installation'),
(3, 3, 'en', 'category-3', 'Category 3', NULL, 'Category 3', 'Category 3'),
(4, 4, 'en', 'category-4', 'Category 4', NULL, 'Category 4', 'Category 4'),
(5, 5, 'en', 'category-5', 'Category 5', NULL, 'Category 5', 'Category 5'),
(6, 6, 'en', 'category-6', 'Category 6', NULL, 'Category 6', 'Category 6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
