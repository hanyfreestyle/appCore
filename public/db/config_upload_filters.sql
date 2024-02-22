-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 06:06 PM
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
-- Dumping data for table `config_upload_filters`
--

INSERT INTO `config_upload_filters` (`id`, `name`, `type`, `convert_state`, `quality_val`, `new_w`, `new_h`, `canvas_back`, `greyscale`, `flip_state`, `flip_v`, `blur`, `blur_size`, `pixelate`, `pixelate_size`, `text_state`, `text_print`, `font_size`, `font_path`, `font_color`, `font_opacity`, `text_position`, `watermark_state`, `watermark_img`, `watermark_position`, `state`, `notes_ar`, `notes_en`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NoEdit', 1, 1, 85, 100, 100, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(2, 'DefPhoto', 4, 1, 85, 800, 420, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(3, 'FavIcon', 4, 1, 85, 40, 40, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(4, 'المطورين', 5, 1, 85, 500, 500, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مربعة اقل عرض 500 اقل ارتفاع 500 سيتم اعادة ضبط ابعاد الصورة على خلفيه بيضاء فى حالة عدم تساوى النسب', NULL, '2023-10-15 07:42:57', '2024-01-23 14:01:24', NULL),
(5, 'المطورين المزيد من الصور', 4, 1, 85, 1024, 768, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2023-10-15 07:42:57', '2024-01-23 14:06:00', NULL),
(6, 'المناطق', 4, 1, 85, 670, 800, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 420 اقل ارتفاع 500 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2023-11-16 06:54:14', '2024-01-23 14:07:06', NULL),
(7, 'المقالات', 4, 1, 85, 800, 420, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 800 اقل ارتفاع 420 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2024-01-22 17:51:06', '2024-01-23 14:07:22', NULL),
(8, 'المقالات المزيد من الصور', 4, 1, 85, 1024, 768, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2024-01-22 19:39:31', '2024-01-23 14:06:23', NULL),
(9, 'المشاريع', 4, 1, 85, 800, 527, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 800 اقل ارتفاع 527 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2024-01-23 09:19:58', '2024-01-23 14:07:39', NULL),
(10, 'المشاريع المزيد من الصور', 4, 1, 85, 1024, 768, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2024-01-23 12:22:09', '2024-01-23 14:06:32', NULL),
(11, 'الوحدات', 4, 1, 85, 800, 600, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 800 اقل ارتفاع 600 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2024-01-23 13:04:27', '2024-01-23 14:07:53', NULL),
(12, 'الوحدات المزيد من الصور', 4, 1, 85, 1024, 678, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2024-01-23 13:31:52', '2024-01-23 14:06:41', NULL),
(13, 'البوم صور مع علامة مائية', 4, 1, 85, 1024, 768, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, 'https://realestate.eg/', '20', 'assets/admin/intervention/font/Cairo-Regular.ttf', '#ED4F4F', '20', 'center', 1, 'assets/admin/intervention/watermark/logo.png', 'bottom', 0, NULL, NULL, '2024-01-23 14:08:50', '2024-01-23 14:58:19', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
