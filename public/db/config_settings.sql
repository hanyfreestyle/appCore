-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 04:47 PM
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
-- Dumping data for table `config_settings`
--

INSERT INTO `config_settings` (`id`, `web_url`, `web_status`, `fav_view`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `facebook`, `youtube`, `twitter`, `instagram`, `google_api`, `project_update`, `location_update`, `developer_update`) VALUES
(1, '#', 0, 1, '0100-9808-986', '0100-9808-986', '01009808986', '201009808986', 'sales@realestate.eg.com', 'https://www.facebook.com/', 'https://www.youtube.com', 'https://www.twitter.com/', 'https://www.Instagram.com/', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
