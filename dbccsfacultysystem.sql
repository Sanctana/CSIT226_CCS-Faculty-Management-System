-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2026 at 03:07 PM
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
-- Database: `dbccsfacultysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `coursecodeid` int(11) NOT NULL,
  `coursetitle` varchar(50) NOT NULL,
  `lectureunits` int(2) NOT NULL,
  `labunits` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcourseschedule`
--

CREATE TABLE `tblcourseschedule` (
  `scheduleid` int(11) NOT NULL,
  `dayofweek` enum('M','T','W','TH','F','SAT','SUN') NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `roomtype` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `roomnumber` varchar(50) NOT NULL,
  `assignmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartmenthead`
--

CREATE TABLE `tbldepartmenthead` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `id` int(11) NOT NULL,
  `specialization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`id`, `specialization`) VALUES
(1, '1'),
(3, '4'),
(6, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tblprogram`
--

CREATE TABLE `tblprogram` (
  `programname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsection`
--

CREATE TABLE `tblsection` (
  `sectionname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblteachingassignment`
--

CREATE TABLE `tblteachingassignment` (
  `assignmentid` int(11) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `section` varchar(50) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `sectionname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employeestatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `firstname`, `lastname`, `birthdate`, `gender`, `email`, `contactnumber`, `password`, `employeestatus`) VALUES
(1, 'Joel Theo', 'Gallardo', '2026-07-15', 'M', 'joeltheo.gallardo@cit.edu', '09123456789', '$2y$10$8arqDZp3PNWCg0KcbVCZoO056UwMFYQALLQ2g.pU7mOFUROdCRrCu', 'PT'),
(3, 'Saint Tria', 'Tangpos', '2005-11-02', 'M', 'sainttria.tangpos@cit.edu', '09123456789', '$2y$10$698fzipaJYNEKZdHt693ouIG2tDH4urdKpYR49es8i6iH7tzCrwta', 'FT'),
(6, 'James Kenneth', 'Acabal', '2004-06-19', 'M', 'jameskenneth.acabal@cit.edu', '09123456789', '$2y$10$JDpitA7cbdSUH.Mjn7M8DuYYf2vFcap8GrA4sOzMTceTEJPUKsGhK', 'PT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`coursecodeid`);

--
-- Indexes for table `tblcourseschedule`
--
ALTER TABLE `tblcourseschedule`
  ADD PRIMARY KEY (`scheduleid`);

--
-- Indexes for table `tbldepartmenthead`
--
ALTER TABLE `tbldepartmenthead`
  ADD KEY `fk_dept_head_id_user` (`id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD KEY `fk_faculty_user_id_user` (`id`);

--
-- Indexes for table `tblsection`
--
ALTER TABLE `tblsection`
  ADD PRIMARY KEY (`sectionname`);

--
-- Indexes for table `tblteachingassignment`
--
ALTER TABLE `tblteachingassignment`
  ADD PRIMARY KEY (`assignmentid`),
  ADD KEY `fk_teachingassignment_coursecodeid_course` (`coursecodeid`),
  ADD KEY `fk_teachingassignment_sectionname_section` (`sectionname`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcourseschedule`
--
ALTER TABLE `tblcourseschedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldepartmenthead`
--
ALTER TABLE `tbldepartmenthead`
  ADD CONSTRAINT `fk_dept_head_id_user` FOREIGN KEY (`id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD CONSTRAINT `fk_faculty_user_id_user` FOREIGN KEY (`id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblteachingassignment`
--
ALTER TABLE `tblteachingassignment`
  ADD CONSTRAINT `fk_teachingassignment_coursecodeid_course` FOREIGN KEY (`coursecodeid`) REFERENCES `tblcourse` (`coursecodeid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teachingassignment_sectionname_section` FOREIGN KEY (`sectionname`) REFERENCES `tblsection` (`sectionname`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
