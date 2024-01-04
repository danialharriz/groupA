-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 11:25 AM
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
DROP DATABASE IF EXISTS `2_databasemanagementsystemyouthventure`;
CREATE DATABASE IF NOT EXISTS `2_databasemanagementsystemyouthventure` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `2_databasemanagementsystemyouthventure`;

CREATE TABLE `course` (
    `CourseID` varchar(6) NOT NULL,
    `InstitudeID` varchar(6) NOT NULL,
    `CourseName` varchar(45) NOT NULL,
    PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `event`
--

CREATE TABLE `eventOutside` (
    `OEventID` varchar(6) NOT NULL,
    `OEventName` varchar(45) NOT NULL,
    `ODescription` text NOT NULL,
    `OStartDateAndTime` datetime NULL,
    `OEndDateAndTime` datetime NULL,
    `OLocation` varchar(255) NOT NULL,
    `OEventType` int(1) NULL,
    `OOrganization` varchar(255) NULL,
    `approvalStatus` int(1) NULL,
    PRIMARY KEY (`OEventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `event` (
    `EventID` varchar(6) NOT NULL,
    `EventName` varchar(45) NOT NULL,
    `Description` text NOT NULL,
    `StartDateAndTime` datetime NULL,
    `EndDateAndTime` datetime NULL,
    `Location` varchar(255) NOT NULL,
    `EventType` int(1) NULL,
    `RewardPoints` int(11) NULL,
    `OrganizationID` varchar(6) NULL,
    PRIMARY KEY (`EventID`),
    KEY `OrganizationID` (`OrganizationID`),
    CONSTRAINT `event_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
    `FeedbackID` varchar(6) NOT NULL,
    `ParticipantID` varchar(6) NOT NULL,
    `Feedback` varchar(255) NOT NULL,
    `EventID` varchar(6) NOT NULL,
    `SubmittedDateAndTime` datetime NOT NULL,
    PRIMARY KEY (`FeedbackID`),
    KEY `EventID` (`EventID`),
    KEY `ParticipantID` (`ParticipantID`),
    CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`),
    CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ParticipantID`) REFERENCES `participant` (`ParticipantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
    `emailending` varchar(45) NOT NULL,
    PRIMARY KEY (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
    `ParticipantID` varchar(6) NOT NULL,
    `StudentID` varchar(6) NOT NULL,
    `EventID` varchar(6) NOT NULL,
    `Attendance` varchar(15) NULL,
    PRIMARY KEY (`ParticipantID`),
    KEY `StudentID` (`StudentID`),
    KEY `EventID` (`EventID`),
    CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
    CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
    `StaffID` varchar(6) NOT NULL,
    `UserID` varchar(6) NOT NULL,
    `OrganizationID` varchar(6) NOT NULL,
    `Type` varchar(45) NULL,
    `JobTitle` varchar(45) NULL,
    `validated` int(1) NULL,
    PRIMARY KEY (`StaffID`),
    KEY `OrganizationID` (`OrganizationID`),
    KEY `UserID` (`UserID`),
    CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
    CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume` (
    `ResumeID` varchar(6) NOT NULL,
    `StudentID` varchar(6) NOT NULL,
    `Resume` text NULL,
    PRIMARY KEY (`ResumeID`),
    KEY `StudentID` (`StudentID`),
    CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
    `StudentID` varchar(6) NOT NULL,
    `UserID` varchar(6) NOT NULL,
    `OrganizationID` varchar(6) NULL,
    `CourseID` varchar(6) NOT NULL,
    `Address` varchar(255) NOT NULL,
    `Gender` varchar(1) NOT NULL,
    `DateOfBirth` date NOT NULL,
    PRIMARY KEY (`StudentID`),
    KEY `CourseID` (`CourseID`),
    KEY `UserID` (`UserID`),
    KEY `OrganizationID` (`OrganizationID`),
    CONSTRAINT `student_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`),
    CONSTRAINT `student_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
    CONSTRAINT `student_ibfk_3` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
    `UserID` varchar(6) NOT NULL,
    `Name` varchar(45) NOT NULL,
    `NickName` varchar(45) NOT NULL,
    `Phone` varchar(45) NOT NULL,
    `Email` varchar(45) NOT NULL,
    `Password` varchar(255) NOT NULL,
    `Role` varchar(45) NOT NULL,
    `profilePic` varchar(255) NOT NULL,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;


INSERT INTO `organization` (`OrganizationID`, `OrganizationName`, `Address`, `City`, `State`, `Website`, `Type`, `ContactEmail`, `ContactPhone`, `emailending`) VALUES
('O00001', 'Youth Venture', '1234 Main St', 'San Jose', 'CA', 'www.youthventure.com', 2, 'admin@youthventure.com', 4081234567, 'youthventure.com'),
('O00002', 'institute1', '1234 Main St', 'San Jose', 'CA', 'www.institutetest.com', 1, 'admin@institutetest.com', 4081234567, 'institutetest.com');

INSERT INTO `course` (`CourseID`, `InstitudeID`, `CourseName`) VALUES
('C00001', 'O00002', 'Course1');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*add a sample data user*/
