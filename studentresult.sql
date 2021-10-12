-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 06:15 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentresult`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentName` varchar(100) DEFAULT NULL,
  `StudentSchool` varchar(100) DEFAULT NULL,
  `FathersName` varchar(100) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Hindi` varchar(50) DEFAULT NULL,
  `English` varchar(50) DEFAULT NULL,
  `Maths` varchar(50) DEFAULT NULL,
  `Physics` varchar(50) DEFAULT NULL,
  `Chemistry` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentName`, `StudentSchool`, `FathersName`, `DOB`, `Gender`, `Hindi`, `English`, `Maths`, `Physics`, `Chemistry`) VALUES
('Aditya Dave', 'Pace University', 'Ajit', '14/11/1997', 'Male', '80', '90', '90', '98', '92'),
('Nisarg Jadhav', 'Pace University', 'Ravi', '12/11/1997', 'Male', '70', '50', '90', '10', '15'),
('Vishwa', 'Pace University', 'Ramani', '14/05/1997', 'Male', '80', '98', '89', '90', '97');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `UserID` varchar(120) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(1000) DEFAULT NULL,
  `MemberSince` varchar(255) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  `roles` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`UserID`, `UserName`, `FirstName`, `LastName`, `Email`, `Password`, `MemberSince`, `Active`, `roles`) VALUES
('b5b2da310b', 'aditya81', 'Aditya', 'Dave', 'ad@gmail.com', 'df44cfc4fbc75392ced1f16afde865b7701dd63e12b4383030324640850eb7b81', '1606285745', 1, 'teacher'),
('137d78e919', 'frodobaggins1', 'Frodo', 'Baggins', 'frodo@rings.com', '6d8e166c623f85f0e11302ef91b65bccf05018c2ebd0df6e86316646b98579757', '1606286018', 1, 'student'),
('7b64cee13b', 'gandalfthechosenone', 'Gandalf', 'Gandalf', 'gandalf@ring.com', 'f569a640e3ab86d9918013b1d6480db27805437ae1ec86ec674313d0013b09ffc', '1606285941', 1, 'teacher'),
('b29be95edc', 'gollum20', 'Gollum', 'Precious', 'gollum@123.com', 'd6aaf5b24a1a73b82186c2124bd0e6a96a5925487687e845167d624d5a669faaf', '1606285873', 1, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`UserName`,`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
