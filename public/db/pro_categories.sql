-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 07:02 AM
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

INSERT INTO `pro_categories` (`id`, `parent_id`, `deep`, `photo`, `photo_thum_1`, `icon`, `is_active`, `postion`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'images/category/1/1696769012_38xGZfq7uTYwlig_.webp', 'images/category/1/1696769013_qlxHOchJt6k2vY8_.webp', NULL, 1, 0, '2023-10-08 07:39:59', '2023-10-08 11:43:33'),
(2, NULL, 0, 'images/category/2/1696769046_t4wxe39vomlh0DE_.webp', 'images/category/2/1696769046_ppwi3Y19ZvzkaCM_.webp', NULL, 1, 0, '2023-10-08 07:40:10', '2023-10-08 11:44:06'),
(3, NULL, 0, 'images/category/3/1696769062_CG3Swekd9EA8JE1_.webp', 'images/category/3/1696769062_ATf46UjA6Jtm5fE_.webp', NULL, 1, 0, '2023-10-08 07:40:30', '2023-10-08 11:44:22'),
(4, NULL, 0, 'images/category/4/1696769080_I2PTFsLPbyZMNuJ_.webp', 'images/category/4/1696769080_CablI9eIEAjbDQR_.webp', NULL, 1, 0, '2023-10-08 07:40:42', '2023-10-08 11:44:40'),
(5, NULL, 0, 'images/category/5/1696769103_44TWzD4W0MtWICH_.webp', 'images/category/5/1696769103_08oOhMiMwumIzyJ_.webp', NULL, 1, 0, '2023-10-08 07:40:49', '2023-10-08 11:45:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
