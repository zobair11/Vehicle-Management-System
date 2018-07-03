-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2018 at 01:12 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(50) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `job_number` varchar(30) DEFAULT '',
  `car_number` varchar(100) DEFAULT '',
  `destination` varchar(100) DEFAULT '',
  `pickup` varchar(100) DEFAULT '',
  `booking_time` datetime DEFAULT NULL,
  `return_time` datetime DEFAULT NULL,
  `job_start_time` datetime DEFAULT NULL,
  `job_finish_time` datetime DEFAULT NULL,
  `passenger` int(10) DEFAULT NULL,
  `job_type` varchar(20) DEFAULT '',
  `job_status` tinyint(5) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `submission_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `job_number`, `car_number`, `destination`, `pickup`, `booking_time`, `return_time`, `job_start_time`, `job_finish_time`, `passenger`, `job_type`, `job_status`, `update_time`, `submission_time`) VALUES
(1, 12, 'C170210', 'LISA 44', 'Candando Talatona', 'Kero Talatona', '2018-01-17 02:10:00', '2018-01-18 02:20:00', NULL, NULL, NULL, 'General', NULL, NULL, '2018-01-17 01:44:20'),
(2, 12, 'C220', '', 'Candando Morro Bento', 'MDR', '2018-01-17 01:45:43', NULL, '2018-01-17 01:46:04', '2018-01-17 01:46:23', NULL, 'shuttle', NULL, NULL, NULL),
(3, 8, 'K251840', 'LISA 46', 'Kero Talatona', 'City - Downtown', '2018-01-25 18:40:00', '2018-01-26 18:00:00', '2018-01-22 18:09:35', NULL, NULL, 'General', NULL, NULL, '2018-01-22 18:08:47'),
(4, 8, 'C231820', 'LISA 54', 'Candando Talatona', 'Belas Shopping', '2018-01-23 18:20:00', '2018-01-24 18:30:00', '2018-01-22 18:09:41', NULL, NULL, 'General', NULL, NULL, '2018-01-22 18:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(50) NOT NULL,
  `car_number` varchar(50) DEFAULT '',
  `type` varchar(50) DEFAULT '',
  `registration_number` varchar(50) DEFAULT '',
  `status` int(11) DEFAULT NULL,
  `passenger_capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_number`, `type`, `registration_number`, `status`, `passenger_capacity`) VALUES
(7, 'LISA 33', '', '', 1, NULL),
(8, 'LISA 34', '', '', 1, NULL),
(9, 'LISA 44', '', '', 1, NULL),
(10, 'LISA 45', '', '', 1, NULL),
(11, 'LISA 46', '', '', 1, NULL),
(12, 'LISA 47', '', '', 0, NULL),
(13, 'LISA 48', '', '', 1, NULL),
(14, 'LISA 49', '', '', 0, NULL),
(15, 'LISA 50', '', '', 0, NULL),
(16, 'LISA 51', '', '', 0, NULL),
(17, 'LISA 52', '', '', 0, NULL),
(18, 'LISA 53', '', '', 0, NULL),
(19, 'LISA 54', '', '', 1, NULL),
(20, 'LISA 55', '', '', 1, NULL),
(21, 'LISA 56', '', '', 1, NULL),
(22, 'LISA 57', '', '', 1, NULL),
(23, 'LISA 58', '', '', 1, NULL),
(24, 'LISA 59', '', '', 1, NULL),
(25, 'LISA 60', '', '', 1, NULL),
(26, 'LISA 61', '', '', 1, NULL),
(27, 'LISA 62', '', '', 0, NULL),
(28, 'LISA 63', '', '', 0, NULL),
(29, 'LISA 64', '', '', 0, NULL),
(30, 'LISA 65', '', '', 0, NULL),
(31, 'LISA 66', '', '', 0, NULL),
(32, 'LISA 67', '', '', 0, NULL),
(33, 'LISA 68', '', '', 0, NULL),
(34, 'LISA 69', '', '', 0, NULL),
(35, 'LISA 70', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_bookings`
--

CREATE TABLE `deleted_bookings` (
  `id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `car` varchar(30) DEFAULT '',
  `deleted_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(50) NOT NULL,
  `driver_name` varchar(50) DEFAULT '',
  `car_number` varchar(30) DEFAULT '',
  `working_hours` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(10) NOT NULL,
  `job_type` varchar(30) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) NOT NULL,
  `locations` varchar(100) DEFAULT '',
  `geo_locations` varchar(200) DEFAULT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `locations`, `geo_locations`, `latitude`, `longitude`) VALUES
