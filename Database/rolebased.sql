-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 06:31 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rolebased`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `time_alloted` decimal(4,1) NOT NULL,
  `employee_id` int(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time(6) NOT NULL,
  `additional_charge` decimal(5,2) DEFAULT 0.00,
  `invoice_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `comment` varchar(255) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `time_alloted`, `employee_id`, `date`, `time`, `additional_charge`, `invoice_charge`, `comment`, `deleted_at`) VALUES
(1, 34, '3.0', 33, '2021-06-16', '22:40:00.000000', '0.00', '0.00', '', NULL),
(2, 34, '3.0', 33, '2021-06-23', '22:40:00.000000', '0.00', '0.00', '', NULL),
(3, 34, '3.0', 33, '2021-06-30', '22:40:00.000000', '0.00', '0.00', '', NULL),
(4, 34, '3.0', 33, '2021-07-07', '22:40:00.000000', '0.00', '0.00', '', NULL),
(5, 34, '3.0', 33, '2021-07-14', '22:40:00.000000', '0.00', '0.00', '', NULL),
(6, 34, '3.0', 33, '2021-07-21', '22:40:00.000000', '0.00', '0.00', '', NULL),
(7, 34, '3.0', 33, '2021-07-28', '22:40:00.000000', '0.00', '0.00', '', NULL),
(8, 34, '3.0', 33, '2021-08-04', '22:40:00.000000', '0.00', '0.00', '', NULL),
(9, 34, '3.0', 33, '2021-08-11', '22:40:00.000000', '0.00', '0.00', '', NULL),
(10, 34, '3.0', 33, '2021-08-18', '22:40:00.000000', '0.00', '0.00', '', NULL),
(11, 34, '3.0', 33, '2021-08-25', '22:40:00.000000', '0.00', '0.00', '', NULL),
(12, 34, '3.0', 33, '2021-09-01', '22:40:00.000000', '0.00', '0.00', '', NULL),
(13, 34, '3.0', 33, '2021-09-08', '22:40:00.000000', '0.00', '0.00', '', NULL),
(14, 34, '3.0', 33, '2021-09-15', '22:40:00.000000', '0.00', '0.00', '', NULL),
(15, 34, '3.0', 33, '2021-09-22', '22:40:00.000000', '0.00', '0.00', '', NULL),
(16, 34, '3.0', 33, '2021-09-29', '22:40:00.000000', '0.00', '0.00', '', NULL),
(17, 34, '3.0', 33, '2021-10-06', '22:40:00.000000', '0.00', '0.00', '', NULL),
(18, 34, '3.0', 33, '2021-10-13', '22:40:00.000000', '0.00', '0.00', '', NULL),
(19, 34, '3.0', 33, '2021-10-20', '22:40:00.000000', '0.00', '0.00', '', NULL),
(20, 34, '3.0', 33, '2021-10-27', '22:40:00.000000', '0.00', '0.00', '', NULL),
(21, 34, '3.0', 33, '2021-11-03', '22:40:00.000000', '0.00', '0.00', '', NULL),
(22, 34, '3.0', 33, '2021-11-10', '22:40:00.000000', '0.00', '0.00', '', NULL),
(23, 34, '3.0', 33, '2021-11-17', '22:40:00.000000', '0.00', '0.00', '', NULL),
(24, 34, '3.0', 33, '2021-11-24', '22:40:00.000000', '0.00', '0.00', '', NULL),
(25, 34, '3.0', 33, '2021-12-01', '22:40:00.000000', '0.00', '0.00', '', NULL),
(26, 34, '3.0', 33, '2021-12-08', '22:40:00.000000', '0.00', '0.00', '', NULL),
(27, 34, '3.0', 33, '2021-12-15', '22:40:00.000000', '0.00', '0.00', '', NULL),
(28, 34, '3.0', 33, '2021-12-22', '22:40:00.000000', '0.00', '0.00', '', NULL),
(29, 34, '3.0', 33, '2021-12-29', '22:40:00.000000', '0.00', '0.00', '', NULL),
(30, 34, '3.0', 33, '2022-01-05', '22:40:00.000000', '0.00', '0.00', '', NULL),
(31, 34, '3.0', 33, '2022-01-12', '22:40:00.000000', '0.00', '0.00', '', NULL),
(32, 34, '3.0', 33, '2022-01-19', '22:40:00.000000', '0.00', '0.00', '', NULL),
(33, 34, '3.0', 33, '2022-01-26', '22:40:00.000000', '0.00', '0.00', '', NULL),
(34, 34, '3.0', 33, '2022-02-02', '22:40:00.000000', '0.00', '0.00', '', NULL),
(35, 34, '3.0', 33, '2022-02-09', '22:40:00.000000', '0.00', '0.00', '', NULL),
(36, 34, '3.0', 33, '2022-02-16', '22:40:00.000000', '0.00', '0.00', '', NULL),
(37, 34, '3.0', 33, '2022-02-23', '22:40:00.000000', '0.00', '0.00', '', NULL),
(38, 34, '3.0', 33, '2022-03-02', '22:40:00.000000', '0.00', '0.00', '', NULL),
(39, 34, '3.0', 33, '2022-03-09', '22:40:00.000000', '0.00', '0.00', '', NULL),
(40, 34, '3.0', 33, '2022-03-16', '22:40:00.000000', '0.00', '0.00', '', NULL),
(41, 34, '3.0', 33, '2022-03-23', '22:40:00.000000', '0.00', '0.00', '', NULL),
(42, 34, '3.0', 33, '2022-03-30', '22:40:00.000000', '0.00', '0.00', '', NULL),
(43, 34, '3.0', 33, '2022-04-06', '22:40:00.000000', '0.00', '0.00', '', NULL),
(44, 34, '3.0', 33, '2022-04-13', '22:40:00.000000', '0.00', '0.00', '', NULL),
(45, 34, '3.0', 33, '2022-04-20', '22:40:00.000000', '0.00', '0.00', '', NULL),
(46, 34, '3.0', 33, '2022-04-27', '22:40:00.000000', '0.00', '0.00', '', NULL),
(47, 34, '3.0', 33, '2022-05-04', '22:40:00.000000', '0.00', '0.00', '', NULL),
(48, 34, '3.0', 33, '2022-05-11', '22:40:00.000000', '0.00', '0.00', '', NULL),
(49, 36, '5.0', 35, '2021-06-09', '10:00:00.000000', '0.00', '0.00', '', '2021-06-16'),
(50, 36, '5.0', 35, '2021-07-07', '10:00:00.000000', '0.00', '0.00', '', NULL),
(51, 36, '5.0', 35, '2021-08-04', '10:00:00.000000', '0.00', '0.00', '', NULL),
(52, 36, '5.0', 35, '2021-09-01', '10:00:00.000000', '0.00', '0.00', '', NULL),
(53, 36, '5.0', 35, '2021-10-06', '10:00:00.000000', '0.00', '0.00', '', NULL),
(54, 36, '5.0', 35, '2021-11-03', '10:00:00.000000', '0.00', '0.00', '', NULL),
(55, 36, '5.0', 35, '2021-12-01', '10:00:00.000000', '0.00', '0.00', '', NULL),
(56, 36, '5.0', 35, '2022-01-05', '10:00:00.000000', '0.00', '0.00', '', NULL),
(57, 36, '5.0', 35, '2022-02-02', '10:00:00.000000', '0.00', '0.00', '', NULL),
(58, 36, '5.0', 35, '2022-03-02', '10:00:00.000000', '0.00', '0.00', '', NULL),
(59, 36, '5.0', 35, '2022-04-06', '10:00:00.000000', '0.00', '0.00', '', NULL),
(60, 36, '5.0', 35, '2022-05-04', '10:00:00.000000', '0.00', '0.00', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `time_alloted` decimal(4,1) NOT NULL,
  `appointment_type` varchar(20) NOT NULL,
  `base_price` int(11) NOT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `is_personal` int(1) NOT NULL DEFAULT 1,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `user_id`, `details`, `time_alloted`, `appointment_type`, `base_price`, `admin_note`, `is_personal`, `deleted_at`) VALUES
