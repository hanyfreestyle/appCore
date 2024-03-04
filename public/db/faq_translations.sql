-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 08:31 PM
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
-- Database: `apptv_20240102`
--

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `locale`, `slug`, `name`, `des`, `other`, `g_title`, `g_des`) VALUES
(1, 1, 'en', 'what-is-da-web-player', 'What is \"DA WEB PLAYER\" ?', '<p>It is a web application to stream the service through your web browser without installing any additional apps.</p>', NULL, NULL, NULL),
(2, 2, 'en', 'what-browsers-support-da-web-player', 'What browsers support \"DA WEB PLAYER\" ?', '<p>All web browsers such as Google Chrome, Safari, Microsoft Edge, Mozilla Firefox or any other web browser are supporting &quot;DA WEB PLAYER&quot;</p>', NULL, NULL, NULL),
(3, 3, 'en', 'what-are-the-devices-which-support-da-web-player', 'What are the devices which support \"DA WEB PLAYER\" ?', '<p>All devices have a web browser are supporting &quot;DA WEB PLAYER&quot;. For example:<br />\r\nAndroid phones and tablets<br />\r\niOS devices such as iPhones and iPads<br />\r\nMAC computers<br />\r\nMicrosoft Windows computers<br />\r\nPlayStation<br />\r\nXbox</p>', NULL, NULL, NULL),
(4, 4, 'en', 'how-to-stream-the-service-using-da-web-player', 'How to stream the service using \"DA WEB PLAYER\" ?', '<p>It&#39;s pretty simple, just copy and paste in your web browser&gt;&gt;<br />\r\n<a href=\"http://dastreamz-player.xyz:8080/webplayer\" target=\"_blank\">http://dastreamz-player.xyz:8080/webplayer</a><br />\r\nType any name from your choice in the &quot;Any Name&quot; field<br />\r\nEnter your service Username<br />\r\nEnter your service Password<br />\r\nHit &quot;ADD USER&quot;</p>', NULL, NULL, NULL),
(5, 5, 'en', 'how-to-favourite-unfavourite-a-channel-in-da-web-player', 'How to favourite /unfavourite a channel in \"DA WEB PLAYER\" ?', '<p>Simply, stop on the channel that you want to add to Favourite, and click the white heart symbol.<br />\r\nClick the heart symbol again to remove the channel from the favourite list.</p>', NULL, NULL, NULL),
(6, 6, 'en', 'can-i-set-a-parental-control-pin-in-da-web-player', 'Can I set a Parental Control PIN in \"DA WEB PLAYER\" ?', '<p>Yes, you can by doing the following :</p>', NULL, NULL, NULL),
(7, 7, 'en', 'how-to-search-for-a-channel-movie-or-series-in-da-web-player', 'How to search for a channel, movie, or  series in \"DA WEB PLAYER\" ?', '<p>You can search for a specific channel, movie, or&nbsp; series. For example you can search for &quot;FOX NEWS&quot; channel by clicking the &quot;Master Search&quot; which is located in the top right corner of the main home page, and type-in &quot;FOX NEWS&quot; then click the &quot;Search&quot; button, same concept when searching for a movie or a series.</p>', NULL, NULL, NULL),
(8, 8, 'en', 'how-to-install-iptv-smarters-on-roku', 'How to Install IPTV Smarters on Roku ?', '<p>The following tutorial will provide you with step-by-step instructions to install the IPTV Smarters app on a Roku device for your live streaming needs.<br />\r\nBecause Roku uses a closed source system, we must &ldquo;sideload&rdquo; the IPTV app onto this device for use.<br />\r\nThis will require the use of a computer in order to download the IPTV app file and add it to your Roku streaming device.<br />\r\nWe always recommend using an Android-powered device such as a Firestick, Fire TV, or An android Box because of its open-source system.</p>\r\n\r\n<p>&nbsp;</p>', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
