-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2026 at 07:57 PM
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
  `coursecode` varchar(50) NOT NULL,
  `units` int(2) NOT NULL,
  `year_level` int(11) NOT NULL DEFAULT 1 COMMENT 'Year Level (1st - 4th Year)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`coursecodeid`, `coursetitle`, `coursecode`, `units`, `year_level`) VALUES
(3, 'Title', 'Code123', 3, 1),
(5, 'Title', 'Code234', 3, 1),
(7, 'I duuuunno', 'CSIT222', 3, 2);

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
-- Table structure for table `tbleducation`
--

CREATE TABLE `tbleducation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `year_graduated` year(4) NOT NULL
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
(6, '2'),
(13, '1'),
(14, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblprogram`
--

CREATE TABLE `tblprogram` (
  `programid` int(11) NOT NULL,
  `programname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprogram`
--

INSERT INTO `tblprogram` (`programid`, `programname`) VALUES
(1, 'BSCS'),
(2, 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `tblsection`
--

CREATE TABLE `tblsection` (
  `sectionid` int(11) NOT NULL,
  `sectionname` varchar(50) NOT NULL,
  `yearlevel` int(11) NOT NULL,
  `programid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsection`
--

INSERT INTO `tblsection` (`sectionid`, `sectionname`, `yearlevel`, `programid`) VALUES
(1, 'S69', 3, 2),
(2, 'F1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblteachingassignment`
--

CREATE TABLE `tblteachingassignment` (
  `assignmentid` int(11) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `section` varchar(50) NOT NULL,
  `coursecodeid` int(11) NOT NULL
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
(6, 'James Kenneth', 'Acabal', '2004-06-19', 'M', 'jameskenneth.acabal@cit.edu', '09123456789', '$2y$10$JDpitA7cbdSUH.Mjn7M8DuYYf2vFcap8GrA4sOzMTceTEJPUKsGhK', 'PT'),
(13, 'name', 'last', '2026-05-01', 'M', 'email@email.com', '123', '$2y$10$y7HVieZwS7.XTGEdK9BBTuw7uWX4TJVUa3rpZnqRYysu98kibNWya', 'PT'),
(14, 'jani', 'tor', '2026-05-01', 'M', 'jksa@cit.edu', '123456789', '$2y$10$nbrcidergUOOy3cXK/YriOWq6qAhiUHaREjAR/hm0E4xen2nDmvie', 'FT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`coursecodeid`),
  ADD UNIQUE KEY `coursecode_2` (`coursecode`),
  ADD KEY `coursecode` (`coursecode`);

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
-- Indexes for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_education_id_user` (`user_id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD KEY `fk_faculty_user_id_user` (`id`);

--
-- Indexes for table `tblprogram`
--
ALTER TABLE `tblprogram`
  ADD PRIMARY KEY (`programid`);

--
-- Indexes for table `tblsection`
--
ALTER TABLE `tblsection`
  ADD PRIMARY KEY (`sectionid`);

--
-- Indexes for table `tblteachingassignment`
--
ALTER TABLE `tblteachingassignment`
  ADD PRIMARY KEY (`assignmentid`),
  ADD KEY `fk_teachingassignment_coursecodeid_course` (`coursecodeid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `coursecodeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcourseschedule`
--
ALTER TABLE `tblcourseschedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbleducation`
--
ALTER TABLE `tbleducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblprogram`
--
ALTER TABLE `tblprogram`
  MODIFY `programid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsection`
--
ALTER TABLE `tblsection`
  MODIFY `sectionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldepartmenthead`
--
ALTER TABLE `tbldepartmenthead`
  ADD CONSTRAINT `fk_dept_head_id_user` FOREIGN KEY (`id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD CONSTRAINT `fk_education_id_user` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD CONSTRAINT `fk_faculty_user_id_user` FOREIGN KEY (`id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblteachingassignment`
--
ALTER TABLE `tblteachingassignment`
  ADD CONSTRAINT `fk_teachingassignment_coursecodeid_course` FOREIGN KEY (`coursecodeid`) REFERENCES `tblcourse` (`coursecodeid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
