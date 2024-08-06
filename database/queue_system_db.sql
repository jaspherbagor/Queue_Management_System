-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 03:04 PM
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
(26, '5', 'completion', '2024-05-24', NULL, 1);

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
(17, 'Completion Form', 'completion', '5', '2024-05-24 08:56:28', NULL, 1);

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
(390, '11000', NULL, 13, 22, 31, NULL, 1, '2024-07-24 20:05:10', '2024-07-24 20:15:13', NULL, 1, 0),
(391, '33000', NULL, 15, 24, 33, NULL, 1, '2024-07-24 20:05:15', '2024-07-24 20:20:24', NULL, 1, 0),
(392, '44000', NULL, 16, 25, 34, NULL, 1, '2024-07-24 20:05:42', '2024-08-05 19:08:28', NULL, 1, 1),
(394, '22000', NULL, 14, 23, 32, NULL, 1, '2024-07-24 20:05:50', '2024-07-24 20:17:34', NULL, 1, 0),
(395, '33001', NULL, 15, 24, 33, NULL, 1, '2024-07-24 20:05:54', '2024-07-24 20:20:06', NULL, 1, 0),
(396, '44001', NULL, 16, 25, 34, NULL, 1, '2024-07-24 20:13:28', '2024-07-24 20:19:35', NULL, 1, 0),
(397, '11001', NULL, 13, 22, 31, NULL, 1, '2024-07-24 20:13:33', '2024-07-24 20:14:12', NULL, 1, 0),
(398, '11002', NULL, 13, 22, 31, NULL, 28, '2024-07-24 20:16:02', '2024-07-24 20:16:26', NULL, 1, 0),
(399, '11003', NULL, 13, 22, 31, NULL, 28, '2024-07-24 20:16:34', '2024-07-24 20:22:36', NULL, 1, 0),
(400, '22001', NULL, 14, 23, 32, NULL, 28, '2024-07-24 20:17:42', '2024-07-24 20:31:59', NULL, 1, 0),
(401, '33002', NULL, 15, 24, 33, NULL, 28, '2024-07-24 20:20:52', '2024-07-24 20:31:18', NULL, 1, 0),
(402, '11004', NULL, 13, 22, 31, NULL, 28, '2024-07-24 20:21:25', '2024-07-24 20:29:45', NULL, 1, 0),
(404, '22002', NULL, 14, 23, 32, NULL, 28, '2024-07-24 20:30:23', '2024-07-24 20:32:25', NULL, 1, 0),
(405, '33003', NULL, 15, 24, 33, NULL, 28, '2024-07-24 20:31:04', '2024-08-05 19:08:41', NULL, 1, 1),
(407, '11000', NULL, 13, 22, 31, NULL, 1, '2024-08-05 19:11:55', '2024-08-05 19:17:53', NULL, 1, 1),
(408, '11001', NULL, 13, 22, 31, NULL, 1, '2024-08-05 19:12:05', '2024-08-05 19:28:48', NULL, 1, 1),
(410, '22000', NULL, 15, 24, 33, NULL, 1, '2024-08-05 19:12:18', NULL, NULL, 0, 0),
(411, '33000', NULL, 15, 24, 33, NULL, 1, '2024-08-05 19:12:23', NULL, NULL, 0, 0),
(412, '33001', NULL, 15, 24, 33, NULL, 1, '2024-08-05 19:29:52', NULL, NULL, 0, 0);

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
(29, 17, 26, 35, '2024-05-24 08:58:23', NULL, 1);

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
(1, 'lyka', 'cagiuoa', 'lyka@gmail.com', '$2y$10$pPxoanU59Giukom19ln2qO/lYqyI.GfO4q72/dX5F2bZfmgbb1Yii', 0, '0123456789', NULL, 5, 'znCV6bhKbb1dGKiwnnlJssewcGmTgfyNXUyXxrdSTXBjo7q1WvnqfEaXZ2y1', '', '2016-10-30 00:00:00', '2024-08-05 19:55:33', 1),
(28, 'lyka2', 'lyka2', 'lyka2', '$2y$10$kB2r7a6Gh4euo.v7zkAM0usi2J91Y6Bb/hBj7/EDPTp0K9GODP7PS', NULL, '2165468978798', NULL, 2, 'H7OWbR4mD5LDpW03Ve83H7PV8TyU97z6AKQASOCaV7EVM9FafnKBVAZ0J8u9', NULL, '2024-05-22 00:00:00', '2024-07-25 17:33:02', 1),
(31, 'yas', 'yas', 'yas', '$2y$10$VLM2azld/fRbJ5inEq2fHOJpLlrT4adrBzhwDm0LjiBRwCzLuwfEq', 13, '54654687987987', NULL, 1, 'BLJ341cslKEeXE6Lebkxkj6mRn12uGdQEZN2WtR3MrPySp98TtlOv2JM6XTr', NULL, '2024-05-24 00:00:00', '2024-07-24 20:30:39', 1),
(32, 'lyy', 'lyy', 'lyy', '$2y$10$3PcER46KsYnhLp4ua8heuuLjCgrBqjoafVFwQl4wwagGChwyLhs4a', 14, '894849645132', NULL, 1, '5JMbMxtn0vaJRMyDGq3E6jHBd3iwP3FLqYej7m7p62NUs1MvpqYoXhRuO60Z', NULL, '2024-05-24 00:00:00', '2024-07-25 17:01:05', 1),
(33, 'daryl', 'daryl', 'daryl', '$2y$10$VgTuAKUYhePVwMqqLuIlTeGd4XrJuzw69OrddgSrpQUB5FlSj.qHu', 15, '654897984132168', NULL, 1, 'RKohiiXAS5InsF1UDYBoq7LWoY79F6lJeLdQsYL9wz8wnf1NxNrlIeP1LWdb', NULL, '2024-05-24 00:00:00', '2024-08-01 09:05:02', 1),
(34, 'tin', 'tin', 'tin', '$2y$10$saTb5GII.GMgoMUOn7FND.FVGFfuHiTNvQvkTaPqvaTQxsqyyXu.m', 16, '545', NULL, 1, '67qjaEnVms10ElwQDHht6VoT8tRzAjQmhOxA8ok45ISzCKD72HXJMPbGm3Dj', NULL, '2024-05-24 00:00:00', '2024-07-24 20:19:49', 1),
(35, 'gab', 'gab', 'gab', '$2y$10$FqGeeGerfgd8nUPUJjQywOP2WYmmAI/VFGr4O3412S/tMYFtLVX.G', 17, '5614251231', NULL, 1, 'x9zgvy3tAPRf2JkHoOcSMuuOrba9NJq0sQpyUjc4gYG6qqEEOncSj4222adG', NULL, '2024-05-24 00:00:00', '2024-07-24 20:17:15', 1);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `token_setting`
--
ALTER TABLE `token_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
