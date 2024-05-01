-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 09:04 AM
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
(18, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:14:07', 'New User Approved', 'Kimberly Mae B. Reodique'),
(21, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:31:29', 'New User Approved', 'Ryan Anthony Gabriel B. Adaya'),
(22, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:34:38', 'New User Denied', 'Ryan Anthony Gabriel B. Adaya'),
(23, 'mekel', 'Employee', '2024-04-22 14:59:00', 'Profile Updated', 'mekel'),
(24, 'Micheal Jay A. Pedronan', 'Employee', '2024-04-22 15:51:17', 'Profile Updated', 'Micheal Jay A. Pedronan'),
(25, 'Micheal Jay A. Pedronan', 'Employee', '2024-04-22 22:10:16', 'Profile Updated', 'Micheal Jay A. Pedronan'),
(26, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-22 22:13:36', 'New User Approved', 'Kimberly Mae B. Reodique'),
(27, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-22 22:15:00', 'New User Approved', 'Kimberly Mae B. Reodique');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` binary(128) NOT NULL,
  `date_time` datetime NOT NULL,
  `file_size` binary(64) NOT NULL,
  `owner` varchar(128) NOT NULL,
  `folder_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `date_time`, `file_size`, `owner`, `folder_name`) VALUES
(59, 0x546d56334945317059334a766332396d6443424665474e6c6243425862334a726332686c5a5851756547787a65413d3d0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 14:57:38', 0x4e6a45344e513d3d0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', ''),
(60, 0x546d56334945317059334a766332396d644342516233646c636c427661573530494642795a584e6c626e526864476c766269357763485234000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 14:57:38', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', ''),
(61, 0x546d56334945317059334a766332396d6443425862334a6b49455276593356745a5735304c6d52765933673d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 14:57:38', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', ''),
(62, 0x546d56334946526c654851675247396a6457316c626e51756448683000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 14:57:38', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', ''),
(63, 0x546d56334945317059334a766332396d6443424665474e6c6243425862334a726332686c5a5851756547787a65413d3d0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 15:02:47', 0x4e6a45344e513d3d0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', 'test'),
(64, 0x546d56334945317059334a766332396d644342516233646c636c427661573530494642795a584e6c626e526864476c766269357763485234000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 15:02:47', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', 'test'),
(65, 0x546d56334945317059334a766332396d6443425862334a6b49455276593356745a5735304c6d52765933673d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 15:02:47', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', 'test'),
(66, 0x546d56334946526c654851675247396a6457316c626e51756448683000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2024-05-01 15:02:47', 0x4d413d3d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, 'mekel', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `folder_name` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `folder_name`, `username`, `created_at`) VALUES
(2, 'test', 'mekel', '2024-04-29 14:32:57'),
(3, 'test 2', 'mekel', '2024-04-29 14:41:41'),
(4, 'new', 'mekel', '2024-04-29 15:52:09'),
(5, 'Tite', 'mekel', '2024-05-01 06:00:00'),
(6, 'ti', 'aean', '2024-05-01 06:16:45');

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
  `user_type` varchar(20) NOT NULL,
  `birthday` varchar(64) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `profile_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `mobile`, `website`, `address`, `job_title`, `department`, `company`, `current_location`, `user_type`, `birthday`, `nickname`, `profile_pic`) VALUES
(17, 'Aean Gabrielle D. Tayawa', 'tayawaaean@gmail.com', 'tayawaaean', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', 'Admin', '', '', ''),
(27, 'Micheal Jay A. Pedronan', 'michealjay@gmail.com', 'mekel', '202cb962ac59075b964b07152d234b70', '09568317230', '', 'mekel.com', 'Batac City', '', '', '', '', 'Employee', 'May 19, 2002', '', '');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sent_files`
--
ALTER TABLE `sent_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
