-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2022 at 03:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `nrc`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `Work_Type` text DEFAULT NULL,
  `Code` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nagarsevak`
--

CREATE TABLE `nagarsevak` (
  `id` int(11) NOT NULL,
  `Prabhag_No` varchar(3) DEFAULT NULL,
  `Nagarsevak_Name` varchar(200) DEFAULT NULL,
  `Codes` varchar(3) DEFAULT NULL,
  `Url` varchar(48) DEFAULT NULL,
  `Prabhag_Name` varchar(41) DEFAULT NULL,
  `Ward_ofc` varchar(100) DEFAULT NULL,
  `Party` varchar(20) DEFAULT NULL,
  `Total_Questions` int(11) NOT NULL DEFAULT 0,
  `Avg_Attendance` float NOT NULL DEFAULT 0,
  `Criminal_Records` varchar(10) DEFAULT NULL,
  `Csv_Link` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Municipal_Committee` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_list`
--

CREATE TABLE `s_list` (
  `id` int(11) NOT NULL,
  `Year` varchar(11) DEFAULT NULL,
  `Details_Of_Work` text DEFAULT NULL,
  `Amount` decimal(15,2) DEFAULT NULL,
  `Code` varchar(1000) DEFAULT NULL,
  `Prabhag_No` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_data` varchar(100) NOT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wardoffice`
--

CREATE TABLE `wardoffice` (
  `id` int(11) NOT NULL,
  `Ward_ofc` varchar(22) DEFAULT NULL,
  `Prabhag_No` int(11) DEFAULT NULL,
  `Prabhag_Name` varchar(41) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_details`
--

CREATE TABLE `work_details` (
  `id` int(11) NOT NULL,
  `Year` varchar(11) DEFAULT NULL,
  `Details_Of_Work` text DEFAULT NULL,
  `Amount` decimal(15,2) DEFAULT NULL,
  `Code` varchar(1000) DEFAULT NULL,
  `Prabhag_No` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nagarsevak`
--
ALTER TABLE `nagarsevak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_list`
--
ALTER TABLE `s_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wardoffice`
--
ALTER TABLE `wardoffice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_details`
--
ALTER TABLE `work_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nagarsevak`
--
ALTER TABLE `nagarsevak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_list`
--
ALTER TABLE `s_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wardoffice`
--
ALTER TABLE `wardoffice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_details`
--
ALTER TABLE `work_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
