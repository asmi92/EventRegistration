-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 06:19 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `event_id` int(10) DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `uin` int(8) NOT NULL,
  `guests` int(4) NOT NULL,
  `checkinDateTime` datetime NOT NULL,
  `ename` varchar(20) NOT NULL,
  `is_reg_stud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `is_reg_student_only` tinyint(1) NOT NULL,
  `no_of_guests` int(11) NOT NULL,
  `organization` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `location`, `is_reg_student_only`, `no_of_guests`, `organization`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(1, 'Diwali', 'North Cafe', 0, 0, 'ISA', '2017-10-02', '2017-10-02', '13:00:00', '15:00:00'),
(2, 'Lantern Festival', 'North Cafe', 0, 10, 'Chinese Org', '2017-10-05', '2017-10-05', '17:30:00', '20:00:00'),
(3, 'Sports', 'BasketBall Court', 0, 0, 'ISA', '2017-10-03', '2017-10-03', '06:26:40', '05:25:59'),
(4, 'HAcking', 'web center', 0, 0, 'SPEC', '2017-10-04', '2017-10-04', '16:04:00', '18:00:00'),
(5, 'Top Golf ', 'ODU', 0, 0, 'SPEC', '2017-10-04', '2017-10-04', '16:00:00', '18:00:00'),
(7, 'Workshop', 'ODU', 0, 0, 'Strome', '2017-10-04', '2017-10-04', '22:07:00', '12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
