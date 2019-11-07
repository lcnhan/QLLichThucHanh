-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 04:42 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wemart`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_avt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no_avt.png',
  `phone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'User',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `username`, `user_avt`, `phone`, `address`, `role`, `updated_at`, `created_at`) VALUES
(1, 'Chí Nguyễn', 'cn', '$2y$10$fbiiMXYuyMEF3ddb5pxBZ./Ce6uCfI1B3t7XqiXO3vkgR8VfB1wy2', 'cn', 'fgfgf.jpg', '0945665162', 'Trường Trung Cấp Bưu Chính Viễn Thông Và CNTT III - Xã Tân Mỹ Chánh - TP. Mỹ Tho - Tiền Giang', 'Admin', '2019-07-09 09:41:01', '2019-07-01 02:10:01'),
(2, 'Mitgaming', 'mitmit', '$2y$10$vwlqtbxvvL0InMmDQJflUuDWOduUgnyMn5URhfFwt/QNtNHyaRrui', NULL, 'no_avt.png', NULL, NULL, 'User', '2019-07-03 04:26:31', '2019-07-03 04:26:31'),
(3, 'mit', 'mitmit', '$2y$10$wgPaQsJJIBqpKngLYrzyhuoGY9J9l.m1laqsiEJWJLU/14erikHgy', NULL, 'no_avt.png', NULL, NULL, 'User', '2019-07-03 15:32:10', '2019-07-03 15:32:10'),
(11, 'hieu', 'a', '$2y$10$EgfxhT0YCrBLL62PfdipSuKtgEETTi7FO90MQCEnxMevShKiPscci', 'hieu', '94 - Kq1Gc0O.gif', NULL, NULL, 'User', '2019-07-07 07:27:39', '2019-07-06 06:09:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
