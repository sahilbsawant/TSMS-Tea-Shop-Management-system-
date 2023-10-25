-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 02:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tea`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `office_no` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `office_no`, `first_name`, `last_name`, `mobile_no`, `email_id`) VALUES
(1, '158', 'mahesh', 'chimankar', '8268172899', 'maheshchimankar@gmail.com'),
(2, '187', 'Balu', 'Sawant', '8268172899', 'yashbalajientp@gmail.com'),
(3, '182', 'nitesh', 'kumar', '8268172899', 'nitesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `ID` int(11) NOT NULL,
  `Drink_list` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`ID`, `Drink_list`, `Price`) VALUES
(1, 'Tea', '10'),
(2, 'Coffee', '15'),
(3, 'Lemon Tea', '15'),
(4, 'Black Tea', '10'),
(5, 'Green Tea', '20'),
(6, 'Jaggery', '15'),
(7, 'Ukhala', '15');

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `ID` int(255) NOT NULL,
  `Office_no` int(50) NOT NULL,
  `Drink` varchar(255) NOT NULL,
  `Quantity` int(255) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Entry_by` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`ID`, `Office_no`, `Drink`, `Quantity`, `Amount`, `Entry_by`, `Created_at`) VALUES
(1, 158, 'tea', 2, 20, 'sahil', '0000-00-00 00:00:00'),
(2, 158, 'tea', 2, 20, '', '0000-00-00 00:00:00'),
(3, 158, 'tea', 2, 20, 'sahil', '2023-09-27 07:38:05'),
(4, 158, 'tea', 2, 20, 'sahil', '2023-09-27 08:59:26'),
(5, 0, '15', 1, 15, 'Array', '2023-09-27 09:04:08'),
(6, 123, '', 2, 30, 'iftekhar ', '2023-09-27 12:34:16'),
(7, 156, 'Tea(Chai)', 1, 10, 'iftekhar ', '2023-09-27 12:35:35'),
(8, 123, 'Tea(Chai)', 1, 10, 'sahil ', '2023-09-28 06:46:56'),
(9, 158, '', 2, 20, '', '2023-09-29 07:52:08'),
(10, 158, 'tea', 2, 20, 'sahil', '2023-09-29 07:52:44'),
(11, 158, 'tea', 2, 20, 'sahil', '2023-10-01 10:41:20'),
(12, 11, 'Coffee', 1, 15, 'sahil ', '2023-10-01 10:46:35'),
(13, 158, 'Tea(Chai)', 1, 10, 'sahil ', '2023-10-01 10:50:30'),
(14, 158, 'Lemon Tea', 1, 15, 'sahil ', '2023-10-01 10:55:15'),
(15, 158, 'Tea(Chai)', 1, 10, 'sahil ', '2023-10-01 10:58:31'),
(16, 187, 'Coffee', 2, 30, 'sahil ', '2023-10-01 11:56:23'),
(17, 158, 'Tea(Chai)', 1, 10, 'sahil ', '2023-10-02 09:19:59'),
(18, 158, 'Tea(Chai)', 1, 10, 'sahil ', '2023-10-02 09:29:43'),
(19, 11, 'Green Tea', 1, 20, 'iftekhar  ', '2023-10-02 10:39:14'),
(20, 158, 'Coffee', 1, 15, 'sahil ', '2023-10-03 09:07:30'),
(21, 158, 'Lemon Tea', 1, 15, 'iftekhar ', '2023-10-03 09:37:58'),
(22, 158, 'Coffee', 1, 15, 'iftekhar ', '2023-10-03 09:42:51'),
(23, 158, 'Lemon Tea', 1, 15, 'iftekhar ', '2023-10-03 09:44:33'),
(24, 158, 'Tea(Chai)', 1, 10, 'iftekhar ', '2023-10-03 10:57:22'),
(25, 182, 'Tea(Chai)', 3, 30, 'sahil ', '2023-10-15 09:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff_login`
--

CREATE TABLE `staff_login` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_login`
--

INSERT INTO `staff_login` (`id`, `username`, `password`) VALUES
(1, 'sahil', 'sahil123'),
(2, 'iftekhar', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff_login`
--
ALTER TABLE `staff_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `staff_login`
--
ALTER TABLE `staff_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
