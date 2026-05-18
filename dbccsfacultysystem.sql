-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2026 at 06:22 AM
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
(3, 'Introduction to Computing', 'CSIT111', 3, 1),
(5, 'Fundamentals of Programming', 'CSIT121', 3, 1),
(7, 'Introduction to Computer Systems', 'CS132', 3, 1),
(8, 'Discrete Structures 1', 'CSIT112', 3, 1),
(9, 'Intermediate Programming', 'CSIT122', 3, 1),
(10, 'Platform-based Development 2 (Web)', 'CSIT201', 3, 1),
(11, 'Social Issues and Professional Practice', 'CSIT213', 3, 2),
(12, 'Data Structures and Algorithms', 'CSIT221', 3, 2),
(13, 'Object-oriented Programming 1', 'CSIT227', 3, 2),
(14, 'Networking 1', 'IT227', 3, 2),
(15, 'Platform-based Development 1 (Multimedia)', 'CSIT104', 3, 2),
(16, 'Quantitative Methods', 'CSIT212', 3, 2),
(17, 'Information Management 1', 'CSIT226', 3, 2),
(18, 'Object-oriented Programming 2', 'CSIT228', 3, 2),
(19, 'Human Computer Interaction', 'CSIT238', 3, 2),
(20, 'Platform-based Development 3 (Mobile)', 'CSIT284', 3, 2),
(21, 'Networking 2', 'IT228', 3, 2),
(22, 'Applications Development and Emerging Technologies', 'CSIT321', 3, 3),
(23, 'Information Management 2', 'CSIT327', 3, 3),
(24, 'Project Management for IT', 'IT317', 3, 3),
(25, 'Data Analytics 1', 'IT365', 3, 3),
(26, 'CSIT Elective 3', 'CSITELEC3', 3, 4),
(27, 'CSIT Elective 4', 'CSITELEC4', 3, 4),
(28, 'Information Assurance and Security 2', 'IT386', 3, 4),
(29, 'Capstone and Research 2', 'IT411', 3, 4),
(30, 'Free Elective 2', 'IT-FREEEL2', 3, 4),
(31, 'OJT/Practicum', 'IT412', 3, 4);

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

--
-- Dumping data for table `tblcourseschedule`
--

