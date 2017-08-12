-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 10:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'David', 'Ibanez', 'Administrator', '123', 'Administrator'),
(2, 'Jao', 'Austero', 'jao', 'jao', 'patient'),
(3, 'jeo', 'blanco', 'jeo', 'jeo', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_ID` int(11) NOT NULL,
  `admin_ID` int(11) NOT NULL,
  `pa_firstname` varchar(50) NOT NULL,
  `pa_lastname` varchar(50) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `appointment_date` varchar(30) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `age` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `doctor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_ID`, `admin_ID`, `pa_firstname`, `pa_lastname`, `phone_no`, `appointment_date`, `gender`, `message`, `status`, `doctor_ID`) VALUES
(1, 2, 'Jane', 'Doe', '09296811525', '13 April, 2017', 'Female', 'None', 'done', 1),
(3, 2, 'David', 'Ibanez', '09286243726', '26 April, 2017', 'Male', 'Tulog Pls!', 'done', 1),
(4, 2, 'Jao', 'Austero', '09296811525', '9 May, 2017', 'Male', 'Masakit po Chan', 'done', 1),
(5, 2, 'Jao', 'Austero', '09296811525', '30 May, 2017', 'Male', 'Tangina natatae nako', 'done', 1),
(7, 2, 'Jao', 'Austero', '09296811525', '16 May, 2017', 'Male', 'Try lang', 'done', 1),
(8, 3, 'jeo', 'blanco', '09296811525', '15 May, 2017', 'Male', 'Masakit ulo, nag sususka (3x a day), Nahihilo', 'done', 1),
(9, 2, 'Jao', 'Austero', '09296811525', '17 May, 2017', 'Male', 'Something', 'done', 1),
(10, 3, 'jeo', 'blanco', '09296812525', '2017-05-17', 'Male', 'as', 'done', 1),
(11, 3, 'jeo', 'blanco', '09296811525', '2017-05-18', 'Male', 'asd', 'done', 2);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_today`
--

CREATE TABLE `appointment_today` (
  `AT_ID` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `limit_app` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_today`
--

INSERT INTO `appointment_today` (`AT_ID`, `status`, `limit_app`) VALUES
(1, 'uncheck', 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_info`
--

CREATE TABLE `doctor_info` (
  `doctor_ID` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_info`
--

INSERT INTO `doctor_info` (`doctor_ID`, `firstname`, `lastname`, `specialization`, `username`, `password`, `status`) VALUES
(1, 'John', 'Doe', 'Neurologist', 'john', 'doe', 'Idle'),
(2, 'Jane', 'Doe', 'Nurse', 'jane', 'doe', 'Active'),
(5, 'sample', 'sample', 'sample', 'sample', 'sample', 'Idle');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `patient_ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `dateofbirth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`patient_ID`, `firstname`, `lastname`, `middlename`, `home_address`, `age`, `dateofbirth`) VALUES
(1, 'Julius', 'Domingo', 'Wer', 'Mayumi', 19, '1995-05-05'),
(2, 'Jao', 'Austero', 'Di', 'Mayumi', 2, '1997-06-02'),
(3, 'David', 'Ibanez', 'Mid', 'Pag Asa', 0, '1998-06-08'),
(4, 'daves', 'fdfdf', 'dfd', '2323dfs', 0, '2017-12-31'),
(5, 'dsad', 'sdas', 'sadsa', 'sadsa', 0, '2017-05-07'),
(6, 'Jeo', 'Blanco', 'Blanco', 'Sampaguita St', 0, '2017-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `disease` varchar(50) NOT NULL,
  `temp` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `blood_pressure` varchar(20) NOT NULL,
  `date_transaction` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doctor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_ID`, `patient_ID`, `disease`, `temp`, `height`, `weight`, `blood_pressure`, `date_transaction`, `doctor_ID`) VALUES
(1, 1, 'Lung Cancer', 27, 180, 200, '37/40', '2017-04-30 16:00:00', 1),
(2, 1, 'Tumor', 29, 139, 200, '67/100', '2017-05-01 16:00:00', 1),
(3, 6, 'Cancer', 18, 18, 18, '18', '2017-05-17 16:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_ID`);

--
-- Indexes for table `appointment_today`
--
ALTER TABLE `appointment_today`
  ADD PRIMARY KEY (`AT_ID`);

--
-- Indexes for table `doctor_info`
--
ALTER TABLE `doctor_info`
  ADD PRIMARY KEY (`doctor_ID`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`patient_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `appointment_today`
--
ALTER TABLE `appointment_today`
  MODIFY `AT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `doctor_info`
--
ALTER TABLE `doctor_info`
  MODIFY `doctor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
