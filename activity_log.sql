-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 09:41 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
