-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 06:05 PM
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
-- Dumping data for table `config_def_photos`
--

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `postion`, `created_at`, `updated_at`) VALUES
(1, 'dark_logo', 'images/def-photo/dark-logo-eh5ttAQPSH.webp', NULL, NULL, 2, '2023-08-16 09:18:40', '2024-01-23 05:54:35'),
(3, 'project', 'images/def-photo/project-nvG40dODkH.webp', 'images/def-photo/project-mc4bebeaXL.webp', NULL, 6, '2023-08-16 09:18:40', '2024-01-23 13:02:24'),
(4, 'blog', 'images/def-photo/blog-h9LR5xx5WF.webp', 'images/def-photo/blog-IU0k9z7vQA.webp', NULL, 4, '2023-08-16 09:18:40', '2024-01-23 08:00:46'),
(6, 'units', 'images/def-photo/units-pUYkExfD17.webp', 'images/def-photo/units-Dz6Sc6w7C3.webp', NULL, 7, '2023-08-16 09:18:40', '2024-01-23 13:06:42'),
(7, 'developer', 'images/def-photo/developer-mPN1fhwSWk.webp', 'images/def-photo/developer-iffTkggl7G.webp', NULL, 3, '2023-08-16 11:28:03', '2024-01-23 07:54:15'),
(8, 'light_logo', 'images/def-photo/light-logo-DNJrdvlgdZ.webp', NULL, NULL, 1, '2023-10-15 07:03:47', '2024-01-23 05:54:35'),
(9, 'video_photo', 'images/def-photo/video-photo-eRtOLIqyh5.webp', NULL, NULL, 9, '2023-10-17 06:11:28', '2024-01-24 08:02:52'),
(10, 'location', 'images/def-photo/location-sxtuFwdWTp.webp', 'images/def-photo/location-0V240kMLWP.webp', NULL, 5, '2023-10-17 15:36:15', '2024-01-23 08:37:04'),
(11, 'google_map', 'images/def-photo/google-map-YECvqHwhYi.webp', NULL, NULL, 8, '2024-01-24 08:02:39', '2024-01-24 08:02:52'),
(12, 'err_404', 'images/def-photo/err-404-GyYn77ncLv.webp', NULL, NULL, 10, '2024-01-25 09:48:47', '2024-01-28 16:32:58'),
(13, 'thanks', 'images/def-photo/thanks-kc7RWwQE9g.webp', NULL, NULL, 11, '2024-01-28 16:23:45', '2024-01-30 16:37:36'),
(14, 'no_data', 'images/def-photo/no-data-fk1XLeMYcF.webp', NULL, NULL, 12, '2024-01-30 16:37:25', '2024-01-30 16:37:36'),
(15, 'logo', 'images/def-photo/logo-0dNaY7pzJd.webp', 'images/def-photo/logo-FhNg8hHcJv.webp', NULL, 0, '2024-02-21 14:53:44', '2024-02-21 14:53:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
