-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 10:03 PM
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
-- Database: `a_realestate_2024`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `photo`, `photo_thum_1`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'east-cairo-compounds', NULL, NULL, 1, NULL, '2018-12-28 05:57:25', '2018-12-28 05:57:25'),
(2, 'ain-sokhna', NULL, NULL, 1, NULL, '2019-02-18 22:11:27', '2019-02-18 22:12:26'),
(3, 'fifth-settlement', NULL, NULL, 1, NULL, '2019-02-18 22:12:07', '2019-02-18 22:12:19'),
(4, '6th-of-october-compounds', NULL, NULL, 1, NULL, '2019-02-19 14:11:15', '2019-02-19 14:11:15'),
(5, 'new-capital-compounds', NULL, NULL, 1, NULL, '2019-02-25 22:17:43', '2019-07-25 10:50:16'),
(6, 'al-shorouk-compounds', NULL, NULL, 1, NULL, '2019-02-25 23:26:57', '2019-02-25 23:26:57'),
(7, 'nasr-city-compounds', NULL, NULL, 1, NULL, '2019-03-03 12:25:49', '2019-03-03 12:25:49'),
(8, 'sheikh-zayed-compounds', NULL, NULL, 1, NULL, '2019-03-04 13:33:30', '2019-03-04 13:33:30'),
(9, 'new-cairo-compounds', NULL, NULL, 1, NULL, '2019-03-28 16:51:45', '2019-07-04 15:03:33'),
(10, 'el-maadi-compounds', NULL, NULL, 1, NULL, '2019-03-28 18:52:52', '2019-03-28 18:52:52'),
(11, 'alexandria-desert-rd-resorts', NULL, NULL, 1, NULL, '2019-03-28 20:56:56', '2019-03-28 20:56:56'),
(12, 'el-katameya-compounds', NULL, NULL, 1, NULL, '2019-03-31 21:13:19', '2019-03-31 21:13:19'),
(13, 'el-mostakbal-city-compounds', NULL, NULL, 1, NULL, '2019-03-31 23:04:05', '2019-03-31 23:04:05'),
(14, 'north-coast-resorts', NULL, NULL, 1, NULL, '2019-07-16 08:02:13', '2019-07-16 08:02:13'),
(15, 'developers', NULL, NULL, 1, NULL, '2019-07-16 12:08:55', '2019-07-16 12:19:50'),
(16, 'real-estate-tips', NULL, NULL, 1, NULL, '2019-09-23 23:10:06', '2020-01-11 13:45:57'),
(17, 'port-said-resorts', NULL, NULL, 1, NULL, '2019-12-04 08:06:20', '2019-12-04 08:06:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
