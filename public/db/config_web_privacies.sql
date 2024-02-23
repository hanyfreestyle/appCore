-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 07:11 PM
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
-- Database: `a_etman`
--

--
-- Dumping data for table `config_web_privacies`
--

INSERT INTO `config_web_privacies` (`id`, `name`, `postion`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'شروط وسياسة الخصوصية', 2, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(3, 'جمع المعلومات واستخدامها', 3, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(4, 'أنواع البيانات المجمعة', 4, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(5, 'بيانات الاستخدام', 5, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(6, 'تتبع و ملفات تعريف الارتباط', 6, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(7, 'استخدام البيانات', 7, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(8, 'نقل البيانات', 8, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(9, 'الكشف عن البيانات', 9, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(10, 'أمن البيانات', 10, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(11, 'مقدمي الخدمة', 11, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(12, 'تحليلات', 12, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(13, 'روابط لمواقع أخرى', 13, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(14, 'خصوصية الأطفال', 14, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(15, 'تغييرات سياسة الخصوصية', 15, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57'),
(16, 'اتصل بنا', 16, 1, '2023-08-24 12:42:57', '2023-08-24 12:42:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
