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
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `g_title`, `g_des`, `deleted_at`) VALUES
(1, 1, 'ar', 'كمبوندات شرق القاهرة', NULL, NULL, NULL),
(2, 1, 'en', 'East Cairo Compounds', NULL, NULL, NULL),
(3, 2, 'ar', 'منتجعات العين السخنة', NULL, NULL, NULL),
(4, 2, 'en', 'Ain Sokhna resorts', NULL, NULL, NULL),
(5, 3, 'ar', 'كمبوندات التجمع الخامس', NULL, NULL, NULL),
(6, 3, 'en', 'Fifth Settlement compounds', NULL, NULL, NULL),
(7, 4, 'ar', 'كمبوندات السادس من أكتوبر', NULL, NULL, NULL),
(8, 4, 'en', '6th Of October Compounds', NULL, NULL, NULL),
(9, 5, 'ar', 'كمبوندات العاصمة الإدارية الجديدة', NULL, 'كل التفاصيل عن كمبوندات العاصمة الإدارية، تعرف على مساحات واسعار وأنواع الوحدات المُتاحة في كمبوندات ومشاريع العاصمة الإدارية الجديدة.', NULL),
(10, 5, 'en', 'New capital compounds', NULL, 'All information about new capital compounds.', NULL),
(11, 6, 'ar', 'كمبوندات الشروق', NULL, NULL, NULL),
(12, 6, 'en', 'Al Shorouk compounds', NULL, NULL, NULL),
(13, 7, 'ar', 'كمبوندات مدينة نصر', NULL, NULL, NULL),
(14, 7, 'en', 'Nasr city compounds', NULL, NULL, NULL),
(15, 8, 'ar', 'كمبوندات الشيخ زايد', NULL, NULL, NULL),
(16, 8, 'en', 'Sheikh Zayed compounds', NULL, NULL, NULL),
(17, 9, 'ar', 'كمبوندات القاهرة الجديدة', NULL, NULL, NULL),
(18, 9, 'en', 'New Cairo compounds', NULL, NULL, NULL),
(19, 10, 'ar', 'كمبوندات المعادي', NULL, NULL, NULL),
(20, 10, 'en', 'El Maadi compounds', NULL, NULL, NULL),
(21, 11, 'ar', 'منتجعات طريق مصر اسكندرية الصحراوي', NULL, NULL, NULL),
(22, 11, 'en', 'Alexandria Desert Rd resorts', NULL, NULL, NULL),
(23, 12, 'ar', 'كمبوندات القطامية', NULL, NULL, NULL),
(24, 12, 'en', 'El Katameya compounds', NULL, NULL, NULL),
(25, 13, 'ar', 'كمبوندات مدينة المستقبل', NULL, NULL, NULL),
(26, 13, 'en', 'El Mostakbal city compounds', NULL, NULL, NULL),
(27, 14, 'ar', 'منتجعات الساحل الشمالي', NULL, NULL, NULL),
(28, 14, 'en', 'North coast resorts', NULL, NULL, NULL),
(29, 15, 'ar', 'المطورين العقاريين', NULL, NULL, NULL),
(30, 15, 'en', 'Developers', NULL, NULL, NULL),
(31, 16, 'ar', 'نصائح عقارية', NULL, NULL, NULL),
(32, 16, 'en', 'Real Estate tips', NULL, NULL, NULL),
(33, 17, 'ar', 'منتجعات بورسعيد', NULL, NULL, NULL),
(34, 17, 'en', 'Port Said Resorts', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
