-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 04:51 PM
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
-- Database: `a_realestate_test2024`
--

--
-- Dumping data for table `meta_tag_translations`
--

INSERT INTO `meta_tag_translations` (`id`, `meta_tag_id`, `locale`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'موقع عقارات مصر | وجهتك العقارية الأولى في مصر', 'موقع عقارات مصر الموقع العقاري الأول للكمبوندات والمنتجعات والمشاريع العقارية في مصر'),
(2, 1, 'en', 'Real Estate Egypt | Egypt\'s #1 Real Estate Destination', 'Real Estate Egypt is the biggest real estate website in Egypt for compounds, resorts and commercial projects'),
(3, 2, 'ar', 'المطورين العقاريين | موقع عقارات مصر', 'المطورين العقاريين  موقع عقارات مصر'),
(4, 2, 'en', 'Developers | Real Estate Egypt', 'Developers Real Estate Egypt'),
(5, 3, 'ar', 'المدونة | موقع عقارات مصر', 'موقع عقارات مصر الموقع العقاري الأول للكمبوندات والمنتجعات والمشاريع العقارية في مصر'),
(6, 3, 'en', 'Blog | Real Estate Egypt', 'Blog Real Estate Egypt'),
(7, 4, 'ar', 'اتصل بنا | موقع عقارات مصر | وجهتك العقارية الأولى في مصر', 'اتصل بنا موقع عقارات مصر الموقع العقاري الأول للكمبوندات والمنتجعات والمشاريع العقارية في مصر'),
(8, 4, 'en', 'Contact Us | Real Estate Egypt | Egypt\'s #1 Real Estate Destination', 'Contact Us Real Estate Egypt is the biggest real estate website in Egypt for compounds, resorts and commercial projects'),
(9, 5, 'ar', 'كمبوندات مصر', 'كمبوندات مصر'),
(10, 5, 'en', 'Compounds', 'Compounds'),
(11, 6, 'ar', 'وحدات للبيع', 'وحدات للبيع'),
(12, 6, 'en', 'For Sale', 'For Sale'),
(13, 7, 'ar', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.'),
(14, 7, 'en', 'Oops !! Page Not Found', 'Oops !! Page Not Found'),
(15, 8, 'ar', 'المشاريع والوحدات المفضلة', 'المشاريع والوحدات المفضلة'),
(16, 8, 'en', 'Favorite List', 'Favorite List');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
