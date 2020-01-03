-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 03, 2020 at 03:37 PM
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
(10, 'amir', 1, '{\"username\":\"amir\",\"password\":\"63eefbd45d89e8c91f24b609f7539942\",\"createdAt\":\"2020-01-03 21:05:30\",\"table_name\":\"backend_users\"}', '3232260865');

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
(4, 'wedding', '2020-01-03 12:09:12', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `img` varchar(150) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL,
  `createdBy` int(10) UNSIGNED NOT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `productId` int(10) UNSIGNED NOT NULL,
  `categoryId` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Amir', '9833281227', 'Antop Hill Wadala', 'amir', 'infoamir225@gmail.com', '63eefbd45d89e8c91f24b609f7539942', '2020-01-03 21:05:30', '1', 1, '2020-01-03 17:48:00', 0, NULL, '1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

