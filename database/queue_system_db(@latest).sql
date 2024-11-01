-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 09:42 AM
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
(484, '11000', NULL, 22, 13, 33, NULL, 1, '2024-09-20 20:25:30', '2024-09-25 19:22:48', NULL, 1, 1),
(508, '22000', NULL, 14, 23, 32, NULL, 1, '2024-09-25 19:56:19', '2024-10-02 19:46:42', NULL, 1, 1),
(514, '44000', NULL, 16, 25, 34, NULL, 1, '2024-09-26 17:22:18', '2024-10-02 19:52:24', NULL, 1, 1),
(518, '33000', NULL, 15, 24, 33, NULL, 1, '2024-09-26 17:38:28', '2024-09-27 20:25:50', NULL, 1, 1),
(519, '44001', NULL, 16, 25, 34, NULL, 1, '2024-09-26 17:51:32', '2024-10-02 19:55:00', NULL, 1, 1),
(521, '11000', NULL, 13, 22, 31, NULL, 1, '2024-09-27 20:17:32', '2024-09-27 20:27:08', NULL, 1, 1),
(522, '11001', NULL, 13, 22, 31, NULL, 1, '2024-09-27 20:26:45', '2024-09-27 20:27:13', NULL, 1, 1),
(523, '11002', NULL, 13, 22, 31, NULL, 1, '2024-09-27 20:26:50', '2024-09-29 18:44:54', NULL, 1, 0),
(524, '11000', NULL, 13, 22, 31, NULL, 38, '2024-09-28 22:01:44', '2024-09-29 18:44:50', NULL, 1, 0),
(525, '22000', NULL, 14, 23, 32, NULL, 38, '2024-09-28 22:01:52', '2024-10-02 19:47:09', NULL, 1, 1),
(526, '33000', NULL, 15, 24, 33, NULL, 38, '2024-09-29 18:25:38', '2024-10-02 19:40:02', NULL, 1, 1),
(527, '66000', NULL, 18, 27, 39, NULL, 38, '2024-09-29 18:31:48', '2024-10-02 19:41:11', NULL, 1, 1),
(528, '55000', NULL, 17, 26, 35, NULL, 38, '2024-09-29 18:32:10', '2024-10-02 19:58:04', NULL, 1, 1),
(529, '11000', NULL, 13, 22, 31, NULL, 38, '2024-09-29 18:48:41', '2024-10-02 19:38:57', NULL, 1, 1),
(530, '11001', NULL, 13, 22, 31, NULL, 38, '2024-09-29 18:48:45', '2024-10-02 19:39:11', NULL, 1, 1),
(531, '11002', NULL, 13, 22, 31, NULL, 38, '2024-09-29 18:48:48', '2024-10-02 19:40:53', NULL, 1, 1),
(532, '11003', NULL, 13, 22, 31, NULL, 38, '2024-09-29 18:48:52', '2024-09-29 18:52:40', NULL, 2, 1),
(533, '55001', NULL, 17, 26, 35, NULL, 38, '2024-09-29 19:50:24', '2024-10-02 19:59:15', NULL, 1, 1),
(534, '11000', NULL, 13, 22, 31, NULL, 1, '2024-10-02 20:00:36', '2024-10-02 20:01:04', NULL, 1, 1),
(535, '11001', NULL, 13, 22, 31, NULL, 1, '2024-10-02 20:00:42', '2024-10-02 20:01:38', NULL, 1, 1),
(537, '55000', NULL, 17, 26, 35, NULL, 1, '2024-10-02 20:06:38', NULL, NULL, 2, 1),
(538, '44000', NULL, 16, 25, 34, NULL, 1, '2024-10-02 20:06:42', '2024-10-02 20:06:53', NULL, 1, 1),
(539, '22000', NULL, 14, 23, 32, NULL, 1, '2024-10-02 20:32:20', '2024-10-02 20:32:41', NULL, 1, 1),
(542, '11000', NULL, 13, 22, 31, NULL, 1, '2024-10-03 19:41:07', '2024-10-03 19:44:51', NULL, 1, 0),
(549, '66000', NULL, 18, 27, 39, NULL, 1, '2024-10-08 19:14:35', '2024-10-08 19:26:33', NULL, 1, 1),
(550, '55000', NULL, 17, 26, 35, NULL, 1, '2024-10-08 19:14:48', '2024-10-08 19:26:28', NULL, 1, 1),
(551, '11000', NULL, 13, 22, 31, NULL, 1, '2024-10-08 19:15:11', '2024-10-08 19:26:12', NULL, 1, 1),
(552, '22000', NULL, 14, 23, 32, NULL, 1, '2024-10-08 19:15:14', '2024-10-08 19:26:17', NULL, 1, 1),
(553, '44000', NULL, 16, 25, 34, NULL, 1, '2024-10-08 19:16:17', '2024-10-08 19:26:22', NULL, 1, 1),
(554, '66001', NULL, 18, 27, 39, NULL, 1, '2024-10-08 19:26:43', '2024-10-08 19:31:37', NULL, 1, 1),
(555, '11001', NULL, 13, 22, 31, NULL, 1, '2024-10-08 19:27:13', '2024-10-08 19:31:00', NULL, 1, 1),
(556, '22001', NULL, 14, 23, 32, NULL, 1, '2024-10-08 19:27:16', '2024-10-08 19:31:06', NULL, 1, 1),
(557, '33000', NULL, 15, 24, 33, NULL, 1, '2024-10-08 19:27:20', '2024-10-08 19:31:11', NULL, 1, 1),
(558, '55001', NULL, 17, 26, 35, NULL, 1, '2024-10-08 19:27:24', '2024-10-08 19:31:25', NULL, 1, 1),
(559, '55002', NULL, 17, 26, 35, NULL, 1, '2024-10-08 19:28:12', '2024-10-08 19:31:31', NULL, 1, 1),
(560, '44001', NULL, 16, 25, 34, NULL, 1, '2024-10-08 19:28:22', '2024-10-08 19:31:22', NULL, 1, 1),
(561, '33001', NULL, 15, 24, 33, NULL, 1, '2024-10-08 19:28:26', '2024-10-08 19:31:17', NULL, 1, 1),
(562, '66002', NULL, 18, 27, 39, NULL, 1, '2024-10-08 19:31:46', '2024-10-09 18:13:55', NULL, 1, 1),
(563, '55003', NULL, 17, 26, 35, NULL, 1, '2024-10-08 19:31:49', '2024-10-09 18:14:19', NULL, 1, 1),
(564, '44002', NULL, 16, 25, 34, NULL, 1, '2024-10-08 19:31:57', '2024-10-09 18:14:14', NULL, 1, 1),
(565, '33002', NULL, 15, 24, 33, NULL, 1, '2024-10-08 19:32:13', '2024-10-09 18:14:01', NULL, 1, 1),
(566, '22002', NULL, 14, 23, 32, NULL, 1, '2024-10-08 19:32:16', '2024-10-09 18:13:48', NULL, 1, 1),
(567, '66003', NULL, 18, 27, 39, NULL, 1, '2024-10-08 19:32:20', '2024-10-09 18:14:08', NULL, 1, 1),
(568, '44000', NULL, 16, 25, 34, NULL, 38, '2024-10-15 18:59:27', NULL, NULL, 0, 0),
(569, '44000', NULL, 16, 25, 34, NULL, 38, '2024-10-15 18:59:27', NULL, NULL, 0, 0),
(570, '44000', NULL, 16, 25, 34, NULL, 38, '2024-10-15 18:59:27', NULL, NULL, 0, 0),
(571, '44000', NULL, 16, 25, 34, NULL, 38, '2024-10-15 18:59:27', NULL, NULL, 0, 0),
(572, '22000', NULL, 14, 23, 32, NULL, 38, '2024-10-16 18:17:33', NULL, NULL, 0, 0),
(573, '11000', NULL, 13, 22, 31, NULL, 1, '2024-10-28 21:43:03', NULL, NULL, 0, 0),
(574, '11001', NULL, 13, 22, 31, NULL, 1, '2024-10-28 21:43:11', NULL, NULL, 0, 0),
(575, '11002', NULL, 13, 22, 31, NULL, 1, '2024-10-28 21:43:16', NULL, NULL, 0, 0),
(576, '11003', NULL, 13, 22, 31, NULL, 1, '2024-10-28 21:43:21', NULL, NULL, 0, 0),
(577, '11000', NULL, 13, 22, 31, NULL, 1, '2024-10-29 20:25:17', NULL, NULL, 0, 0),
(578, '66000', NULL, 18, 27, 39, NULL, 1, '2024-10-29 20:25:22', NULL, NULL, 0, 0),
(579, '11000', NULL, 13, 22, 31, NULL, 1, '2024-11-01 16:37:24', NULL, NULL, 0, 0),
(580, '33000', NULL, 15, 24, 33, NULL, 1, '2024-11-01 16:37:40', NULL, NULL, 0, 0),
(581, '44000', NULL, 16, 25, 34, NULL, 1, '2024-11-01 16:37:43', NULL, NULL, 0, 0),
(582, '55000', NULL, 17, 26, 35, NULL, 1, '2024-11-01 16:37:47', NULL, NULL, 0, 0),
(583, '66000', NULL, 18, 27, 39, NULL, 1, '2024-11-01 16:37:50', NULL, NULL, 0, 0);

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
(32, 18, 27, 39, '2024-09-27 19:41:50', NULL, 1);

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
(1, 'lyka', 'cagiuoa', 'lyka@gmail.com', '$2y$10$jaR7QRjVY7zCMvHxaeQSUOqZjHBmpIrJVhZESYkADASnJCe39.TOu', 0, '0123456789', NULL, 5, 'oQqs8oeuy3SoMSDPQ2mIxBec6JMns1gYN1BMTl1ianwqj2wIBm52KofIAvsC', '', '2024-10-03 18:00:16', '2024-10-28 21:23:13', 1),
(31, 'yas', 'yas', 'yas', '$2y$10$VLM2azld/fRbJ5inEq2fHOJpLlrT4adrBzhwDm0LjiBRwCzLuwfEq', 13, '54654687987987', NULL, 1, 'eK2k1m48fskx1CuSbJVvF4uzUNw5XR9LFxUSUqP2get9CUJhN2bwnCyas0eV', NULL, '2024-05-24 00:00:00', '2024-10-08 20:16:59', 1),
(32, 'lyy', 'lyy', 'lyy', '$2y$10$3PcER46KsYnhLp4ua8heuuLjCgrBqjoafVFwQl4wwagGChwyLhs4a', 14, '894849645132', NULL, 1, '5JMbMxtn0vaJRMyDGq3E6jHBd3iwP3FLqYej7m7p62NUs1MvpqYoXhRuO60Z', NULL, '2024-05-24 00:00:00', '2024-07-25 17:01:05', 1),
(33, 'daryl', 'daryl', 'daryl', '$2y$10$VgTuAKUYhePVwMqqLuIlTeGd4XrJuzw69OrddgSrpQUB5FlSj.qHu', 15, '654897984132168', NULL, 1, 'CYlKUv19O7Ffsqn4yfRjHQX3cgHWhEuqUpjEU7acxwc1q4NEhAUylGVzx2pS', NULL, '2024-05-24 00:00:00', '2024-10-03 19:39:48', 1),
(34, 'tin', 'tin', 'tin', '$2y$10$saTb5GII.GMgoMUOn7FND.FVGFfuHiTNvQvkTaPqvaTQxsqyyXu.m', 16, '545', NULL, 1, '67qjaEnVms10ElwQDHht6VoT8tRzAjQmhOxA8ok45ISzCKD72HXJMPbGm3Dj', NULL, '2024-05-24 00:00:00', '2024-07-24 20:19:49', 1),
(35, 'gab', 'gab', 'gab', '$2y$10$FqGeeGerfgd8nUPUJjQywOP2WYmmAI/VFGr4O3412S/tMYFtLVX.G', 17, '5614251231', NULL, 1, 'x9zgvy3tAPRf2JkHoOcSMuuOrba9NJq0sQpyUjc4gYG6qqEEOncSj4222adG', NULL, '2024-05-24 00:00:00', '2024-07-24 20:17:15', 1),
(38, 'lyka2', 'lyka2', 'lyka2', '$2y$10$ZWaDyDvp80LptNLc2COWaeUjXNMaw3BAZ1ni0Wje75Ae392olGJcm', NULL, '000', NULL, 2, 'WMkr3utCK6Q3ATSDDYwB10DuvHDedBNlB0xB4WSN9JuweMVeVPtTqfUHV9fr', NULL, '2024-09-03 00:00:00', '2024-10-16 18:17:41', 1),
(39, 'test', 'test', 'test@gmail.com', '$2y$10$GKVFoJqgWagokYdVChZkWe9SEYndmL5KRwJ8KJGt29VeRzZhr6wyG', 18, '0000', NULL, 1, NULL, NULL, '2024-09-26 00:00:00', NULL, 1);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=584;

--
-- AUTO_INCREMENT for table `token_setting`
--
ALTER TABLE `token_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
