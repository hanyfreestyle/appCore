-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 12:01 PM
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
-- Database: `a_realestate`
--

--
-- Dumping data for table `amenity_translations`
--

INSERT INTO `amenity_translations` (`id`, `amenity_id`, `locale`, `name`) VALUES
(1, 1, 'ar', 'حراسة'),
(2, 2, 'ar', 'ملاعب'),
(3, 3, 'ar', 'حمامات سباحة'),
(4, 4, 'ar', 'مركز تجاري'),
(5, 5, 'ar', 'منطقة تجارية'),
(6, 6, 'ar', 'مسجد'),
(7, 7, 'ar', 'نادي اجتماعي'),
(8, 8, 'ar', 'نادي صحي و رياضي'),
(9, 9, 'ar', 'نافورات مياه'),
(10, 10, 'ar', 'فندق'),
(11, 11, 'ar', 'اكوا بارك'),
(12, 12, 'ar', 'سينما'),
(13, 13, 'ar', 'غرفتين'),
(14, 14, 'ar', '2 حمام'),
(15, 1, 'en', 'Security'),
(16, 2, 'en', 'Playgrounds'),
(17, 3, 'en', 'Swimming pools'),
(18, 4, 'en', 'Shopping center'),
(19, 5, 'en', 'Commercial area'),
(20, 6, 'en', 'Mosque'),
(21, 7, 'en', 'Social Club'),
(22, 8, 'en', 'Health club and Spa'),
(23, 9, 'en', 'Water Fountains'),
(24, 10, 'en', 'Hotel'),
(25, 11, 'en', 'Aqua park'),
(26, 12, 'en', 'Cinema'),
(27, 13, 'en', '2 Bedrooms'),
(28, 14, 'en', '2 Bathrooms');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
