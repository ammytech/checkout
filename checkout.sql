-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 06, 2020 at 08:53 AM
-- Server version: 5.7.28
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkout`
--

-- --------------------------------------------------------

--
-- Table structure for table `backend_logs`
--

CREATE TABLE `backend_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `description` text,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_logs`
--

INSERT INTO `backend_logs` (`id`, `name`, `uid`, `description`, `ip_address`) VALUES
(1, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 20:59:45\",\"table_name\":\"backend_users\"}', '3232260865'),
(2, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:00:15\",\"table_name\":\"backend_users\"}', '3232260865'),
(3, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:00:37\",\"table_name\":\"backend_users\"}', '3232260865'),
(4, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-03 21:01:30\",\"table_name\":\"backend_users\"}', '3232260865'),
(5, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-03 21:01:46\",\"table_name\":\"backend_users\"}', '3232260865'),
(6, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-03 21:02:16\",\"table_name\":\"backend_users\"}', '3232260865'),
(7, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-03 21:02:29\",\"table_name\":\"backend_users\"}', '3232260865'),
(8, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:02:46\",\"table_name\":\"backend_users\"}', '3232260865'),
(9, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:04:04\",\"table_name\":\"backend_users\"}', '3232260865'),
(10, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:05:30\",\"table_name\":\"backend_users\"}', '3232260865'),
(11, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:15:08\",\"table_name\":\"backend_users\"}', '3232260865'),
(12, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:37:28\",\"table_name\":\"backend_users\"}', '3232260865'),
(13, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:38:32\",\"table_name\":\"backend_users\"}', '3232260865'),
(14, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:39:22\",\"table_name\":\"backend_users\"}', '3232260865'),
(15, 'Amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:40:02\",\"table_name\":\"backend_users\"}', '3232260865'),
(16, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 01:27:36\",\"table_name\":\"backend_users\"}', '3232260865'),
(17, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:06:13\",\"table_name\":\"backend_users\"}', '2886991873'),
(18, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:06:50\",\"table_name\":\"backend_users\"}', '2886991873'),
(19, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:07:19\",\"table_name\":\"backend_users\"}', '2886991873'),
(20, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:11:41\",\"table_name\":\"backend_users\"}', '3232260865'),
(21, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:11:52\",\"table_name\":\"backend_users\"}', '2886991873'),
(22, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:12:25\",\"table_name\":\"backend_users\"}', '2886991873'),
(23, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:13:14\",\"table_name\":\"backend_users\"}', '2886991873'),
(24, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:13:39\",\"table_name\":\"backend_users\"}', '2886991873'),
(25, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:15:02\",\"table_name\":\"backend_users\"}', '2886991873'),
(26, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:15:37\",\"table_name\":\"backend_users\"}', '2886991873'),
(27, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:16:26\",\"table_name\":\"backend_users\"}', '2886991873'),
(28, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:17:04\",\"table_name\":\"backend_users\"}', '2886991873'),
(29, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:17:19\",\"table_name\":\"backend_users\"}', '2886991873'),
(30, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:19:51\",\"table_name\":\"backend_users\"}', '2886991873'),
(31, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:20:24\",\"table_name\":\"backend_users\"}', '2886991873'),
(32, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:21:42\",\"table_name\":\"backend_users\"}', '2886991873'),
(33, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:22:01\",\"table_name\":\"backend_users\"}', '2886991873'),
(34, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:22:25\",\"table_name\":\"backend_users\"}', '2886991873'),
(35, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:25:59\",\"table_name\":\"backend_users\"}', '2886991873'),
(36, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:26:30\",\"table_name\":\"backend_users\"}', '2886991873'),
(37, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:27:07\",\"table_name\":\"backend_users\"}', '2886991873'),
(38, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-04 02:29:34\",\"table_name\":\"backend_users\"}', '2886991873'),
(39, '', 0, '{\"username\":\"amir\",\"password\":\"470d1ee40a8f7af398de717c8c0c5ff7\",\"createdAt\":\"2020-01-04 02:29:54\",\"table_name\":\"backend_users\"}', '2886991873'),
(40, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:30:05\",\"table_name\":\"backend_users\"}', '2886991873'),
(41, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:38:36\",\"table_name\":\"backend_users\"}', '2886991873'),
(42, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:39:11\",\"table_name\":\"backend_users\"}', '2886991873'),
(43, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:39:58\",\"table_name\":\"backend_users\"}', '2886991873'),
(44, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:40:35\",\"table_name\":\"backend_users\"}', '2886991873'),
(45, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:40:51\",\"table_name\":\"backend_users\"}', '2886991873'),
(46, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 02:41:36\",\"table_name\":\"backend_users\"}', '2886991873'),
(47, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 03:11:06\",\"table_name\":\"backend_users\"}', '2886991873'),
(48, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 03:11:29\",\"table_name\":\"backend_users\"}', '2886991873'),
(49, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 03:14:19\",\"table_name\":\"backend_users\"}', '3232260865'),
(50, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 11:11:13\",\"table_name\":\"backend_users\"}', '2886991873'),
(51, 'Amir', 1, '{\"status\":\"0\",\"table_name\":\"category\"}', '3232260865'),
(52, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"category\"}', '3232260865'),
(53, 'Amir', 1, '{\"status\":\"0\",\"table_name\":\"category\"}', '3232260865'),
(54, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"category\"}', '3232260865'),
(55, 'Amir', 1, '{\"name\":\"testing1\",\"updatedAt\":\"2020-01-04 13:51:58\",\"table_name\":\"category\"}', '3232260865'),
(56, 'Amir', 1, '{\"status\":\"0\",\"table_name\":\"category\"}', '3232260865'),
(57, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"category\"}', '3232260865'),
(58, 'Amir', 1, '{\"name\":\"testing22\",\"updatedAt\":\"2020-01-04 13:52:30\",\"table_name\":\"category\"}', '3232260865'),
(59, 'Amir', 1, '{\"img\":\"2020\\/01\\/greeting-card_500x400.jpg\",\"title\":\"new year greeting cards 2020\",\"slug\":\"new-year-greeting-cards-2020\",\"summary\":\"new year greeting cards 2020\",\"description\":\"<p>new year greeting cards 2020<\\/p>\",\"price\":\"22.00\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-04 14:01:10\",\"table_name\":\"product\"}', '3232260865'),
(60, 'Amir', 1, '{\"img\":\"2020\\/01\\/greeting-card_500x400.jpg\",\"title\":\"new year greeting cards 20201\",\"slug\":\"new-year-greeting-cards-2020\",\"summary\":\"new year greeting cards 20201\",\"description\":\"<p>new year greeting cards 2020<\\/p>\",\"price\":\"22.00\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-04 14:01:40\",\"table_name\":\"product\"}', '3232260865'),
(61, 'Amir', 1, '{\"img\":\"2020\\/01\\/greeting-card_500x400.jpg\",\"title\":\"new year greeting cards 2020\",\"slug\":\"new-year-greeting-cards-2020\",\"summary\":\"new year greeting cards 2020\",\"description\":\"<p>new year greeting cards 2020<\\/p>\",\"price\":\"22.00\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-04 14:01:45\",\"table_name\":\"product\"}', '3232260865'),
(62, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"product\"}', '3232260865'),
(63, 'Amir', 1, '{\"img\":\"2020\\/01\\/greeting-card_500x400.jpg\",\"title\":\"new year greeting cards 2020\",\"slug\":\"new-year-greeting-cards-2020\",\"summary\":\"new year greeting cards 2020\",\"description\":\"<p>new year greeting cards 2020<\\/p>\",\"price\":\"22.00\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-04 14:01:54\",\"table_name\":\"product\"}', '3232260865'),
(64, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 14:41:51\",\"table_name\":\"backend_users\"}', '3232260865'),
(65, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 19:49:27\",\"table_name\":\"backend_users\"}', '2886991873'),
(66, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-04 19:52:34\",\"table_name\":\"backend_users\"}', '3232260865'),
(67, 'Amir', 1, '{\"name\":\"testing2\",\"updatedAt\":\"2020-01-04 19:56:18\",\"table_name\":\"category\"}', '3232260865'),
(68, 'Amir', 1, '{\"status\":\"0\",\"table_name\":\"category\"}', '3232260865'),
(69, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"category\"}', '3232260865'),
(70, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 00:10:55\",\"table_name\":\"backend_users\"}', '2886991873'),
(71, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"product\"}', '3232260865'),
(72, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 09:41:40\",\"table_name\":\"backend_users\"}', '2886991873'),
(73, 'Amir', 1, '{\"name\":\"testing22\",\"updatedAt\":\"2020-01-05 09:54:01\",\"table_name\":\"category\"}', '3232260865'),
(74, '', 0, '{\"username\":\"\",\"password\":\"\",\"createdAt\":\"2020-01-05 13:22:28\",\"table_name\":\"backend_users\"}', '2886991873'),
(75, '', 0, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 13:25:03\",\"table_name\":\"backend_users\"}', '2886991873'),
(76, '', 0, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 14:06:04\",\"table_name\":\"backend_users\"}', '2886991873'),
(77, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 14:07:26\",\"table_name\":\"backend_users\"}', '2886991873'),
(78, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 14:07:58\",\"table_name\":\"backend_users\"}', '2886991873'),
(79, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 14:13:27\",\"table_name\":\"backend_users\"}', '2886991873'),
(80, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 14:13:56\",\"table_name\":\"backend_users\"}', '2886991873'),
(81, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:06:03\",\"table_name\":\"backend_users\"}', '2886991873'),
(82, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:07:08\",\"table_name\":\"backend_users\"}', '2886991873'),
(83, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:07:58\",\"table_name\":\"backend_users\"}', '2886991873'),
(84, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:09:50\",\"table_name\":\"backend_users\"}', '2886991873'),
(85, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:10:36\",\"table_name\":\"backend_users\"}', '2886991873'),
(86, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:11:00\",\"table_name\":\"backend_users\"}', '2886991873'),
(87, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:11:35\",\"table_name\":\"backend_users\"}', '2886991873'),
(88, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:13:22\",\"table_name\":\"backend_users\"}', '2886991873'),
(89, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:49:05\",\"table_name\":\"backend_users\"}', '2886991873'),
(90, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:50:57\",\"table_name\":\"backend_users\"}', '2886991873'),
(91, 'eaglecrystal24@gmail.com', 4, '{\"username\":\"eaglecrystal24@gmail.com\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 19:52:06\",\"table_name\":\"backend_users\"}', '2886991873'),
(92, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-05 20:29:56\",\"table_name\":\"backend_users\"}', '2886991873'),
(93, 'Amir', 1, '{\"status\":\"1\",\"table_name\":\"product\"}', '3232260865'),
(94, '', 0, '{\"username\":\"amir\",\"password\":\"c415397d9382f8d187825c098d3385ea\",\"createdAt\":\"2020-01-06 11:09:43\",\"table_name\":\"backend_users\"}', '2886991873'),
(95, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-06 11:09:47\",\"table_name\":\"backend_users\"}', '2886991873'),
(96, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-06 11:11:09\",\"table_name\":\"backend_users\"}', '2886991873'),
(97, 'Amir', 1, '{\"title\":\"calendar 2020\",\"slug\":\"calendar-2020\",\"summary\":\"calendar 2020\",\"description\":\"<p>calendar 2020<\\/p>\",\"price\":\"30.00\",\"price_rules\":\"{\\\"quantity\\\":3,\\\"discount\\\":15}\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-06 11:01:51\",\"table_name\":\"product\"}', '3232260865'),
(98, '', 0, '{\"username\":\"amir\",\"password\":\"c415397d9382f8d187825c098d3385ea\",\"createdAt\":\"2020-01-06 13:50:13\",\"table_name\":\"backend_users\"}', '2886991873'),
(99, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-06 13:50:16\",\"table_name\":\"backend_users\"}', '2886991873'),
(100, 'Amir', 1, '{\"title\":\"calendar 2020\",\"slug\":\"calendar-2020\",\"summary\":\"calendar 2020\",\"description\":\"<p>calendar 2020<\\/p>\",\"price\":\"30.00\",\"price_rules\":\"{\\\"multiItemSelectDiscount\\\":{\\\"quantity\\\":3,\\\"discount\\\":15}}\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-06 13:01:54\",\"table_name\":\"product\"}', '3232260865'),
(101, 'Amir', 1, '{\"title\":\"new year greeting cards 2020\",\"slug\":\"new-year-greeting-cards-2020\",\"summary\":\"new year greeting cards 2020\",\"description\":\"<p>new year greeting cards 2020<\\/p>\",\"price\":\"22.00\",\"price_rules\":\"{\\\"multiItemSelectDiscount\\\":{\\\"quantity\\\":2,\\\"discount\\\":10}}\",\"updatedBy\":\"1\",\"updatedAt\":\"2020-01-06 13:01:53\",\"table_name\":\"product\"}', '3232260865');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 'posters', '2020-01-03 12:01:14', '2020-01-03 17:38:25', '1'),
(2, 'photo book', '2020-01-03 12:01:49', '2020-01-03 17:37:39', '1'),
(3, 'calendar', '2020-01-03 12:07:27', NULL, '1'),
(4, 'wedding', '2020-01-03 12:09:12', NULL, '1'),
(5, 'testing1', '2020-01-04 07:05:09', '2020-01-04 13:51:58', '1'),
(6, 'testing22', '2020-01-04 08:22:16', '2020-01-05 09:54:01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `createdAt`) VALUES
(1, 4, '2020-01-05 14:42:13'),
(2, 4, '2020-01-05 14:46:41'),
(3, 4, '2020-01-05 14:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` double NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderId`, `productId`, `quantity`, `price`, `createdAt`, `status`) VALUES
(1, 1, 2, 1, 30, '2020-01-05 14:42:13', 0),
(2, 2, 1, 1, 22, '2020-01-05 14:46:41', 0),
(3, 3, 2, 1, 30, '2020-01-05 14:48:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(110) NOT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `description` text,
  `price` double(12,2) DEFAULT NULL,
  `price_rules` varchar(300) DEFAULT NULL,
  `img` varchar(150) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `createdBy` int(10) UNSIGNED NOT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `slug`, `summary`, `description`, `price`, `price_rules`, `img`, `createdAt`, `updatedAt`, `status`, `createdBy`, `updatedBy`) VALUES
(1, 'new year greeting cards 2020', 'new-year-greeting-cards-2020', 'new year greeting cards 2020', '<p>new year greeting cards 2020</p>', 22.00, '{\"multiItemSelectDiscount\":{\"quantity\":2,\"discount\":10}}', '2020/01/greeting-card_500x400.jpg', '2020-01-04 13:01:36', '2020-01-06 13:01:53', '1', 1, 1),
(2, 'calendar 2020', 'calendar-2020', 'calendar 2020', '<p>calendar 2020</p>', 30.00, '{\"multiItemSelectDiscount\":{\"quantity\":3,\"discount\":15}}', '2020/01/battlw-grounds_500x400.PNG', '2020-01-05 00:01:37', '2020-01-06 13:01:54', '1', 1, 1),
(3, 'posters', 'posters', 'posters', '<p>posters</p>', 35.00, NULL, '2020/01/brawl_500x400.PNG', '2020-01-05 20:01:47', NULL, '1', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `productId` int(10) UNSIGNED NOT NULL,
  `categoryId` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`productId`, `categoryId`) VALUES
(1, 5),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `status` enum('1','0','-1') DEFAULT '0',
  `userTypeId` tinyint(3) UNSIGNED DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `ipAddress` int(10) UNSIGNED NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `address`, `username`, `email`, `password`, `lastLogin`, `status`, `userTypeId`, `createdAt`, `ipAddress`, `updatedAt`, `isActive`) VALUES
(1, 'Amir', NULL, 'Antop Hill Wadala', 'amir', 'infoamir225@gmail.com', '63eefbd45d89e8c91f24b609f7539942', '2020-01-06 13:50:16', '1', 1, '2020-01-03 17:48:00', 0, NULL, '1'),
(4, 'siteuser', '9833281227', 'kurla', 'eaglecrystal24@gmail.com', 'eaglecrystal24@gmail.com', '63eefbd45d89e8c91f24b609f7539942', '2020-01-05 19:52:06', '1', 2, '2020-01-05 14:05:44', 3232260865, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `roleType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `roleType`) VALUES
(1, 'admin'),
(2, 'site_user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backend_logs`
--
ALTER TABLE `backend_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `usertid_idx` (`userTypeId`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_utype` (`roleType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backend_logs`
--
ALTER TABLE `backend_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usertid` FOREIGN KEY (`userTypeId`) REFERENCES `user_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

