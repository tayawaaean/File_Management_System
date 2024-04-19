-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 06:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_management_system_bingao`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `Author`, `job_title`, `DateTime`, `Action`, `Description`) VALUES
(1, 'Aean Gabrielle Tayawa', 'Admin', '2024-04-17 00:38:17', 'New User Approved', 'Dexter John Perdido'),
(2, 'Dexter John Perdido', 'User', '2024-04-17 18:38:17', 'Document Deleted', 'MMSU Waiver.docx'),
(3, 'Kenric Catiwa', 'User', '2024-04-17 18:43:14', 'Document Upload', 'Ma\'am Abbie Assignment.pdf'),
(4, 'Dexter John Perdido', 'User', '2024-04-09 00:43:14', 'Document Deleted', 'MMSU Waiver.docx'),
(5, 'Dexter John Perdido', 'User', '2024-04-08 00:43:14', 'Document Deleted', 'MMSU Waiver1.docx'),
(6, 'Dexter John Perdido', 'User', '2024-04-08 00:43:14', 'Document Deleted', 'MMSU Waiver2.docx'),
(7, 'Dexter John Perdido', 'User', '2024-04-01 00:43:14', 'Document Deleted', 'MMSU Waiver.docx'),
(8, 'Aean Gabrielle Tayawa', 'Admin', '2024-04-17 00:38:17', 'New User Approved', 'Kenric Catiwa'),
(9, 'Kenric Catiwa', 'User', '2024-04-17 18:43:14', 'Document Upload', 'Ma\'am Dianna Assignment.pdf'),
(10, 'Aean Gabrielle Tayawa', 'Admin', '2024-04-17 00:38:17', 'New User Approved', 'Dexter John Perdido'),
(11, 'Aean Gabrielle Tayawa', 'Admin', '2024-04-17 00:38:17', 'New User Approved', 'Dexter John Perdido'),
(12, 'Aean Gabrielle Tayawa', 'Admin', '2024-03-13 00:38:17', 'New User Approved', 'Dexter John Perdido'),
(13, 'Dexter John Perdido', 'User', '2024-02-12 18:38:17', 'Document Deleted', 'MMSU Waiver.docx'),
(14, 'Kenric Catiwa', 'User', '2023-12-06 18:43:14', 'Document Upload', 'Ma\'am Abbie Assignment.pdf'),
(15, 'Aean Gabrielle Tayawa', 'Admin', '2023-10-17 00:38:17', 'New User Approved', 'Kenric Catiwa');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests`
--

CREATE TABLE `pending_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sent_files`
--

CREATE TABLE `sent_files` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` text NOT NULL,
  `address` text NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department` varchar(128) NOT NULL,
  `company` varchar(128) NOT NULL,
  `current_location` text NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `mobile`, `website`, `address`, `job_title`, `department`, `company`, `current_location`, `user_type`) VALUES
(17, 'Aean Gabrielle D. Tayawa', 'tayawaaean@gmail.com', 'tayawaaean', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', 'Admin'),
(27, 'Micheal Jay A. Pedronan', 'michealjay@gmail.com', 'mekel', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent_files`
--
ALTER TABLE `sent_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sent_files`
--
ALTER TABLE `sent_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
