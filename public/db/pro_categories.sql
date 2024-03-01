-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 03:30 PM
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
-- Dumping data for table `pro_categories`
--

INSERT INTO `pro_categories` (`id`, `parent_id`, `deep`, `photo`, `photo_thum_1`, `icon`, `is_active`, `postion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-03-01 12:20:36', '2024-03-01 12:20:36', NULL),
(2, 1, 1, NULL, NULL, NULL, 1, 0, '2024-03-01 12:20:55', '2024-03-01 12:20:55', NULL),
(3, 2, 2, NULL, NULL, NULL, 1, 0, '2024-03-01 12:21:07', '2024-03-01 12:21:07', NULL),
(4, 3, 3, NULL, NULL, NULL, 1, 0, '2024-03-01 12:23:59', '2024-03-01 12:23:59', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
