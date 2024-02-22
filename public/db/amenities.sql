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
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `icon`, `photo`, `photo_thum_1`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-gavel', '', '', '2023-10-15 07:42:56', '2023-10-17 06:53:07'),
(2, 'fas fa-volleyball-ball', 'images/amenity/playgrounds.webp', 'images/amenity/playgrounds_0.webp', '2023-10-15 07:42:56', '2023-10-15 07:42:56'),
(3, 'fas fa-swimming-pool', 'images/amenity/swimming-pools.webp', 'images/amenity/swimming-pools_0.webp', '2023-10-15 07:42:56', '2023-10-15 07:42:56'),
(4, 'fas fa-shopping-cart', 'images/amenity/shopping-center.webp', 'images/amenity/shopping-center_0.webp', '2023-10-15 07:42:56', '2023-10-15 07:42:56'),
(5, 'far fa-address-book', '', '', '2023-10-15 07:42:56', '2023-10-17 06:53:25'),
(6, 'fas fa-mosque', '', '', '2023-10-15 07:42:56', '2023-10-17 06:54:31'),
(7, 'fas fa-football-ball', 'images/amenity/social-club.webp', 'images/amenity/social-club_0.webp', '2023-10-15 07:42:56', '2023-10-17 06:54:59'),
(8, 'fas fa-hospital', '', '', '2023-10-15 07:42:56', '2023-10-17 06:55:16'),
(9, 'fas fa-swatchbook', '', '', '2023-10-15 07:42:56', '2023-10-17 06:59:03'),
(10, 'fas fa-hotel', '', '', '2023-10-15 07:42:56', '2023-10-17 06:55:47'),
(11, 'fas fa-coffee', '', '', '2023-10-15 07:42:56', '2023-10-17 06:59:35'),
(12, 'fas fa-apple-alt', '', '', '2023-10-15 07:42:56', '2023-10-17 06:59:50'),
(13, 'fas fa-bed', '', '', '2023-10-15 07:42:56', '2023-10-17 06:59:57'),
(14, 'fas fa-bath', '', '', '2023-10-15 07:42:56', '2023-10-17 07:00:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
