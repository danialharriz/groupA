-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 07:32 PM
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
-- Database: `2_databasemanagementsystemyouthventure`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseID` varchar(6) NOT NULL,
  `OrganizationID` varchar(6) NOT NULL,
  `CourseName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `OrganizationID`, `CourseName`) VALUES
('C00002', 'O00002', 'Bachelor of Computer Science (Software Engineering) with Honours'),
('C00003', 'O00002', 'Bachelor of Computer Science (Data Engineering) with Honours'),
('C00004', 'O00002', 'Bachelor of Computer Science (Bioinformatics) with Honours'),
('C00005', 'O00002', 'Bachelor of Computer Science (Network and Cybersecurity) with Honours'),
('C00006', 'O00002', 'Bachelor of Computer Science (Graphics and Multimedia Software) with Honours'),
('C00007', 'O00003', 'Data Science'),
('C00008', 'O00003', 'Mechanical Engineering'),
('C00009', 'O00003', 'Software Engineering'),
('C00010', 'O00005', 'MBBS');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` varchar(6) NOT NULL,
  `EventName` varchar(45) NOT NULL,
  `Description` text NOT NULL,
  `MaxParticipants` int(11) DEFAULT NULL,
  `Deadline` datetime DEFAULT NULL,
  `StartDateAndTime` datetime DEFAULT NULL,
  `EndDateAndTime` datetime DEFAULT NULL,
  `Location` varchar(255) NOT NULL,
  `EventType` int(1) DEFAULT NULL,
  `RewardPoints` int(11) DEFAULT NULL,
  `OrganizationID` varchar(6) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `Description`, `MaxParticipants`, `Deadline`, `StartDateAndTime`, `EndDateAndTime`, `Location`, `EventType`, `RewardPoints`, `OrganizationID`, `Picture`) VALUES
('E00001', 'PERMAS Induction 6.0', 'Permas', 20, '2024-01-15 08:00:00', '2024-01-18 08:00:00', '2024-01-19 08:00:00', 'UTM', 1, 10, 'O00001', NULL),
('E00002', 'YTM Event', 'YTM Scholars', 50, '2024-01-15 21:00:00', '2024-01-20 08:00:00', '2024-01-21 08:00:00', 'UTM', 1, 10, 'O00006', NULL),
('E00003', 'Programming Workshop 2.0', 'C++, JAVA', 35, '2024-01-15 21:45:00', '2024-01-25 08:00:00', '2024-01-27 13:00:00', 'Faculty of Computing, N28a', 1, 30, 'O00006', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eventoutside`
--

CREATE TABLE `eventoutside` (
  `OEventID` varchar(6) NOT NULL,
  `OEventName` varchar(45) NOT NULL,
  `ODescription` text NOT NULL,
  `OStartDateAndTime` datetime DEFAULT NULL,
  `OEndDateAndTime` datetime DEFAULT NULL,
  `OLocation` varchar(255) NOT NULL,
  `OEventType` int(1) DEFAULT NULL,
  `OOrganization` varchar(255) DEFAULT NULL,
  `approvalStatus` int(1) DEFAULT NULL,
  `studentID` varchar(6) NOT NULL,
  `reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` varchar(6) NOT NULL,
  `ParticipantID` varchar(6) NOT NULL,
  `Feedback` varchar(255) NOT NULL,
  `EventID` varchar(6) NOT NULL,
  `SubmittedDateAndTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `OrganizationID` varchar(6) NOT NULL,
  `OrganizationName` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `City` varchar(45) NOT NULL,
  `State` varchar(45) NOT NULL,
  `Website` varchar(45) NOT NULL,
  `Type` int(1) NOT NULL,
  `ContactEmail` varchar(45) NOT NULL,
  `ContactPhone` int(11) NOT NULL,
  `emailending` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`OrganizationID`, `OrganizationName`, `Address`, `City`, `State`, `Website`, `Type`, `ContactEmail`, `ContactPhone`, `emailending`) VALUES
('O00001', 'YouthVentures Asia', 'Cyberjaya', 'Cyberjaya', 'Selangor', 'www.youthventure.asia', 2, 'admin@youthventure.asia', 2147483647, 'youthventure.com'),
('O00002', 'Universiti Teknologi Malaysia', '1234 Main St', 'San Jose', 'CA', 'www.utm.my', 1, 'admin@utm.my', 2147483647, 'utm.my'),
('O00003', 'Universiti Malaysia Sabah', 'Sepanggar', 'Kota Kinabalu', 'Sabah', 'www.ums.com', 1, 'admin@ums.com', 128493283, 'ums.com'),
('O00004', 'Universiti of Cyberjaya', 'Cyberjaya', 'Cyberjaya', 'Selangor', 'www.cyberjayauni.com', 1, 'admin@cyber.com', 2147483647, 'cyberjayauni.com'),
('O00005', 'Universiti Teknologi MARA', 'Shah Alam', 'Shah Alam', 'Selangor', 'www.uitm.com', 1, 'admin@uitm.com', 1234355689, 'uitm.com'),
('O00006', 'TM', 'Sepanggar', 'Shah Alam', 'Selangor', 'www.tm.com', 2, 'admin@tm.com', 143564572, 'tm.com'),
('O00007', 'HUAWEI', 'Cyberjaya, Selangor', 'Shah Alam', 'Selangor', 'www.huawei.com', 2, 'admin@huawei.com', 1324345646, 'huawei.com');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `ParticipantID` varchar(6) NOT NULL,
  `StudentID` varchar(6) NOT NULL,
  `EventID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`ParticipantID`, `StudentID`, `EventID`) VALUES
