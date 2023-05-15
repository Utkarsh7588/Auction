-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 08:14 PM
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
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(6) UNSIGNED NOT NULL,
  `userId` varchar(25) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `history` text NOT NULL,
  `quality` varchar(50) NOT NULL,
  `highest_bid` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `userId`, `imagePath`, `description`, `history`, `quality`, `highest_bid`) VALUES
(2, 'Utkarsh7588', 'uploads/shoes.jpeg', 'shoes', 'air jordans', 'Excellent', 1000.00),
(3, 'Utkarsh75888', 'uploads/car.jpeg', 'Sedan Car', '20 years old', 'Good', 0.00),
(4, 'Utkarsh75888', 'uploads/watch.jpg', 'Vintage Rolex watch', '3rd ownership', 'Good', 0.00),
(5, 'Utkarsh75888', 'uploads/617Y62DU8tL._SX450_.jpg', 'Antique Telephone', '1980', 'Good', 0.00),
(6, 'Utkarsh75888', 'uploads/istockphoto-89470585-612x612.jpg', 'Vintage stopwatch', '1960', 'Excellent', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `sold_items`
--

CREATE TABLE `sold_items` (
  `itemId` int(6) UNSIGNED NOT NULL,
  `userId` int(6) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `history` text NOT NULL,
  `quality` varchar(50) NOT NULL,
  `highest_bid` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(6) UNSIGNED NOT NULL,
  `userID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `userID`, `password`, `name`, `address`, `country`, `zipcode`, `email`, `gender`) VALUES
(2, 'Utkarsh7588', 'utkarsh', 'Utkarsh More', 'Mankar mala near datta mandir, Makhamalabad', 'India', '422003', 'utkarshmore7588@gmail.com', 'male'),
(12, 'Dhanu', 'dhanu', 'Dhanashree Patil', 'Mankar mala near datta mandir, Makhamalabad', 'India', '422003', 'dhanashreekp@gmail.com', 'male'),
(18, 'Atharva22', 'atharva', 'Atharva Sambhus', 'Mankar mala near datta mandir, Makhamalabad', 'China', '422003', 'atharvasambhus20072002@gmail.com', ''),
(19, 'Utkarsh75888', '12345678', 'Utkarsh More', 'Mankar mala near datta mandir, Makhamalabad', 'India', '422003', 'utkarshmore7588@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sold_items`
--
ALTER TABLE `sold_items`
  MODIFY `itemId` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
