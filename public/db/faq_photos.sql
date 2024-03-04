-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 09:02 PM
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
-- Dumping data for table `faq_photos`
--

INSERT INTO `faq_photos` (`id`, `faq_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `file_extension`, `des_en`, `des_es`, `file_size`, `file_h`, `file_w`, `position`, `print_photo`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-D19MiSedaU.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-hgL5y68wEW.webp', NULL, NULL, '<p>1. Open your Roku device and click the following buttons on your remote :</p>\r\n\r\n<ul>\r\n	<li>Home button 3 times</li>\r\n	<li>Followed by the Up button twice</li>\r\n	<li>Then Right button once</li>\r\n	<li>Left button once</li>\r\n	<li>Right button once</li>\r\n	<li>Left button once</li>\r\n	<li>Right button once</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', NULL, NULL, NULL, NULL, 1, 2, 0, '2024-01-04 08:47:03', '2024-01-04 20:02:11'),
(2, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-CdH2gH08je.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-buFv4LIZVH.webp', NULL, NULL, '<p>2. This will then launch the &ldquo;Developer Options&rdquo; screen<br />\r\n<span style=\"color:#e74c3c\"><strong>IMPORTANT </strong></span>: You must make note of the provided URL that we will use later.<br />\r\nIn this instance, the IP URL is&nbsp; http://192.168.1.22&nbsp; (Yours will be different)<br />\r\nClick Enable installer and restart</p>', NULL, NULL, NULL, NULL, 2, 2, 0, '2024-01-04 08:47:03', '2024-01-04 20:02:11'),
(3, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-8h4AhWePVa.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-LIXfutWwi2.webp', NULL, NULL, '<p>3. Scroll down and click I Agree to Developer Tools License Agreement</p>', NULL, NULL, NULL, NULL, 3, 2, 0, '2024-01-04 08:47:03', '2024-01-04 20:02:08'),
(4, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-Dks06YJaU2.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-dTI0yxUggR.webp', NULL, NULL, '<p>4. When prompted, enter a PIN Number of your choice and click Set password and reboot.&nbsp; (Remember the PIN, you will use it in step # 13)</p>', NULL, NULL, NULL, NULL, 4, 2, 0, '2024-01-04 08:47:03', '2024-01-04 20:02:08'),
(5, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-ex1Tsqoo8V.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-Qs9LFXqIFd.webp', NULL, NULL, '<p>5. Your device will restart</p>', NULL, NULL, NULL, NULL, 5, 2, 0, '2024-01-04 08:47:03', '2024-01-04 20:02:08'),
(6, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-rt8E489Lu9.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-PgKj8ZA0ix.webp', NULL, NULL, '<p>6. Enter the Developer Settings prompt again (step #1) to make sure Developer settings are enabled, if you see it exactly like the second picture below, you are fine and don&rsquo;t change anything, just leave it as it is and move to the next step.</p>', NULL, NULL, NULL, NULL, 6, 2, 0, '2024-01-04 08:47:23', '2024-01-04 20:02:08'),
(7, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-10oWvlbgSa.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-VgmypOrN7p.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 2, 0, '2024-01-04 08:47:23', '2024-01-04 20:02:08'),
(8, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-WpIeW2wJC7.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-gaMEsEWiQg.webp', NULL, NULL, '<p>7. Now open the internet browser on your computer and go to my.roku.com. Enter your account information and click Sign in. Create an account if you don&rsquo;t have one then login.</p>', NULL, NULL, NULL, NULL, 8, 2, 0, '2024-01-04 08:47:23', '2024-01-04 20:02:08'),
(9, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-irJgPZLJwk.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-qbe2KtAEUO.webp', NULL, NULL, '<p>8. Choose Add channel with a code</p>', NULL, NULL, NULL, NULL, 9, 2, 0, '2024-01-04 08:47:23', '2024-01-04 20:02:08'),
(10, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-8TFxJx3qWw.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-jH0Y1ebmYh.webp', NULL, NULL, '<p>9. Type iptvsmarters and then click &ldquo;Add Channel&rdquo;</p>', NULL, NULL, NULL, NULL, 10, 2, 0, '2024-01-04 08:47:23', '2024-01-04 20:02:08'),
(11, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-9Jbt5Jicng.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-CoaJxgDcVz.webp', NULL, NULL, '<p>10. Click OK</p>', NULL, NULL, NULL, NULL, 11, 2, 0, '2024-01-04 08:47:41', '2024-01-04 20:02:08'),
(12, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-IyRL2V5zI9.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-4bQTgH6sKS.webp', NULL, NULL, '<p>11. Click Yes, add channel</p>', NULL, NULL, NULL, NULL, 12, 2, 0, '2024-01-04 08:47:41', '2024-01-04 20:02:08'),
(13, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-j7FX7Lw8Xj.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-24IheLvuL1.webp', NULL, NULL, '<p>12. Next, you must download the IPTV Smarters file to your computer. You &lsquo;ll upload it later to your Roku device.<br />\r\nOn your computer open the internet browser and type,<br />\r\n<a href=\"https://dastreamz.net/roku.zip\">https://dastreamz.net/roku.zip</a>&nbsp;&nbsp; to start downloading the IPTV Smarters Roku App &ldquo;roku.zip&rdquo;,<br />\r\nOr<br />\r\nyou you can download it directly to your computer by clicking HERE and remember where you saved the downloaded file, you will need to browse and select it later in (step# 15).</p>\r\n\r\n<p>&nbsp;</p>', NULL, NULL, NULL, NULL, 13, 2, 0, '2024-01-04 08:47:41', '2024-01-04 20:02:08'),
(14, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-SdVL8CM7RL.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-klbPUAqxHT.webp', NULL, NULL, '<p>13. Now go to the IP URL from the step #2 above on your computer&rsquo;s internet browser and Sign In with username: rokudev and password is &gt; the PIN you created earlier in the step #4 above.<br />\r\nNote, Your IP URL is different than the one shown in the picture below.</p>', NULL, NULL, NULL, NULL, 14, 2, 0, '2024-01-04 08:47:41', '2024-01-04 20:02:08'),
(15, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-bONOzVfVys.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-xcx2kJaGUi.webp', NULL, NULL, '<p>14. Click Upload</p>', NULL, NULL, NULL, NULL, 15, 2, 0, '2024-01-04 08:47:41', '2024-01-04 20:02:08'),
(16, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-tlRjVF88Me.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-RPiI1IPV0d.webp', NULL, NULL, '<p>15. Choose the previously downloaded &ldquo;roku.zip&rdquo; file which downloaded in step #12 , select it and click &ldquo;Open&rdquo;</p>', NULL, NULL, NULL, NULL, 16, 2, 0, '2024-01-04 08:47:58', '2024-01-04 20:02:08'),
(17, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-pHQv3omMWg.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-kcAv9tdW5C.webp', NULL, NULL, '<p>16. Click Install</p>', NULL, NULL, NULL, NULL, 17, 2, 0, '2024-01-04 08:47:58', '2024-01-04 20:02:08'),
(18, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-vOV6wXVBPN.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-0UKyiRjyPl.webp', NULL, NULL, '<p>17. The App has been installed successfully</p>', NULL, NULL, NULL, NULL, 18, 2, 0, '2024-01-04 08:47:58', '2024-01-04 20:02:08'),
(19, 8, 'images/faq/8/how-to-install-iptv-smarters-on-roku-Qd5EjIr4qq.webp', 'images/faq/8/how-to-install-iptv-smarters-on-roku-vLRcepKNvj.webp', NULL, NULL, '<p>18. The IPTV Smarters App will automatically launch on your TV. Enter your service logins, and type <a href=\"http://3.prima-streams.store:80\">http://3.prima-streams.store:80</a> in the URL field, Check &ldquo;Remember me&rdquo; box, then click &ldquo;Login&rdquo;</p>', NULL, NULL, NULL, NULL, 19, 2, 0, '2024-01-04 08:47:58', '2024-01-04 20:02:08'),
(20, 4, 'images/faq/4/how-to-stream-the-service-using-da-web-player-zkiiNwlGiX.webp', 'images/faq/4/how-to-stream-the-service-using-da-web-player-XwEfMVVRD6.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:41:47', '2024-01-04 11:41:47'),
(21, 5, 'images/faq/5/how-to-favourite-unfavourite-a-channel-in-da-web-player-l2jjuMYauJ.webp', 'images/faq/5/how-to-favourite-unfavourite-a-channel-in-da-web-player-lFPewHeUrx.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:42:26', '2024-01-04 11:42:26'),
(22, 6, 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-UdFKn3lQvM.webp', 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-DhcZBHyOS5.webp', NULL, NULL, '<p>1- After you login to &quot;DA WEB PLAYER&quot;, on the Homepage, click the &quot;Settings&quot; gear icon which is located on the top-right corner</p>', NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:43:07', '2024-01-04 11:44:22'),
(23, 6, 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-gEupDCH7eA.webp', 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-NMmHjEkMEa.webp', NULL, NULL, '<p>2- Click &quot;Parental Control&quot;</p>', NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:43:07', '2024-01-04 11:45:08'),
(24, 6, 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-nd2Bn8svTp.webp', 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-URVoLwkLo8.webp', NULL, NULL, '<p>3- Enter a 4 digits PIN then click &quot;NEXT&quot;</p>', NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:43:07', '2024-01-04 11:45:08'),
(25, 6, 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-hV0FCnbCKp.webp', 'images/faq/6/can-i-set-a-parental-control-pin-in-da-web-player-jN1DXWUAWl.webp', NULL, NULL, '<p>4- Confirm the same 4 digits PIN then click &quot;SAVE&quot;</p>', NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:44:32', '2024-01-04 16:09:15'),
(26, 7, 'images/faq/7/how-to-search-for-a-channel-movie-or-series-in-da-web-player-Q2JcoLpAJj.webp', 'images/faq/7/how-to-search-for-a-channel-movie-or-series-in-da-web-player-rq1n4owUIY.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:45:51', '2024-01-04 11:45:51'),
(27, 7, 'images/faq/7/how-to-search-for-a-channel-movie-or-series-in-da-web-player-0h1gJzsleS.webp', 'images/faq/7/how-to-search-for-a-channel-movie-or-series-in-da-web-player-RrbOY6cXbs.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 0, '2024-01-04 11:45:51', '2024-01-04 11:45:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
