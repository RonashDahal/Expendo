-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 07:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailyprofit`
--

-- --------------------------------------------------------

--
-- Table structure for table `profits`
--

CREATE TABLE `profit` (
  `profit_id` int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` varchar(15) NOT NULL,
  `profit` int(20) NOT NULL,
  `profitdate` varchar(15) NOT NULL,
  `profitcategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `profits`
--
