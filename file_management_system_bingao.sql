-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 04:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `mobile`, `website`, `address`, `job_title`, `department`, `company`, `current_location`, `status`) VALUES
(4, 'Aean Gabrielle D. Tayawa', 'tayawaaean@gmail.com', 'tayawaaean', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '', '', '', '', '', ''),
(5, 'Kimberly Mae B. Reodique', 'kimberlyreodique@gmail.com', 'kimberly', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '', '', '', '', '', ''),
(6, 'Ismael', 'ismaelsenica@gmail.com', 'venciapps3321', '1d47de304fd2e86b549b14db5605c875', '', '', '', '', '', '', '', '', ''),
(7, 'Ismael', 'ismaelsenica@gmail.com', '20-051127', '1d47de304fd2e86b549b14db5605c875', '', '', '', '', '', '', '', '', ''),
(8, 'Lanz', 'Lanzbalbas123@gmail.com', 'lanzbagtit', 'e981b7e338f374ae44f58a20ddda44a8', '', '', '', '', '', '', '', '', ''),
(9, 'lanz', 'Lanzbalbas123@gmail.com', '20-051127', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', ''),
(10, 'dale', 'dale@gmail.com', '20-051127', '63a017d3ac56e09d80c939eda9bdbc88', '', '', '', '', '', '', '', '', ''),
(11, 'selwyne', 'selwyne@gmail.com', 'sel', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', ''),
(12, 'selwyne', 'selwyne@gmail.com', 'sel', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pending_requests`
--
ALTER TABLE `pending_requests`
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
-- AUTO_INCREMENT for table `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
