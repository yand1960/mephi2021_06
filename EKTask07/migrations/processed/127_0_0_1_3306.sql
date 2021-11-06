-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2021 at 12:10 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `album`
--
CREATE DATABASE IF NOT EXISTS `albumEK` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `albumEK`;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `PhotoID` int(11) NOT NULL,
  `URL` varchar(256) NOT NULL,
  `URL_large` varchar(256) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`PhotoID`, `URL`, `URL_large`, `Name`, `Created`) VALUES
(21, 'april-meyer.jpg', 'april-meyer-large.jpg', 'april meyer', '2021-10-09'),
(22, 'david-alexander.jpg', 'david-alexander-large.jpg', 'david alexander', '2021-10-09'),
(23, 'mark-hanson.jpg', 'mark-hanson-large.jpg', 'mark hanson', '2021-10-09'),
(24, 'melissa-kerr.jpg', 'melissa-kerr-large.jpg', 'melissa kerr', '2021-10-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`PhotoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `PhotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Database: `hr`
--
