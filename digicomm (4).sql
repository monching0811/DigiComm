-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 11:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digicomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_id_applications`
--

CREATE TABLE `barangay_id_applications` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending',
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_id_applications`
--

INSERT INTO `barangay_id_applications` (`id`, `firstName`, `middleName`, `lastName`, `address`, `birthdate`, `mobile_number`, `occupation`, `profilePicture`, `application_date`, `status`, `age`) VALUES
(6, 'Michelle', 'Almirol', 'Lipoco', '#123 valenzuela', '2005-03-24', '09892134651', 'none', 'uploads/d.jfif', '2025-04-15 13:16:44', 'Pending', 20);

-- --------------------------------------------------------

--
-- Table structure for table `business_permit_applications`
--

CREATE TABLE `business_permit_applications` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `businessName` varchar(255) NOT NULL,
  `businessAddress` varchar(255) NOT NULL,
  `businessType` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_permit_applications`
--

INSERT INTO `business_permit_applications` (`id`, `firstName`, `middleName`, `lastName`, `address`, `businessName`, `businessAddress`, `businessType`, `mobile_number`, `application_date`, `status`) VALUES
(3, 'Michelle', 'Almirol', 'Lipoco', '#123 valenzuela', 'Mitchiko\'s Tech Supply', '#123 valenzula, bignay', 'Sole proprietorships', '09892134651', '2025-04-15 13:17:07', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cedula_applications`
--

CREATE TABLE `cedula_applications` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `civilStatus` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cedula_applications`
--

INSERT INTO `cedula_applications` (`id`, `firstName`, `middleName`, `lastName`, `address`, `birthdate`, `birthplace`, `civilStatus`, `citizenship`, `occupation`, `age`, `application_date`, `status`) VALUES
(3, 'Michelle', 'Almirol', 'Lipoco', '#123 valenzuela', '2005-03-24', 'valenzuela, bignay', 'single', 'filipino', 'none', 20, '2025-04-15 13:15:43', 'Pending'),
(4, 'michelle', 'almirol', 'lipoco', '#163 sitio gulodd, sapang palay, san jose del monte, bulacam 2009', '2005-03-24', 'valenzuela, bignay', 'single', 'filipino', 'none', 20, '2025-04-22 03:49:57', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `clearance_applications`
--

CREATE TABLE `clearance_applications` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `purpose` text NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_applications`
--

INSERT INTO `clearance_applications` (`id`, `firstName`, `middleName`, `lastName`, `address`, `birthdate`, `age`, `purpose`, `application_date`, `status`) VALUES
(4, 'Michelle', 'Almirol', 'Lipoco', '#123 valenzuela', '2005-03-24', 20, 'school', '2025-04-15 13:16:21', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `indigency_applications`
--

CREATE TABLE `indigency_applications` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `purpose` text NOT NULL,
  `householdMembers` int(11) NOT NULL,
  `monthlyIncome` decimal(10,2) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indigency_applications`
--

INSERT INTO `indigency_applications` (`id`, `firstName`, `middleName`, `lastName`, `address`, `birthdate`, `age`, `purpose`, `householdMembers`, `monthlyIncome`, `application_date`, `status`) VALUES
(5, 'Michelle', 'Almirol', 'Lipoco', '#123 valenzuela', '2005-03-24', 20, 'school', 5, 0.00, '2025-04-15 13:16:05', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `registered_residents`
--

CREATE TABLE `registered_residents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_residents`
--

INSERT INTO `registered_residents` (`id`, `first_name`, `last_name`) VALUES
(2, 'almond', 'gugulan'),
(4, 'Cyrus', 'Concepcion'),
(3, 'jimuel', 'paragas'),
(5, 'judine', 'esparago'),
(1, 'Michelle', 'Lipoco');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `complete_address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `civil_status` varchar(255) DEFAULT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `first_name`, `middle_name`, `last_name`, `birthdate`, `age`, `complete_address`, `mobile_number`, `email_address`, `username`, `password_hash`, `is_verified`, `civil_status`, `citizenship`, `registration_date`) VALUES
(6, 'michelle', 'almirol', 'lipoco', '2005-03-24', 20, '#163 sitio gulodd, sapang palay, san jose del monte, bulacam 2009', '09777768794', 'mitch123@gmail.com', 'mitch123', '$2y$10$RTaH92odxeYQD9f4U535uur1PXyi5wbKNNuDxpLOKE0pB3p8Tz.tq', 1, 'single', 'filipino', '2025-04-18 14:04:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_id_applications`
--
ALTER TABLE `barangay_id_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_permit_applications`
--
ALTER TABLE `business_permit_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cedula_applications`
--
ALTER TABLE `cedula_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clearance_applications`
--
ALTER TABLE `clearance_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indigency_applications`
--
ALTER TABLE `indigency_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_residents`
--
ALTER TABLE `registered_residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`first_name`,`last_name`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_id_applications`
--
ALTER TABLE `barangay_id_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `business_permit_applications`
--
ALTER TABLE `business_permit_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cedula_applications`
--
ALTER TABLE `cedula_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clearance_applications`
--
ALTER TABLE `clearance_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `indigency_applications`
--
ALTER TABLE `indigency_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registered_residents`
--
ALTER TABLE `registered_residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