('P00001', 'S0001', 'E00002');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `ResumeID` varchar(6) NOT NULL,
  `StudentID` varchar(6) NOT NULL,
  `education` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `additional` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`ResumeID`, `StudentID`, `education`, `experience`, `skills`, `additional`) VALUES
('R0001', 'S0001', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `RewardID` varchar(6) NOT NULL,
  `RewardName` varchar(45) NOT NULL,
  `RewardPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`RewardID`, `RewardName`, `RewardPoints`) VALUES
('R00001', 'Welcome!', 0),
('R00002', 'Novice User', 100),
('R00003', 'Intermediate User', 250),
('R00004', 'Expert User', 500);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(6) NOT NULL,
  `UserID` varchar(6) NOT NULL,
  `OrganizationID` varchar(6) NOT NULL,
  `JobTitle` varchar(45) DEFAULT NULL,
  `validated` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `UserID`, `OrganizationID`, `JobTitle`, `validated`) VALUES
('S0001', 'U0001', 'O00001', 'Developer', 1),
('S0002', 'U0003', 'O00006', 'Normal Staff', 1),
('S0003', 'U0004', 'O00007', 'Normal Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` varchar(6) NOT NULL,
  `UserID` varchar(6) NOT NULL,
  `OrganizationID` varchar(6) DEFAULT NULL,
  `CourseID` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `DateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `UserID`, `OrganizationID`, `CourseID`, `Address`, `Gender`, `DateOfBirth`) VALUES
('S0001', 'U0002', 'O00002', 'Course1', 'Taman Nelly 8', 'M', '2003-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` varchar(6) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(45) NOT NULL,
  `profilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Name`, `Phone`, `Email`, `Password`, `Role`, `profilePic`) VALUES
('U0001', 'SuperAdmin', '', 'admin@youthventure.com', '$2y$10$h2kFsbzhHm6frT8doftx5ORWwnYEw9YW47k0iN/e69GVml6diC3hm', '3', ''),
('U0002', 'Danial Harriz', '', 'danial@gmail.com', '$2y$10$OXFylHff/4rvnTzTWCUmL.idXKSGFa5Z3DWUJ3Hr/7MCu4k2Goc8C', '2', ''),
('U0003', 'Aiman Misah', '', 'aiman@tm.com', '$2y$10$g6ygzByoUGImfUaMqc6XYONJqS.CkZOGlPWFbHmzu1vfu1bhsTISG', '1', ''),
('U0004', 'Awel Alex', '', 'awel@huawei.com', '$2y$10$fDbHTb3SXioNQBLtptp05ennwefMcs5p75QYnET6yoZbTIOrovieG', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `OrganizationID` (`OrganizationID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `OrganizationID` (`OrganizationID`);

--
-- Indexes for table `eventoutside`
--
ALTER TABLE `eventoutside`
  ADD PRIMARY KEY (`OEventID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `EventID` (`EventID`),
  ADD KEY `ParticipantID` (`ParticipantID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`OrganizationID`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`ParticipantID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`ResumeID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`RewardID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `OrganizationID` (`OrganizationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `OrganizationID` (`OrganizationID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`);

--
-- Constraints for table `eventoutside`
--
ALTER TABLE `eventoutside`
  ADD CONSTRAINT `eventOutside_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ParticipantID`) REFERENCES `participant` (`ParticipantID`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
