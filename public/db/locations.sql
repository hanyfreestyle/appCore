-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 07:37 PM
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
-- Database: `a_realestate_2026`
--

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `parent_id`, `slug`, `sort_order`, `latitude`, `longitude`, `projects_type`, `photo`, `photo_thum_1`, `is_active`, `is_searchable`, `is_home`, `projects_count`, `units_count`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'greater-cairo', 5, 30.1314718, 31.0581095, 'compound', 'storage/locations/3R7OCNjmcRgBOlPA.jpg', 'storage/locations/3R7OCNjmcRgBOlPA_thumb.jpg', 1, 0, NULL, 0, 0, NULL, '2018-11-30 16:24:38', '2024-01-23 17:48:47'),
(2, 1, 'greater-cairo/cairo-east', 3, NULL, NULL, 'compound', 'storage/locations/qx5ZURVstiYldjPq.jpg', 'storage/locations/qx5ZURVstiYldjPq_thumb.jpg', 1, 1, NULL, 5, 40, NULL, '2018-11-30 16:52:30', '2024-01-23 17:48:47'),
(3, 1, 'greater-cairo/cairo-west', 2, NULL, NULL, 'compound', 'storage/locations/q0gdpTovthQW8nJV.jpg', 'storage/locations/q0gdpTovthQW8nJV_thumb.jpg', 1, 1, NULL, 1, 1, NULL, '2018-11-30 16:54:24', '2024-01-23 17:48:47'),
(4, 7, 'north-coast', 1, 30.946991, 28.762207, NULL, 'images/location/north-coast-PeRcgF1ySt.webp', 'images/location/north-coast-eo3oLvKEQ8.webp', 1, 1, 0, 166, 3194, NULL, '2018-11-30 17:05:26', '2024-01-23 16:17:58'),
(5, 7, 'egypt/red-sea', 4, NULL, NULL, 'resort', 'storage/locations/ckql3wQlioWbR2TY.jpg', 'storage/locations/ckql3wQlioWbR2TY_thumb.jpg', 1, 1, NULL, 2, 40, NULL, '2018-11-30 17:06:22', '2024-01-23 17:48:47'),
(6, 2, 'new-administrative-capital', 5, 29.9954014, 31.73525, NULL, 'images/location/new-administrative-capital-clri78Im23.webp', 'images/location/new-administrative-capital-0IUzRf3aS6.webp', 1, 1, 0, 539, 10212, NULL, '2018-11-30 21:11:30', '2024-01-23 16:05:02'),
(7, NULL, 'egypt', 5, 26.8349117, 26.3810043, 'compound', 'storage/locations/GEtxwpoXlUX5twsw.jpg', 'storage/locations/GEtxwpoXlUX5twsw_thumb.jpg', 1, 0, NULL, 0, 0, NULL, '2018-12-01 12:11:52', '2024-01-23 17:48:48'),
(8, 2, 'new-cairo', 5, 30.0178476, 31.4174195, NULL, 'images/location/new-cairo-NNdslE3RcQ.webp', 'images/location/new-cairo-AX3PFGOTSd.webp', 1, 1, 0, 548, 8108, NULL, '2018-12-01 14:39:18', '2024-01-23 15:59:48'),
(9, 2, 'mostakbal-city', 5, 30.0681649, 31.6854668, NULL, 'images/location/mostakbal-city-9ydeFdpPbe.webp', 'images/location/mostakbal-city-bCPQfEvcuV.webp', 1, 1, 0, 51, 1270, NULL, '2018-12-01 14:57:44', '2024-01-23 16:35:13'),
(10, 2, 'cairo-east/maadi', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 4, 75, NULL, '2018-12-01 14:58:21', '2024-01-23 17:48:48'),
(11, 2, 'cairo-east/nasr-city', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 6, 86, NULL, '2018-12-01 14:59:03', '2024-01-23 17:48:48'),
(12, 2, 'katamya', 5, NULL, NULL, 'compound', 'storage/locations/EZXdmg2s8KZZxwOq.jpg', 'storage/locations/EZXdmg2s8KZZxwOq_thumb.jpg', 1, 1, NULL, 11, 270, NULL, '2018-12-01 14:59:48', '2024-01-23 17:48:48'),
(13, 2, 'cairo-east/obour', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 1, 15, NULL, '2018-12-01 15:00:37', '2024-01-23 17:48:48'),
(14, 2, 'sherouk', 5, NULL, NULL, NULL, 'images/location/sherouk-482hAUVknP.webp', 'images/location/sherouk-c0c6Urt2vT.webp', 1, 1, 0, 56, 678, NULL, '2018-12-01 15:01:26', '2024-01-23 16:36:17'),
(15, 3, 'sixth-october-city', 5, NULL, NULL, NULL, 'images/location/sixth-october-city-nJpbKFXxzo.webp', 'images/location/sixth-october-city-MVCTwjcYMW.webp', 1, 1, 0, 131, 2886, NULL, '2018-12-01 15:18:45', '2024-01-23 16:23:07'),
(16, 3, 'sheikh-zayed', 5, NULL, NULL, NULL, 'images/location/sheikh-zayed-4ZT3OCAPca.webp', 'images/location/sheikh-zayed-9x3eZY5oKf.webp', 1, 1, 0, 141, 2365, NULL, '2018-12-01 15:19:43', '2024-01-23 16:20:00'),
(17, 3, 'alex-desert-road', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 7, 180, NULL, '2018-12-01 15:20:23', '2024-01-23 17:48:48'),
(18, 5, 'al-ain-al-sokhna', NULL, 29.725924, 32.304611, NULL, 'images/location/al-ain-al-sokhna-ksyt1ayPSG.webp', 'images/location/al-ain-al-sokhna-vAF1JGvmKx.webp', 1, 1, 0, 65, 2235, NULL, '2019-01-05 18:22:32', '2024-01-23 16:25:01'),
(19, 7, 'New-Mansoura-City', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 3, 63, NULL, '2019-08-04 17:08:26', '2024-01-23 17:48:48'),
(20, 5, 'hurghada', NULL, NULL, NULL, NULL, 'images/location/hurghada-S63rDbXl7Q.webp', 'images/location/hurghada-XTufiSkK29.webp', 1, 1, 0, 17, 367, NULL, '2019-08-04 17:09:28', '2024-01-23 16:33:09'),
(21, 2, 'new-heliopolis-city', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 7, 128, NULL, '2019-08-04 17:12:00', '2024-01-23 17:48:48'),
(22, 5, 'ras-sudr', NULL, NULL, NULL, 'resort', NULL, NULL, 1, 1, NULL, 2, 32, NULL, '2020-04-10 21:58:46', '2024-01-23 17:48:48'),
(23, 7, 'new-alamein', NULL, NULL, NULL, NULL, 'images/location/new-alamein-6GzqSJDP8B.webp', 'images/location/new-alamein-KvY1rcG5ie.webp', 1, 1, 0, 13, 327, NULL, '2020-04-14 01:45:35', '2024-01-23 16:29:42'),
(24, 7, 'alexandria', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, 7, 137, NULL, '2020-05-29 08:45:20', '2024-01-23 17:48:48'),
(25, 7, 'tanta', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 0, NULL, 0, 1, NULL, '2020-09-14 13:32:45', '2024-01-23 17:48:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
