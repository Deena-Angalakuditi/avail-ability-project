-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Nov 08, 2023 at 06:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `username` varchar(25) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(20) NOT NULL,
  `conpass` varchar(20) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `role1` varchar(20) NOT NULL,
  `role2` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`username`, `email`, `pass`, `conpass`, `dept`, `role1`, `role2`, `status`, `description`) VALUES
('jaswanth', 'Kish8515@gmail.com', 'jash', 'jash', 'cse', 'faculty', '', 'Absent', 'avialable'),
('jaswanth', 'nainikakolagatla7511', 'jash', 'jash', 'eee', 'faculty', '', 'Active', 'i am avialabe'),
('jaswanth', 'nainikakolagatla7511', 'jash', 'jash', 'eee', 'faculty', '', 'Active', 'i am avialabe'),
('nagarjuna', 'nainikakolagatla7511', 'jash', 'jash', 'cse', 'lab_assistant', '', 'Active', 'i am avialabe'),
('sai', 'o190006rguktong@gmai', 'jash', 'jash', 'cse', 'warden', '', '', ''),
('jaswanth', 'nainikakolagatla7511', 'jash', 'jash', 'cse', 'faculty', '', 'Active', 'i am avialabe'),
('baquee', 'jashuu@gmail.com', 'jash', 'jash', 'mech', 'faculty', '', 'Active', 'i am available'),
('jaswanth', 'jashuu4@gmail.com', 'jash', 'jash', 'non teaching staff', 'hospital', '', 'Absent', ''),
('jaswanth', 'jashuu5@gmail.com', 'jash', 'jash', 'mech', '', '', '', ''),
('jaswanth', 'jashuu6@gmail.com', 'jash', 'jash', 'cse', 'faculty', 'scholarship', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