(1, 'Belas Shopping', '-8.923193, 13.186210', -8.923193, 13.186210),
(2, 'Candando Talatona', '-8.919250, 13.181575', -8.919250, 13.181575),
(3, 'Candando Morro Bento', '-8.902406, 13.190126', -8.902406, 13.190126),
(4, 'Kero Talatona', '-8.918519, 13.187132', -8.918519, 13.187132),
(5, 'Kero Nova Vida', '-8.895072, 13.230079', -8.895072, 13.230079),
(6, 'City - Downtown', '-8.809944, 13.232684', -8.809944, 13.232684),
(7, 'Viana', '-8.895950, 13.349620', -8.895950, 13.349620),
(8, 'Kilamba', '-8.972595, 13.320753', -8.972595, 13.320753),
(9, 'Benifica', '-8.956459, 13.191314', -8.956459, 13.191314),
(10, 'Residence A', '-8.914546, 13.192203', -8.914546, 13.192203),
(11, 'MDR', '-8.913163, 13.190771', -8.913163, 13.190771),
(12, 'Delta', '-8.915350, 13.190578', -8.915350, 13.190578);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `job_number` varchar(250) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `job_number`, `status`, `timestamp`) VALUES
(1, 'C061540', 1, NULL),
(2, 'C091640', 1, NULL),
(3, 'B111910', 1, NULL),
(4, 'C83335', 1, NULL),
(5, 'K12086', 1, NULL),
(6, 'C16362', 1, NULL),
(7, 'V71528', 1, NULL),
(9, 'K38245', 1, '2018-01-07 21:46:57'),
(10, 'V733', 1, '2018-01-07 21:47:40'),
(11, 'C242', 1, '2018-01-07 22:19:55'),
(12, 'A New Job Has Been Submitted byhayderimagine.Destination is:Candando Morro Bento.Please pick the client from:Kero Talatona.Thank You!', 1, '2018-01-07 22:52:16'),
(13, 'A New Job Has Been Submitted by Ali Hayder. Destination is: Candando Morro Bento. Please pick the client from: Candando Morro Bento. Thank You!', 1, '2018-01-07 22:59:42'),
(14, 'A New Job Has Been Submitted byAli Hayder. Destination is:Benifica. Please pick the client from:MDR. Thank You!', 1, '2018-01-07 23:02:20'),
(15, 'A New Job Has Been Submitted byAli Hayder. Destination is:Viana. Please pick the client from:Residence A. Thank You!', 1, '2018-01-07 23:03:08'),
(16, 'A New Job Has Been Submitted byAli Hayder. Destination is:Candando Morro Bento. Please pick the client from:City - Downtown. Thank You!', 1, '2018-01-07 23:08:32'),
(17, 'A New Job Has Been Submitted for Shuttle. byAli Hayder. Destination is:Kero Talatona. Please pick the client from:Kilamba. Thank You!', 1, '2018-01-07 23:10:10'),
(18, 'A New Job Has Been Submitted for Shuttle. byLIS Admin2. Destination is:Candando Talatona. Please pick the client from:Candando Talatona. Thank You!', 1, '2018-01-09 00:53:13'),
(19, 'A New Job Has Been Submitted for Shuttle. byLIS Admin2. Destination is:Benifica. Please pick the client from:Viana. Thank You!', 1, '2018-01-09 00:54:02'),
(20, 'A New Job Has Been Submitted for Shuttle. byAli Hayder. Destination is:Viana. Please pick the client from:City - Downtown. Thank You!', 1, '2018-01-09 00:55:51'),
(21, 'A New Job Has Been Submitted for Shuttle. byLIS Admin2. Destination is:Kero Nova Vida. Please pick the client from:Kero Nova Vida. Thank You!', 1, '2018-01-12 00:27:49'),
(22, 'A New Job Has Been Submitted for Shuttle. byAli H Hayder. Destination is:Candando Talatona. Please pick the client from:Belas Shopping. Thank You!', 1, '2018-01-15 00:56:00'),
(23, 'A New Job Has Been Submitted for Shuttle. byAli H Hayder. Destination is:Candando Morro Bento. Please pick the client from:MDR. Thank You!', 1, '2018-01-17 01:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `max_booking_no` int(10) DEFAULT NULL,
  `days_limits` int(11) DEFAULT NULL,
  `minutes_steps` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `max_booking_no`, `days_limits`, `minutes_steps`) VALUES
(1, 2, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(50) NOT NULL,
  `first_name` varchar(20) DEFAULT '',
  `last_name` varchar(20) DEFAULT '',
  `user_name` varchar(20) DEFAULT '',
  `email` varchar(30) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  `role` varchar(10) DEFAULT '',
  `creation_date` datetime DEFAULT NULL,
  `self_drive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `user_name`, `email`, `password`, `role`, `creation_date`, `self_drive`) VALUES
(3, 'Zobair 2', 'Rahman', 'zobair11', 'zobair619316@hotmail.com', '333333', 'User', NULL, 1),
(4, 'aaa', 'bbb', 'aaa111', 'aaa@gmail.com', '222222', 'driver', NULL, NULL),
(8, 'Rafi', 'Hasan', 'rafi', 'rafi@gmail.com', '222222', 'admin', NULL, NULL),
(9, 'adsadsadsadsadsa', 'dsadsadsad', 'asdasd', 'asdasdd@gmail.com', '555555', 'User', NULL, NULL),
(10, 'Al', 'Kamal', 'kamal', 'kamal@gmail.com', '444444', 'User', NULL, NULL),
(11, 'Ali', 'Hayder', 'ahayder', 'nitangola2015@gmail.com', '123654', 'admin', NULL, NULL),
(12, 'Ali H', 'Hayder', 'hayderimagine', 'hayderimagine@gmail.com', '**123654', 'User', NULL, 1),
(13, 'LIS', 'Admin', 'lisadmin', 'sysadmin@lisluanda.com', 'Lisa1234!', 'admin', NULL, NULL),
(14, 'LIS', 'Driver', 'lisdrivers', 'lisdrivers@lisluanda.com', 'Lisa1234!', 'driver', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_bookings`
--
ALTER TABLE `deleted_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `deleted_bookings`
--
ALTER TABLE `deleted_bookings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
