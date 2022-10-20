-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2022 at 05:34 AM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khawajag_coursera`
--

-- --------------------------------------------------------

--
-- Table structure for table `mykeys`
--

CREATE TABLE `mykeys` (
  `myuser1` bigint(20) NOT NULL,
  `myuser2` bigint(20) NOT NULL,
  `mymsgkey` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mypm`
--

CREATE TABLE `mypm` (
  `myid` bigint(20) NOT NULL,
  `mytitle` varchar(256) NOT NULL,
  `mysender` varchar(255) NOT NULL,
  `myreciever` varchar(255) NOT NULL,
  `mymessage` text NOT NULL,
  `mytimestamp` int(10) NOT NULL,
  `mytag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `myusers`
--

CREATE TABLE `myusers` (
  `myid` bigint(20) NOT NULL,
  `myusername` varchar(255) NOT NULL,
  `mypassword` varchar(255) NOT NULL,
  `mysalt` varchar(255) NOT NULL,
  `myemail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `myusers`
--


-- Indexes for dumped tables
--

--
-- Indexes for table `mypm`
--
ALTER TABLE `mypm`
  ADD PRIMARY KEY (`myid`),
  ADD KEY `mysender` (`mysender`),
  ADD KEY `myreciever` (`myreciever`);

--
-- Indexes for table `myusers`
--
ALTER TABLE `myusers`
  ADD PRIMARY KEY (`myid`),
  ADD UNIQUE KEY `myusername` (`myusername`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mypm`
--
ALTER TABLE `mypm`
  MODIFY `myid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `myusers`
--
ALTER TABLE `myusers`
  MODIFY `myid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
