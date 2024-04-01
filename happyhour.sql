-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 11:19 PM
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
-- Database: `happyhour`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `role` varchar(50) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `created_at`, `is_active`, `role`, `last_login`, `reset_token`) VALUES
(1, 'Graham Olusiekwin', 'olusiekwingraham@gmail.com', 'laravel_user', '1234', '2024-03-18 09:52:17', 1, 'admin', NULL, NULL),
(2, 'Graham Olusiekwin', 'olusiekwingraham@gmail.com', 'laravel_user', '1234', '2024-03-18 09:53:31', 1, 'vendor', NULL, NULL),
(5, 'George Mandi', 'Geoge@gmail.com', 'George', 'George123', '2024-03-25 12:53:21', 1, 'Admin', NULL, NULL),
(6, 'John Doe', 'john.doe@example.com', 'john_doe', 'password123', '2024-03-25 12:55:53', 1, 'vendor', NULL, NULL),
(7, 'Emily Smith', 'emily.smith@example.com', 'emily_smith', 'password456', '2024-03-25 12:57:01', 1, 'User', NULL, NULL),
(8, 'Michael Johnson', 'michael.johnson@example.com', 'michael_johnson', 'password789', '2024-03-25 12:57:01', 1, 'User', NULL, NULL),
(9, 'Emma Brown', 'emma.brown@example.com', 'emma_brown', 'passwordabc', '2024-03-25 12:57:01', 1, 'vendor', NULL, NULL),
(10, 'James Wilson', 'james.wilson@example.com', 'james_wilson', 'passworddef', '2024-03-25 12:57:01', 1, 'User', NULL, NULL),
(11, 'Sophia Taylor', 'sophia.taylor@example.com', 'sophia_taylor', 'passwordghi', '2024-03-25 12:57:01', 1, 'admin', NULL, NULL),
(12, 'William Anderson', 'william.anderson@example.com', 'william_anderson', 'passwordjkl', '2024-03-25 12:57:47', 1, 'vendor', NULL, NULL),
(13, 'Olivia Martinez', 'olivia.martinez@example.com', 'olivia_martinez', 'passwordmno', '2024-03-25 12:57:47', 1, 'vendor', NULL, NULL),
(14, 'Noah Harris', 'noah.harris@example.com', 'noah_harris', 'passwordpqr', '2024-03-25 12:57:47', 1, 'vendor', NULL, NULL),
(15, 'Ava Clark', 'ava.clark@example.com', 'ava_clark', 'passwordstu', '2024-03-25 12:57:47', 1, 'admin', NULL, NULL),
(16, 'Graham Barasa', 'Barasa.Gramm@happyhourdrinks.app', 'Grammhappyhour', '$2y$10$QRYpNb.BBz2iWcKQ8CW7celilkEpd6fpQL2B5bx2VxS51RK72S1c2', '2024-03-31 21:57:50', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `products_offered` text DEFAULT NULL,
  `performance_metrics` text DEFAULT NULL,
  `contract_status` enum('Pending','Active','Inactive') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_email`, `phone_number`, `address`, `store_name`, `products_offered`, `performance_metrics`, `contract_status`, `created_at`) VALUES
(1, 'Graham Olusiekwin', 'olusiekwingraham@gmail.com', '23345656', '33456753442', 'KKKK', 'LLLLLL', 'LLLL', 'Inactive', '2024-03-18 09:53:31'),
(2, 'John Doe', 'john.doe@example.com', '', '', '', '', '', '', '2024-03-25 12:55:53'),
(3, 'Emma Brown', 'emma.brown@example.com', '', '', '', '', '', '', '2024-03-25 12:57:01'),
(4, 'William Anderson', 'william.anderson@example.com', '', '', '', '', '', '', '2024-03-25 12:57:47'),
(5, 'Olivia Martinez', 'olivia.martinez@example.com', '', '', '', '', '', '', '2024-03-25 12:57:47'),
(6, 'Noah Harris', 'noah.harris@example.com', '', '', '', '', '', '', '2024-03-25 12:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
