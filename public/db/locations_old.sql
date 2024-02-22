-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 11:18 AM
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
-- Database: `a_test_puzzle`
--

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `parent_id`, `slug`, `sort_order`, `latitude`, `longitude`, `projects_type`, `photo`, `photo_thum_1`, `is_active`, `is_searchable`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'greater-cairo', 5, 30.1314718, 31.0581095, 'compound', 'storage/locations/3R7OCNjmcRgBOlPA.jpg', 'storage/locations/3R7OCNjmcRgBOlPA_thumb.jpg', 1, 0, NULL, '2018-11-30 16:24:38', '2023-07-24 13:27:07'),
(2, 1, 'greater-cairo/cairo-east', 3, NULL, NULL, 'compound', 'storage/locations/qx5ZURVstiYldjPq.jpg', 'storage/locations/qx5ZURVstiYldjPq_thumb.jpg', 1, 1, NULL, '2018-11-30 16:52:30', '2023-07-24 13:27:07'),
(3, 1, 'greater-cairo/cairo-west', 2, NULL, NULL, 'compound', 'storage/locations/q0gdpTovthQW8nJV.jpg', 'storage/locations/q0gdpTovthQW8nJV_thumb.jpg', 1, 1, NULL, '2018-11-30 16:54:24', '2023-07-24 13:27:07'),
(4, 1, 'North-Coast', 1, 30.946991, 28.762207, 'resort', 'storage/locations/hJvU5PZ0Srr4S0Xe.jpg', 'storage/locations/hJvU5PZ0Srr4S0Xe_thumb.jpg', 1, 1, NULL, '2018-11-30 17:05:26', '2023-08-01 09:15:22'),
(5, 1, 'egypt/red-sea', 4, NULL, NULL, 'resort', 'storage/locations/ckql3wQlioWbR2TY.jpg', 'storage/locations/ckql3wQlioWbR2TY_thumb.jpg', 1, 1, NULL, '2018-11-30 17:06:22', '2023-08-01 09:15:22'),
(6, 2, 'new-administrative-capital', 5, 29.9954014, 31.73525, 'compound', 'storage/locations/o7OgU9qLZlL3JrQn.jpg', 'storage/locations/o7OgU9qLZlL3JrQn_thumb.jpg', 1, 1, NULL, '2018-11-30 21:11:30', '2023-07-24 13:27:07'),
(7, NULL, 'egypt', 5, 26.8349117, 26.3810043, 'compound', 'storage/locations/GEtxwpoXlUX5twsw.jpg', 'storage/locations/GEtxwpoXlUX5twsw_thumb.jpg', 1, 0, NULL, '2018-12-01 12:11:52', '2023-07-24 13:27:07'),
(8, 2, 'new-cairo', 5, 30.0178476, 31.4174195, 'compound', 'storage/locations/Yrs7SPSJBNxNupwu.jpg', 'storage/locations/Yrs7SPSJBNxNupwu_thumb.jpg', 1, 1, NULL, '2018-12-01 14:39:18', '2023-07-24 13:27:07'),
(9, 2, 'mostakbal-city', 5, 30.0681649, 31.6854668, 'compound', 'storage/locations/7YzArWINOTqyKVBw.jpg', 'storage/locations/7YzArWINOTqyKVBw_thumb.jpg', 1, 1, NULL, '2018-12-01 14:57:44', '2023-07-24 13:27:07'),
(10, 2, 'cairo-east/maadi', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2018-12-01 14:58:21', '2019-02-26 15:17:37'),
(11, 2, 'cairo-east/nasr-city', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2018-12-01 14:59:03', '2019-02-26 14:58:54'),
(12, 2, 'katamya', 5, NULL, NULL, 'compound', 'storage/locations/EZXdmg2s8KZZxwOq.jpg', 'storage/locations/EZXdmg2s8KZZxwOq_thumb.jpg', 1, 1, NULL, '2018-12-01 14:59:48', '2023-07-24 13:27:07'),
(13, 2, 'cairo-east/obour', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2018-12-01 15:00:37', '2019-02-26 14:52:52'),
(14, 2, 'sherouk', 5, NULL, NULL, 'compound', 'storage/locations/XZQDIFhHUrc7427O.jpg', 'storage/locations/XZQDIFhHUrc7427O_thumb.jpg', 1, 1, NULL, '2018-12-01 15:01:26', '2023-07-24 13:27:07'),
(15, 3, 'sixth-october-city', 5, NULL, NULL, 'compound', 'storage/locations/OYixCEhXYaOMa6Ms.jpg', 'storage/locations/OYixCEhXYaOMa6Ms_thumb.jpg', 1, 1, NULL, '2018-12-01 15:18:45', '2023-07-24 13:27:07'),
(16, 3, 'sheikh-zayed', 5, NULL, NULL, 'compound', 'storage/locations/hlWVeYBhHuTnU8jF.jpg', 'storage/locations/hlWVeYBhHuTnU8jF_thumb.jpg', 1, 1, NULL, '2018-12-01 15:19:43', '2023-07-24 13:27:07'),
(17, 3, 'alex-desert-road', 5, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2018-12-01 15:20:23', '2019-10-14 17:32:26'),
(18, 5, 'al-ain-al-sokhna', NULL, 29.725924, 32.304611, 'resort', 'storage/locations/lgCYZyS7JwCtGpRh.jpg', 'storage/locations/lgCYZyS7JwCtGpRh_thumb.jpg', 1, 1, NULL, '2019-01-05 18:22:32', '2023-07-24 13:27:07'),
(19, 7, 'New-Mansoura-City', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2019-08-04 17:08:26', '2019-08-07 02:59:49'),
(20, 5, 'hurghada', NULL, NULL, NULL, 'resort', 'storage/locations/HsEDYJZ5TmaLgFBC.jpg', 'storage/locations/HsEDYJZ5TmaLgFBC_thumb.jpg', 1, 1, NULL, '2019-08-04 17:09:28', '2023-07-24 13:27:07'),
(21, 2, 'new-heliopolis-city', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2019-08-04 17:12:00', '2019-08-05 13:04:21'),
(22, 5, 'ras-sudr', NULL, NULL, NULL, 'resort', NULL, NULL, 1, 1, NULL, '2020-04-10 21:58:46', '2020-04-14 01:04:50'),
(23, 7, 'new-alamein', NULL, NULL, NULL, 'resort', 'storage/locations/LdAZYggbrjevm6tb.jpg', 'storage/locations/LdAZYggbrjevm6tb_thumb.jpg', 1, 1, NULL, '2020-04-14 01:45:35', '2023-07-24 13:27:07'),
(24, 7, 'alexandria', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 1, NULL, '2020-05-29 08:45:20', '2020-05-29 08:45:20'),
(25, 7, 'tanta', NULL, NULL, NULL, 'compound', NULL, NULL, 1, 0, NULL, '2020-09-14 13:32:45', '2020-09-14 13:33:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
