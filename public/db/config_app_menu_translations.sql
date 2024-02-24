-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 01:14 PM
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
-- Database: `onfire_new`
--

--
-- Dumping data for table `app_menu_translations`
--

INSERT INTO `config_app_menu_translations` (`id`, `menu_id`, `locale`, `url`, `label`, `icon`, `title`) VALUES
(1, 2, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/CartView/?mobile=1', 'السلة', 60562, 1),
(2, 1, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/profile/?mobile=1', 'الملف الشخصي', 58519, 1),
(3, 3, 'ar', 'https://freestyle4u.net/et8/public/%D8%A7%D8%AA%D8%B5%D9%84-%D8%A8%D9%86%D8%A7/?mobile=1', 'اتصل بنا', 57738, 1),
(4, 4, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/%D8%B9%D8%B1%D9%88%D8%B6-%D8%AA%D8%AC%D8%A7%D8%B1-%D8%A7%D9%84%D8%AC%D9%85%D9%84%D8%A9/?mobile=1', 'عروض الجمله', 61828, 1),
(5, 5, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop//?mobile=1', 'الرئيسية', 58519, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
