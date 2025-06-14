-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 11:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chronosync`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_amount`) VALUES
(1, NULL, '2025-06-09 20:50:32', 176996.00),
(2, NULL, '2025-06-09 21:38:42', 42000.00),
(3, NULL, '2025-06-09 21:56:06', 158850.00),
(4, NULL, '2025-06-09 22:03:25', 84000.00),
(5, NULL, '2025-06-09 22:10:05', 254850.00),
(6, NULL, '2025-06-09 22:11:38', 54999.00),
(7, NULL, '2025-06-09 22:12:09', 36850.00),
(8, NULL, '2025-06-09 22:12:41', 38000.00),
(9, NULL, '2025-06-09 22:13:07', 36850.00),
(10, NULL, '2025-06-09 22:21:54', 42000.00),
(11, NULL, '2025-06-09 23:19:39', 42000.00),
(12, NULL, '2025-06-09 23:40:42', 147400.00),
(13, NULL, '2025-06-09 23:41:38', 57998.00),
(14, NULL, '2025-06-10 00:00:09', 38000.00),
(15, NULL, '2025-06-10 00:48:12', 168000.00),
(16, NULL, '2025-06-10 07:59:19', 56000.00),
(17, NULL, '2025-06-10 21:36:10', 28000.00),
(18, NULL, '2025-06-12 09:21:03', 16000.00),
(19, NULL, '2025-06-13 00:55:54', 38000.00),
(20, NULL, '2025-06-14 11:06:41', 104850.00),
(21, NULL, '2025-06-14 11:10:08', 38000.00),
(22, NULL, '2025-06-14 11:17:18', 68000.00),
(23, NULL, '2025-06-14 11:23:57', 110000.00),
(24, NULL, '2025-06-14 11:27:56', 75000.00),
(25, NULL, '2025-06-14 16:34:03', 188850.00),
(26, NULL, '2025-06-14 16:35:48', 42000.00),
(27, NULL, '2025-06-14 17:11:30', 42000.00),
(28, NULL, '2025-06-14 17:12:18', 42000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