INSERT INTO `tblcourseschedule` (`scheduleid`, `dayofweek`, `starttime`, `endtime`, `roomtype`, `building`, `roomnumber`, `assignmentid`) VALUES
(1, 'M', '13:00:00', '14:00:00', 'Lab', 'NGE', '101', 1),
(4, 'M', '07:30:00', '10:30:00', 'Laboratory', 'NGE', '201', 3),
(5, 'TH', '08:00:00', '10:00:00', 'Lecture', 'RTL', '303', 3),
(6, 'W', '15:00:00', '18:00:00', 'Laboratory', 'NGE', '204', 4),
(8, 'M', '07:30:00', '10:30:00', 'Laboratory', 'NGE', '204', 5),
(9, 'F', '08:00:00', '10:30:00', 'Lecture', 'RTL', '303', 5),
(11, 'M', '07:30:00', '10:30:00', 'Laboratory', 'NGE', '206', 6),
(12, 'T', '10:30:00', '12:00:00', 'Laboratory', 'NGE', '207', 7),
(13, 'TH', '10:30:00', '12:00:00', 'Lecture', 'RTL', '307', 7),
(15, 'M', '18:00:00', '19:00:00', 'Lecture', 'RTL', '102', 11),
(16, 'W', '18:00:00', '19:00:00', 'Laboratory', 'NGE', '105', 11),
(17, 'M', '13:00:00', '14:00:00', 'Lecture', 'RTL', '307', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartmenthead`
--

CREATE TABLE `tbldepartmenthead` (
  `id` int(11) NOT NULL,
  `leads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldepartmenthead`
--

INSERT INTO `tbldepartmenthead` (`id`, `leads`) VALUES
(19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbleducation`
--

CREATE TABLE `tbleducation` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
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
(16, 'Game Development'),
(17, 'Information Management'),
(19, 'Mobile Development'),
(20, 'UI/UX'),
(21, 'Networking'),
(22, 'Data Analytics'),
(23, 'Networking'),
(24, 'Data Analytics'),
(25, 'Information Management'),
(26, 'Information Management'),
(27, 'Software Engineering'),
(28, 'Web Development'),
(29, 'Data Analytics'),
(30, 'Networking'),
(31, 'Mobile Development'),
(32, 'Information Management'),
(33, 'Game Development'),
(42, 'UI/UX');

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
(2, 'F1', 1, 1),
(4, 'F2', 1, 1),
(5, 'F3', 1, 1),
(6, 'F4', 1, 1),
(7, 'F5', 1, 1),
(8, 'F1', 2, 1),
(9, 'F2', 2, 1),
(10, 'F3', 2, 1),
(11, 'F1', 3, 1),
(12, 'F2', 3, 1),
(13, 'F1', 4, 1),
(14, 'F2', 4, 1),
(15, 'G1', 1, 2),
(16, 'G2', 1, 2),
(17, 'G3', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblteachingassignment`
--

CREATE TABLE `tblteachingassignment` (
  `assignmentid` int(11) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `section` varchar(50) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblteachingassignment`
--

INSERT INTO `tblteachingassignment` (`assignmentid`, `schoolyear`, `section`, `coursecodeid`, `teacherid`) VALUES
(1, '2026-2027', 'F1', 5, 17),
(3, '2026-2027', 'F1', 9, 27),
(4, '2026-2027', 'F2', 17, 32),
(5, '2026-2027', 'G2', 13, 33),
(6, '2026-2027', 'G1', 3, 26),
(7, '2026-2027', 'F1', 17, 25),
(11, '2026-2027', 'F1', 9, 19),
(12, '2026-2027', 'F4', 3, 42);

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
(16, 'Admin', 'Test', '2026-05-10', 'F', 'admin.test@cit.edu', '09123456789', '$2y$10$Gur95H8f5UEaReIKd5Pzx.MUf8fwoiYGngNUZTAZ3lVQM2kkXCCsq', 'Full-Time'),
(17, 'Cherry Lyn', 'Sta. Romana', '2026-05-01', 'F', 'cherrylyn.staromana@cit.edu', '09123456789', '$2y$10$jH./2A1LgIJQWWTqgFNWVuWlsOgZDQ74/I87aiHxyYZVoJlzXakWO', 'Full-Time'),
(19, 'jani', 'tor', '2026-05-05', 'M', 'jksa@cit.edu', '12345678900', '$2y$10$ICY5J5VQYI1CBRSEf8ReQOch22N93IefFNy6l.Ep.n2Xbkdzggbci', 'Part-Time'),
(20, 'Patrick', 'Bacalso', '2026-05-18', 'F', 'patrick.bacalso@cit.edu', '09123456789', '$2y$10$.I2FajnBqfOWHTB3QCKTluUvJsZ7.tuX9vDifOU0uT.remZShnNiG', 'Full-Time'),
(21, 'Jensar Joey', 'Sayson', '2026-05-18', 'M', 'jensarjoey.sayson@cit.edu', '09123456789', '$2y$10$j1XNTH8ptrPGsQrSSADa.Oyk07XtnOXzzlE8kD9nAHgghSo6VorU6', 'Full-Time'),
(22, 'Judy', 'Bernus', '2026-05-01', 'F', 'judy.bernus@cit.edu', '09123456789', '$2y$10$P5KmsupQPLBfbl6yEs87vukm6vdZJSaRlU.jGyP35va.KUUmbPdzy', 'Full-Time'),
(23, 'Roden', 'Ugang', '2026-05-07', 'M', 'roden.ugang@cit.edu', '09123456789', '$2y$10$c0e/3F11JAbf3itpDClCwOLwE2XXvBg1nfrGSL.uehh8lmDAgaBoq', 'Full-Time'),
(24, 'Mattheus  Marcus', 'Contreras', '2026-05-08', 'M', 'mattheusmarcus.contreras@cit.edu', '09123456789', '$2y$10$gAc//PfnvRm0jZri8M2obeI3VeFJh8C.MQDr1ELDtzbNlUlYSRcdS', 'Full-Time'),
(25, 'Frederick', 'Revilleza', '2026-05-13', 'M', 'frederick.revilleza@cit.edu', '09123456789', '$2y$10$iLUYtjG5P9.Zxdhfad8.pOLHnT5QbIhJNOROK8UY3PFxDdbwQIDiG', 'Full-Time'),
(26, 'Myrliza', 'Villamor', '2026-05-01', 'F', 'myrliza.villamor@cit.edu', '09123456789', '$2y$10$.I1RvUR2cMH8vwtwJz0KwutetkuMOTBFKleKhHxavAXOFnmrdWhsi', 'Full-Time'),
(27, 'Jay Vince', 'Serato', '2026-05-09', 'M', 'jayvince.serato@cit.edu', '09123456789', '$2y$10$k1ZTF7TQrlSJQjcjLYkWKeu11J8I2ODja3DKhMNTGJKVJbF/FyO2y', 'Full-Time'),
(28, 'Cheryl', 'Pantaleon', '2026-04-16', 'F', 'cheryl.pantaleon@cit.edu', '09123456789', '$2y$10$hzuEpXCU9Vqvs3ws0pTUl.Meo4bK.boVF0wmXEyzMepslpMQff2FC', 'Full-Time'),
(29, 'Nathaniel', 'Cabansay', '2026-04-23', 'M', 'nathaniel.cabansay@cit.edu', '09123456789', '$2y$10$/KjJtgDCAw3I6UiSQmqeaey83ihBJxa4O39i7yj.b4tC0W7Ja7jhe', 'Full-Time'),
(30, 'Nathaniel', 'Arbasto', '2026-03-12', 'M', 'nathaniel.arbasto@cit.edu', '09123456789', '$2y$10$Gt8EnuMwxLel5T0Ai/8b8uM3OJ8I5eALtSQkki3IeOXZvfQkwY6Pu', 'Full-Time'),
(31, 'Joemarie', 'Amparo', '2025-12-04', 'M', 'joemarie.amparo@cit.edu', '09123456789', '$2y$10$VZDy06gaW2XuJUB151seyehec4VKfZmBBu7WRCL1Pqn2iKGOySLpC', 'Full-Time'),
(32, 'Leah', 'Barbaso', '2026-05-09', 'F', 'leah.barbaso@cit.edu', '09123456789', '$2y$10$.p0m0.1xzM3g/y1PlIRhJ.GBr4Jrrv5KV7M/1mZgmBj1IwzccIEFy', 'Full-Time'),
(33, 'Kenn Migan', 'Gumonan', '2026-05-07', 'M', 'kennmigan.gumonan@cit.edu', '09123456789', '$2y$10$bLWct9c.rSjMzfYI1sKjH.2ZYAFaRpIP/NrlhMxP1TdQBfZQNz2tW', 'Full-Time'),
(42, 'faculty', '2', '2026-05-04', 'M', 'faculty@cit.edu', '09234521234', '$2y$10$3zqIylK9iVVk.SXn7Ig36uR9bWY9dGyniBOWiu2KYuiPghVYsffJO', 'Part-Time');

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
  ADD PRIMARY KEY (`scheduleid`),
  ADD UNIQUE KEY `scheduleid` (`scheduleid`),
  ADD KEY `fk_coursechedule_assignmentid_teachingassignment` (`assignmentid`);

--
-- Indexes for table `tbldepartmenthead`
--
ALTER TABLE `tbldepartmenthead`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_dept_head_id_user` (`id`),
  ADD KEY `fk_dept_head_leads_program` (`leads`);

--
-- Indexes for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_education_id_user` (`faculty_id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD UNIQUE KEY `id` (`id`),
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
  ADD UNIQUE KEY `assignmentid` (`assignmentid`),
  ADD KEY `fk_teachingassignment_coursecodeid_course` (`coursecodeid`),
  ADD KEY `fk_teachingassignment_teacherid_faculty` (`teacherid`);

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
  MODIFY `coursecodeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblcourseschedule`
--
ALTER TABLE `tblcourseschedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbleducation`
--
ALTER TABLE `tbleducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblprogram`
--
ALTER TABLE `tblprogram`
  MODIFY `programid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsection`
--
ALTER TABLE `tblsection`
  MODIFY `sectionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblteachingassignment`
--
ALTER TABLE `tblteachingassignment`
  MODIFY `assignmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcourseschedule`
--
ALTER TABLE `tblcourseschedule`
  ADD CONSTRAINT `fk_coursechedule_assignmentid_teachingassignment` FOREIGN KEY (`assignmentid`) REFERENCES `tblteachingassignment` (`assignmentid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldepartmenthead`
--
ALTER TABLE `tbldepartmenthead`
  ADD CONSTRAINT `fk_dept_head_id_user` FOREIGN KEY (`id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dept_head_leads_program` FOREIGN KEY (`leads`) REFERENCES `tblprogram` (`programid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD CONSTRAINT `fk_education_id_user` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_teachingassignment_teacherid_faculty` FOREIGN KEY (`teacherid`) REFERENCES `tblfaculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
