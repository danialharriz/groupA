<?php
/*
database
CREATE TABLE `student` (
    `StudentID` varchar(6) NOT NULL,
    `UserID` varchar(6) NOT NULL,
    `OrganizationID` varchar(6) NOT NULL,
    `CourseID` varchar(6) NOT NULL,
    `Address` varchar(45) NOT NULL,
    `resumeID` varchar(6) NOT NULL,
    PRIMARY KEY (`StudentID`),
    KEY `CourseID` (`CourseID`),
    KEY `UserID` (`UserID`),
    KEY `OrganizationID` (`OrganizationID`),
    KEY `resumeID` (`resumeID`),
    CONSTRAINT `student_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`),
    CONSTRAINT `student_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
    CONSTRAINT `student_ibfk_3` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
    CONSTRAINT `student_ibfk_4` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`ResumeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/