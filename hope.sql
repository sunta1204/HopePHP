-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2018 at 05:43 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hope`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `member_password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `member_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `member_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_country` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_zipcode` int(5) DEFAULT NULL,
  `member_status` enum('A','U') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'U',
  `member_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_username`, `member_password`, `member_name`, `member_email`, `member_phone`, `member_address`, `member_city`, `member_country`, `member_zipcode`, `member_status`, `member_pic`) VALUES
('admin', 'admin', 'Suriyapong', 'sunta1204@gmail.com', '086-0896847', 'ธนารมณ์เพลส 888/2 เฟส 2', 'เมืองขอนแก่น', 'ขอนแก่น', 40000, 'A', 'admin'),
('sss', 'sss', 'sss', 'sss@sss', '087-7536541', 'sass', 'sss', 'sss', 11111, 'U', ''),
('sunta', '1234', 'สุริยพงศ์ มอญขาม', 'sunta1204@gmail.com', '086-0896847', ' 888/2  ', 'เมืองขอนแก่น', 'ขอนแก่น', 40000, 'U', ''),
('sunta1204', '0860896847', 'สุริยพงศ์ มอญขาม', 'sunta1204@gmail.com', '086-0896847', '  888/2 ธนารมณ์เพลส ', 'เมืองขอนแก่น', 'ขอนแก่น', 40000, 'U', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_cartype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_plate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `payment_phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `payment_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `payment_country` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `payment_zipcode` int(5) NOT NULL,
  `payment_picName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` enum('P','U') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'U',
  `transport_status` enum('N','D') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `payment_track` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_cartype`, `payment_plate`, `payment_username`, `payment_name`, `payment_email`, `payment_phone`, `payment_address`, `payment_city`, `payment_country`, `payment_zipcode`, `payment_picName`, `payment_proof`, `payment_status`, `transport_status`, `payment_track`, `payment_date`) VALUES
(79, 'mortorbike', '1กท-9202-ขอนแก่น', 'sunta1204', 'สุริยพงศ์ มอญขาม', 'sunta1204@gmail.com', '086-0896847', '   888/2 ธนารมณ์เพลส  ', 'เมืองขอนแก่น', 'ขอนแก่น', 40000, 'Screenshot (8).png', 'Screenshot (6).png', 'U', 'N', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_username`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