(1, 34, '', '3.0', 'weekly', 350, 'No details', 1, NULL),
(2, 36, '', '5.0', 'monthly', 600, '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `color` varchar(15) NOT NULL DEFAULT 'yellow',
  `officer` int(1) NOT NULL DEFAULT 0,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `user_id`, `details`, `color`, `officer`, `deleted_at`) VALUES
(1, 33, 'Officer', '#9e7cee', 1, NULL),
(2, 35, 'Not officer', '#d4f23a', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_images`
--

CREATE TABLE `employee_images` (
  `id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_images`
--

INSERT INTO `employee_images` (`id`, `employee_id`, `file_path`, `deleted_at`) VALUES
(1, 33, 'img/avatars/2021_06_16_05_05_41amkdKUNAL DEY - Copy (2).jpg', NULL),
(2, 35, 'img/avatars/2021_06_16_05_10_18amkd2021_06_09_07_13_07pmkdavatar999.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime DEFAULT NULL,
  `color` varchar(20) NOT NULL DEFAULT 'yellow',
  `customer_id` int(255) DEFAULT NULL,
  `employee_id` int(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time(6) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `end_event`, `color`, `customer_id`, `employee_id`, `date`, `time`, `deleted_at`) VALUES
(1, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-06-16 00:00:00', NULL, '#9e7cee', 34, 33, '2021-06-16', '22:40:00.000000', NULL),
(2, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-06-23 00:00:00', NULL, '#9e7cee', 34, 33, '2021-06-23', '22:40:00.000000', NULL),
(3, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-06-30 00:00:00', NULL, '#9e7cee', 34, 33, '2021-06-30', '22:40:00.000000', NULL),
(4, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-07-07 00:00:00', NULL, '#9e7cee', 34, 33, '2021-07-07', '22:40:00.000000', NULL),
(5, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-07-14 00:00:00', NULL, '#9e7cee', 34, 33, '2021-07-14', '22:40:00.000000', NULL),
(6, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-07-21 00:00:00', NULL, '#9e7cee', 34, 33, '2021-07-21', '22:40:00.000000', NULL),
(7, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-07-28 00:00:00', NULL, '#9e7cee', 34, 33, '2021-07-28', '22:40:00.000000', NULL),
(8, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-08-04 00:00:00', NULL, '#9e7cee', 34, 33, '2021-08-04', '22:40:00.000000', NULL),
(9, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-08-11 00:00:00', NULL, '#9e7cee', 34, 33, '2021-08-11', '22:40:00.000000', NULL),
(10, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-08-18 00:00:00', NULL, '#9e7cee', 34, 33, '2021-08-18', '22:40:00.000000', NULL),
(11, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-08-25 00:00:00', NULL, '#9e7cee', 34, 33, '2021-08-25', '22:40:00.000000', NULL),
(12, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-09-01 00:00:00', NULL, '#9e7cee', 34, 33, '2021-09-01', '22:40:00.000000', NULL),
(13, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-09-08 00:00:00', NULL, '#9e7cee', 34, 33, '2021-09-08', '22:40:00.000000', NULL),
(14, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-09-15 00:00:00', NULL, '#9e7cee', 34, 33, '2021-09-15', '22:40:00.000000', NULL),
(15, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-09-22 00:00:00', NULL, '#9e7cee', 34, 33, '2021-09-22', '22:40:00.000000', NULL),
(16, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-09-29 00:00:00', NULL, '#9e7cee', 34, 33, '2021-09-29', '22:40:00.000000', NULL),
(17, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-10-06 00:00:00', NULL, '#9e7cee', 34, 33, '2021-10-06', '22:40:00.000000', NULL),
(18, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-10-13 00:00:00', NULL, '#9e7cee', 34, 33, '2021-10-13', '22:40:00.000000', NULL),
(19, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-10-20 00:00:00', NULL, '#9e7cee', 34, 33, '2021-10-20', '22:40:00.000000', NULL),
(20, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-10-27 00:00:00', NULL, '#9e7cee', 34, 33, '2021-10-27', '22:40:00.000000', NULL),
(21, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-11-03 00:00:00', NULL, '#9e7cee', 34, 33, '2021-11-03', '22:40:00.000000', NULL),
(22, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-11-10 00:00:00', NULL, '#9e7cee', 34, 33, '2021-11-10', '22:40:00.000000', NULL),
(23, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-11-17 00:00:00', NULL, '#9e7cee', 34, 33, '2021-11-17', '22:40:00.000000', NULL),
(24, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-11-24 00:00:00', NULL, '#9e7cee', 34, 33, '2021-11-24', '22:40:00.000000', NULL),
(25, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-12-01 00:00:00', NULL, '#9e7cee', 34, 33, '2021-12-01', '22:40:00.000000', NULL),
(26, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-12-08 00:00:00', NULL, '#9e7cee', 34, 33, '2021-12-08', '22:40:00.000000', NULL),
(27, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-12-15 00:00:00', NULL, '#9e7cee', 34, 33, '2021-12-15', '22:40:00.000000', NULL),
(28, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-12-22 00:00:00', NULL, '#9e7cee', 34, 33, '2021-12-22', '22:40:00.000000', NULL),
(29, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2021-12-29 00:00:00', NULL, '#9e7cee', 34, 33, '2021-12-29', '22:40:00.000000', NULL),
(30, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-01-05 00:00:00', NULL, '#9e7cee', 34, 33, '2022-01-05', '22:40:00.000000', NULL),
(31, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-01-12 00:00:00', NULL, '#9e7cee', 34, 33, '2022-01-12', '22:40:00.000000', NULL),
(32, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-01-19 00:00:00', NULL, '#9e7cee', 34, 33, '2022-01-19', '22:40:00.000000', NULL),
(33, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-01-26 00:00:00', NULL, '#9e7cee', 34, 33, '2022-01-26', '22:40:00.000000', NULL),
(34, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-02-02 00:00:00', NULL, '#9e7cee', 34, 33, '2022-02-02', '22:40:00.000000', NULL),
(35, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-02-09 00:00:00', NULL, '#9e7cee', 34, 33, '2022-02-09', '22:40:00.000000', NULL),
(36, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-02-16 00:00:00', NULL, '#9e7cee', 34, 33, '2022-02-16', '22:40:00.000000', NULL),
(37, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-02-23 00:00:00', NULL, '#9e7cee', 34, 33, '2022-02-23', '22:40:00.000000', NULL),
(38, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-03-02 00:00:00', NULL, '#9e7cee', 34, 33, '2022-03-02', '22:40:00.000000', NULL),
(39, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-03-09 00:00:00', NULL, '#9e7cee', 34, 33, '2022-03-09', '22:40:00.000000', NULL),
(40, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-03-16 00:00:00', NULL, '#9e7cee', 34, 33, '2022-03-16', '22:40:00.000000', NULL),
(41, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-03-23 00:00:00', NULL, '#9e7cee', 34, 33, '2022-03-23', '22:40:00.000000', NULL),
(42, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-03-30 00:00:00', NULL, '#9e7cee', 34, 33, '2022-03-30', '22:40:00.000000', NULL),
(43, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-04-06 00:00:00', NULL, '#9e7cee', 34, 33, '2022-04-06', '22:40:00.000000', NULL),
(44, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-04-13 00:00:00', NULL, '#9e7cee', 34, 33, '2022-04-13', '22:40:00.000000', NULL),
(45, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-04-20 00:00:00', NULL, '#9e7cee', 34, 33, '2022-04-20', '22:40:00.000000', NULL),
(46, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-04-27 00:00:00', NULL, '#9e7cee', 34, 33, '2022-04-27', '22:40:00.000000', NULL),
(47, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-05-04 00:00:00', NULL, '#9e7cee', 34, 33, '2022-05-04', '22:40:00.000000', NULL),
(48, 'anushkadatta2016@gmail.com ANUSHKA DATTA 22:40 3hr', '2022-05-11 00:00:00', NULL, '#9e7cee', 34, 33, '2022-05-11', '22:40:00.000000', NULL),
(50, '2 Customer 2 10:00 5hr', '2021-07-07 00:00:00', NULL, '#d4f23a', 36, 35, '2021-07-07', '10:00:00.000000', NULL),
(51, '2 Customer 2 10:00 5hr', '2021-08-04 00:00:00', NULL, '#d4f23a', 36, 35, '2021-08-04', '10:00:00.000000', NULL),
(52, '2 Customer 2 10:00 5hr', '2021-09-01 00:00:00', NULL, '#d4f23a', 36, 35, '2021-09-01', '10:00:00.000000', NULL),
(53, '2 Customer 2 10:00 5hr', '2021-10-06 00:00:00', NULL, '#d4f23a', 36, 35, '2021-10-06', '10:00:00.000000', NULL),
(54, '2 Customer 2 10:00 5hr', '2021-11-03 00:00:00', NULL, '#d4f23a', 36, 35, '2021-11-03', '10:00:00.000000', NULL),
(55, '2 Customer 2 10:00 5hr', '2021-12-01 00:00:00', NULL, '#d4f23a', 36, 35, '2021-12-01', '10:00:00.000000', NULL),
(56, '2 Customer 2 10:00 5hr', '2022-01-05 00:00:00', NULL, '#d4f23a', 36, 35, '2022-01-05', '10:00:00.000000', NULL),
(57, '2 Customer 2 10:00 5hr', '2022-02-02 00:00:00', NULL, '#d4f23a', 36, 35, '2022-02-02', '10:00:00.000000', NULL),
(58, '2 Customer 2 10:00 5hr', '2022-03-02 00:00:00', NULL, '#d4f23a', 36, 35, '2022-03-02', '10:00:00.000000', NULL),
(59, '2 Customer 2 10:00 5hr', '2022-04-06 00:00:00', NULL, '#d4f23a', 36, 35, '2022-04-06', '10:00:00.000000', NULL),
(60, '2 Customer 2 10:00 5hr', '2022-05-04 00:00:00', NULL, '#d4f23a', 36, 35, '2022-05-04', '10:00:00.000000', NULL),
(61, 'KUNAL DEY-Every Year', '2021-06-17 00:00:00', '2021-06-25 00:00:00', '#ff726f', NULL, 33, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `role`, `name`, `deleted_at`) VALUES
(1, 'john.doe@gmail.com', '123456', 'admin', 'Admin John', NULL),
(33, 'kunaldey997@gmail.com', '123456', 'employee', 'KUNAL DEY', NULL),
(34, '1', '123456', 'customer', 'ANUSHKA DATTA', NULL),
(35, 'johnnytest@gmail.com', '123456', 'employee', 'JOHNNY TEST', NULL),
(36, '2', '123456', 'customer', 'Customer 2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment` (`customer_id`),
  ADD KEY `appointment-e` (`employee_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer-user` (`user_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee-user` (`user_id`);

--
-- Indexes for table `employee_images`
--
ALTER TABLE `employee_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee-image` (`employee_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_images`
--
ALTER TABLE `employee_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointment-e` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer-user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD CONSTRAINT `employee-user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employee_images`
--
ALTER TABLE `employee_images`
  ADD CONSTRAINT `employee-image` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
