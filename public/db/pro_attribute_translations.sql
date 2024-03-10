-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 05:39 PM
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
-- Dumping data for table `pro_attribute_translations`
--

INSERT INTO `pro_attribute_translations` (`id`, `attribute_id`, `locale`, `slug`, `name`, `des`) VALUES
(1, 1, 'ar', 'المقاس', 'المقاس', NULL),
(2, 1, 'en', 'المقاس', 'المقاس', NULL),
(3, 2, 'ar', 'ارتفاع-المرتبة', 'ارتفاع المرتبة', NULL),
(4, 2, 'en', 'ارتفاع-المرتبة', 'ارتفاع المرتبة', NULL),
(5, 3, 'ar', 'الماركة', 'الماركة', NULL),
(6, 3, 'en', 'الماركة', 'الماركة', NULL),
(7, 4, 'ar', 'طبقة-مميزة', 'طبقة مميزة', NULL),
(8, 4, 'en', 'طبقة-مميزة', 'طبقة مميزة', NULL),
(9, 5, 'ar', 'طول-المرتبة', 'طول المرتبة', NULL),
(10, 5, 'en', 'طول-المرتبة', 'طول المرتبة', NULL),
(11, 6, 'ar', 'عرض-المرتبة', 'عرض المرتبة', NULL),
(12, 6, 'en', 'عرض-المرتبة', 'عرض المرتبة', NULL),
(13, 7, 'ar', 'نوع-الاسفنج', 'نوع الاسفنج', NULL),
(14, 7, 'en', 'نوع-الاسفنج', 'نوع الاسفنج', NULL),
(15, 8, 'ar', 'نوع-المرتبة', 'نوع المرتبة', NULL),
(16, 8, 'en', 'نوع-المرتبة', 'نوع المرتبة', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
