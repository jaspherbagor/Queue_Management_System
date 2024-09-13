-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 04:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queue_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `name`, `description`, `created_at`, `updated_at`, `status`) VALUES
(22, '1', 'pay', '2024-05-24', '2024-07-23', 1),
(23, '2', 'permit', '2024-05-24', NULL, 1),
(24, '3', 'card', '2024-05-24', NULL, 1),
(25, '4', 'enrollment', '2024-05-24', '2024-07-16', 1),
(26, '5', 'completion', '2024-05-24', NULL, 1),
(27, '6', 'This is a test window', '2024-08-18', '2024-08-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `key` varchar(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `key`, `created_at`, `updated_at`, `status`) VALUES
(13, 'Cashier', 'pay', '1', '2024-05-24 07:58:49', '2024-07-14 18:59:42', 1),
(14, 'Permit', 'permit', '2', '2024-05-24 08:00:29', NULL, 1),
(15, 'Card', 'card', '3', '2024-05-24 08:33:45', '2024-08-04 21:57:35', 1),
(16, 'Enrollment Form', 'enrollment', '4', '2024-05-24 08:42:41', '2024-07-16 20:07:13', 1),
(17, 'Completion Form', 'completion', '5', '2024-05-24 08:56:28', NULL, 1),
(18, 'Test Dep', 'test dept', '6', '2024-08-18 08:49:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE `display` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `direction` varchar(10) DEFAULT 'left',
  `color` varchar(10) DEFAULT '#ffffff',
  `background_color` varchar(10) NOT NULL DEFAULT '#cdcdcd',
  `border_color` varchar(10) NOT NULL DEFAULT '#ffffff',
  `time_format` varchar(20) DEFAULT 'h:i:s A',
  `date_format` varchar(50) DEFAULT 'd M, Y',
  `updated_at` datetime DEFAULT NULL,
  `display` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-single, 2/3-counter,4-department,5-hospital',
  `keyboard_mode` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `sms_alert` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0-inactive, 1-active ',
  `show_note` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-inactive, 1-active ',
  `show_officer` tinyint(1) NOT NULL DEFAULT 1,
  `show_department` tinyint(1) NOT NULL DEFAULT 1,
  `alert_position` int(2) NOT NULL DEFAULT 3,
  `language` varchar(20) DEFAULT 'English'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `display`
--

INSERT INTO `display` (`id`, `message`, `direction`, `color`, `background_color`, `border_color`, `time_format`, `date_format`, `updated_at`, `display`, `keyboard_mode`, `sms_alert`, `show_note`, `show_officer`, `show_department`, `alert_position`, `language`) VALUES
(1, 'QUEUEING SYSTEM FOR POLYTECHNIC COLLEGE OF LA UNION', 'left', '#000000', '#53bcfd', '#3c8dbc', 'h:i:s A', 'F j, Y', '2024-06-30 08:23:50', 3, 1, 0, 0, 1, 1, 2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `display_custom`
--

CREATE TABLE `display_custom` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `counters` varchar(64) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1-active, 2-inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `display_custom`
--

INSERT INTO `display_custom` (`id`, `name`, `description`, `counters`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Floor 1', 'TEST 1', '1,2,3,6', 1, '2020-10-01 03:34:44', '2020-10-01 14:40:10'),
(2, 'Floor 2', 'TEST 2', '6,7,8,9,10', 0, '2020-10-01 03:35:28', '2020-10-01 09:17:20'),
(3, 'Floor 3', 'TEST 3', '8,9,10,11,12,13', 1, '2020-10-01 03:35:51', '2020-10-01 08:48:36'),
(4, 'Floor 4', 'TESTS Floor', '4,5,6,7', 1, '2020-10-01 10:11:00', '2020-10-01 06:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_ads`
--

CREATE TABLE `image_ads` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_ads`
--

INSERT INTO `image_ads` (`id`, `image`, `created_at`, `updated_at`) VALUES
(8, '1725631026.png', '2024-09-06 21:57:06', '2024-09-06 21:57:06'),
(9, '1725631412.png', '2024-09-06 22:03:32', '2024-09-06 22:03:32'),
(10, '1725631673.png', '2024-09-06 22:07:53', '2024-09-06 22:07:53'),
(11, '1725632365.jpg', '2024-09-06 22:19:25', '2024-09-06 22:19:25'),
(12, '1725632390.jpg', '2024-09-06 22:19:50', '2024-09-06 22:19:50'),
(13, '1725717307.jpg', '2024-09-07 21:55:07', '2024-09-07 21:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `timezone` varchar(32) NOT NULL DEFAULT 'Asia/Dhaka'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `description`, `logo`, `favicon`, `email`, `phone`, `address`, `copyright_text`, `direction`, `language`, `timezone`) VALUES
(1, 'PCLU Queueing Management System', 'Queue', 'public/assets/img/icons/logo.jpg', 'public/assets/img/icons/favicon.jpg', 'lyka@gmail.com', '+639 221234567', 'Agoo, La Union', 'Copyright 2024', NULL, NULL, 'Asia/Hong_Kong');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token_no` varchar(10) DEFAULT NULL,
  `client_mobile` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `counter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` varchar(512) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_vip` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-pending, 1-complete, 2-stop',
  `sms_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-pending, 1-sent, 2-quick-send'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token_no`, `client_mobile`, `department_id`, `counter_id`, `user_id`, `note`, `created_by`, `created_at`, `updated_at`, `is_vip`, `status`, `sms_status`) VALUES
(444, '11000', NULL, 13, 22, 31, NULL, 1, '2024-08-27 20:22:47', '2024-08-27 20:37:24', NULL, 1, 0),
(452, '44000', NULL, 16, 25, 34, NULL, 1, '2024-09-01 15:00:30', '2024-09-01 15:06:32', NULL, 1, 1),
(454, '11000', NULL, 13, 22, 31, NULL, 1, '2024-09-01 15:15:07', NULL, NULL, 0, 0),
(455, '11001', NULL, 13, 22, 31, NULL, 1, '2024-09-01 15:15:12', NULL, NULL, 0, 0),
(456, '11000', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:19:45', NULL, NULL, 0, 0),
(457, '11001', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:24:04', NULL, NULL, 0, 0),
(458, '11002', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:24:08', NULL, NULL, 0, 0),
(459, '11003', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:24:22', NULL, NULL, 0, 0),
(460, '11004', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:30:06', NULL, NULL, 0, 0),
(461, '11005', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:31:28', NULL, NULL, 0, 0),
(462, '11006', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:31:45', NULL, NULL, 0, 0),
(463, '11007', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:36:18', NULL, NULL, 0, 0),
(464, '11008', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:36:53', NULL, NULL, 0, 0),
(465, '11009', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:44:29', NULL, NULL, 0, 0),
(466, '11010', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:45:57', NULL, NULL, 0, 0),
(467, '11011', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:46:37', NULL, NULL, 0, 0),
(468, '11012', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:49:39', NULL, NULL, 0, 0),
(469, '11013', NULL, 13, 22, 31, NULL, 1, '2024-09-02 20:58:31', NULL, NULL, 0, 0),
(470, '11014', NULL, 13, 22, 31, NULL, 1, '2024-09-02 21:06:09', NULL, NULL, 0, 0),
(471, '11000', NULL, 13, 22, 31, NULL, 38, '2024-09-03 19:53:25', NULL, NULL, 0, 0),
(472, '11001', NULL, 13, 22, 31, NULL, 38, '2024-09-03 19:54:13', NULL, NULL, 0, 0),
(473, '55000', NULL, 17, 26, 35, NULL, 1, '2024-09-06 22:31:10', NULL, NULL, 0, 0),
(474, '44000', NULL, 16, 25, 34, NULL, 1, '2024-09-06 22:31:13', NULL, NULL, 0, 0),
(475, '33000', NULL, 15, 24, 33, NULL, 1, '2024-09-06 22:31:16', NULL, NULL, 0, 0),
(476, '44001', NULL, 16, 25, 34, NULL, 1, '2024-09-06 22:31:18', NULL, NULL, 0, 0),
(477, '33001', NULL, 15, 24, 33, NULL, 1, '2024-09-06 22:31:21', NULL, NULL, 0, 0),
(478, '55001', NULL, 17, 26, 35, NULL, 1, '2024-09-06 22:31:24', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `token_setting`
--

CREATE TABLE `token_setting` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `counter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `token_setting`
--

INSERT INTO `token_setting` (`id`, `department_id`, `counter_id`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(25, 13, 22, 31, '2024-05-24 07:59:56', NULL, 1),
(26, 14, 23, 32, '2024-05-24 08:01:31', NULL, 1),
(27, 15, 24, 33, '2024-05-24 08:36:14', NULL, 1),
(28, 16, 25, 34, '2024-05-24 08:58:03', NULL, 1),
(29, 17, 26, 35, '2024-05-24 08:58:23', NULL, 1),
(30, 18, 27, 36, '2024-08-19 21:03:46', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=officer, 2=staff, 3=client, 5=admin',
  `remember_token` varchar(255) DEFAULT NULL,
  `verification_token` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `department_id`, `mobile`, `photo`, `user_type`, `remember_token`, `verification_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'lyka', 'cagiuoa', 'lyka@gmail.com', '$2y$10$pPxoanU59Giukom19ln2qO/lYqyI.GfO4q72/dX5F2bZfmgbb1Yii', 0, '0123456789', NULL, 5, 'Eb4k7QkQy4UebB8m9rhrwzG2cMQoMpA5RL5qgqRzuuqrQZAYOusgwxtNJtoZ', '', '2016-10-30 00:00:00', '2024-09-08 20:42:23', 1),
(31, 'yas', 'yas', 'yas', '$2y$10$VLM2azld/fRbJ5inEq2fHOJpLlrT4adrBzhwDm0LjiBRwCzLuwfEq', 13, '54654687987987', NULL, 1, 'KHdIhYnZqCOFKnBO7QT4ErYRJpmVCA49RI2Gd6VJ7B9wUz5EKnHwr1cfKRg4', NULL, '2024-05-24 00:00:00', '2024-09-05 20:26:04', 1),
(32, 'lyy', 'lyy', 'lyy', '$2y$10$3PcER46KsYnhLp4ua8heuuLjCgrBqjoafVFwQl4wwagGChwyLhs4a', 14, '894849645132', NULL, 1, '5JMbMxtn0vaJRMyDGq3E6jHBd3iwP3FLqYej7m7p62NUs1MvpqYoXhRuO60Z', NULL, '2024-05-24 00:00:00', '2024-07-25 17:01:05', 1),
(33, 'daryl', 'daryl', 'daryl', '$2y$10$VgTuAKUYhePVwMqqLuIlTeGd4XrJuzw69OrddgSrpQUB5FlSj.qHu', 15, '654897984132168', NULL, 1, 'RKohiiXAS5InsF1UDYBoq7LWoY79F6lJeLdQsYL9wz8wnf1NxNrlIeP1LWdb', NULL, '2024-05-24 00:00:00', '2024-08-01 09:05:02', 1),
(34, 'tin', 'tin', 'tin', '$2y$10$saTb5GII.GMgoMUOn7FND.FVGFfuHiTNvQvkTaPqvaTQxsqyyXu.m', 16, '545', NULL, 1, '67qjaEnVms10ElwQDHht6VoT8tRzAjQmhOxA8ok45ISzCKD72HXJMPbGm3Dj', NULL, '2024-05-24 00:00:00', '2024-07-24 20:19:49', 1),
(35, 'gab', 'gab', 'gab', '$2y$10$FqGeeGerfgd8nUPUJjQywOP2WYmmAI/VFGr4O3412S/tMYFtLVX.G', 17, '5614251231', NULL, 1, 'x9zgvy3tAPRf2JkHoOcSMuuOrba9NJq0sQpyUjc4gYG6qqEEOncSj4222adG', NULL, '2024-05-24 00:00:00', '2024-07-24 20:17:15', 1),
(38, 'lyka2', 'lyka2', 'lyka2', '$2y$10$ZWaDyDvp80LptNLc2COWaeUjXNMaw3BAZ1ni0Wje75Ae392olGJcm', NULL, '000', NULL, 2, 'Jk64aqHSxl1Ee645b8zNiRmoYp6HgLjbzsK46lUOxM8BRZSaXMNkMm2oRd2P', NULL, '2024-09-03 00:00:00', '2024-09-03 20:00:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `display`
--
ALTER TABLE `display`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `display_custom`
--
ALTER TABLE `display_custom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_ads`
--
ALTER TABLE `image_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_setting`
--
ALTER TABLE `token_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `display`
--
ALTER TABLE `display`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `display_custom`
--
ALTER TABLE `display_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_ads`
--
ALTER TABLE `image_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `token_setting`
--
ALTER TABLE `token_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
