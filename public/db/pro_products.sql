-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 01:28 PM
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
-- Database: `a_cart`
--

--
-- Dumping data for table `pro_products`
--

INSERT INTO `pro_products` (`id`, `old_id`, `brand_id`, `old_brand_id`, `sku`, `cat_id`, `old_cat_id`, `children`, `type`, `tag_id`, `price`, `regular_price`, `sale_price`, `qty_left`, `qty_max`, `unit`, `photo`, `photo_thum_1`, `photo_thum_2`, `photo_thum_3`, `on_stock`, `is_active`, `is_archived`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 100.00, 450.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, '2024-03-16 10:26:02', '2024-03-16 10:26:02', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
