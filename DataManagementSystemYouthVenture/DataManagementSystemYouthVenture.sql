/*Drop Database if required, comment or uncomment line 2*/
DROP DATABASE IF EXISTS `DataManagementSystemYouthVenture`;

CREATE DATABASE IF NOT EXISTS `DataManagementSystemYouthVenture`;

USE `DataManagementSystemYouthVenture`;

CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Nickname` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(255) NULL,
  `Role` VARCHAR(45) NULL, /* 0 for admin, 1 for student, 2 for lecturer, 3 for partner company staff */
  `profilePic` VARCHAR(255) NULL,
  PRIMARY KEY (`UserID`)
);

CREATE TABLE IF NOT EXISTS `Organization`(
    `OrganizationID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(45) NULL,
    `Address` VARCHAR(45) NULL,
    `City` VARCHAR(45) NULL,
    `State` VARCHAR(45) NULL,
    `Organiser` INT NULL,
    `Website` VARCHAR(45) NULL,
    `ContactEmail` VARCHAR(45) NULL,
    `ContactPhone` INT NULL,
    PRIMARY KEY (`OrganizationID`)
);

CREATE TABLE IF NOT EXISTS `Company`(
    `CompanyID` INT NOT NULL AUTO_INCREMENT,
    `OrganizationID` INT NOT NULL,
    PRIMARY KEY (`CompanyID`),
    FOREIGN KEY (`OrganizationID`) REFERENCES `Organization`(`OrganizationID`)
);

CREATE TABLE IF NOT EXISTS `Institute`(
    `InstituteID` INT NOT NULL AUTO_INCREMENT,
    `OrganizationID` INT NOT NULL,
    PRIMARY KEY (`InstituteID`),
    FOREIGN KEY (`OrganizationID`) REFERENCES `Organization`(`OrganizationID`)
);


CREATE TABLE IF NOT EXISTS `Course`(
    `CourseID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(45) NULL,
    `InstituteID` INT NOT NULL,
    PRIMARY KEY (`CourseID`),
    FOREIGN KEY (`InstituteID`) REFERENCES `Institute`(`InstituteID`)
);

CREATE TABLE IF NOT EXISTS `Student`(   
    `UserID` INT NOT NULL,
    `MatricNo` VARCHAR(2555) NULL,
    `InstituteID` INT NOT NULL,
    `CourseID` INT NOT NULL,
    `Resume` TEXT NULL,
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`InstituteID`) REFERENCES `Institute`(`InstituteID`),
    FOREIGN KEY (`CourseID`) REFERENCES `Course`(`CourseID`),
    PRIMARY KEY (`UserID`,`InstituteID`)
);

CREATE TABLE IF NOT EXISTS `Event`(
    `EventID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(45) NULL,
    `Description` TEXT NULL,
    `StartDateAndTime` DATETIME NULL,
    `EndDateAndTime` DATETIME NULL,
    `Location` VARCHAR(45) NULL,
    `EventType` INT NULL, /* 0 for workshop, 1 for competition, 2 for seminar, 3 for talk */
    `RewardPoints` INT NULL,
    `OrganizationID` INT NULL,
    `UserID` INT NULL,
    PRIMARY KEY (`EventID`),
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`OrganizationID`) REFERENCES `Organization`(`OrganizationID`)
);

CREATE TABLE IF NOT EXISTS `Participants`(
    `UserID` INT NOT NULL,
    `EventID` INT NOT NULL,
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`EventID`) REFERENCES `Event`(`EventID`),
    PRIMARY KEY (`UserID`,`EventID`)
);

CREATE TABLE IF NOT EXISTS `EventFeedBack`(
    `FeedBackID` INT NOT NULL AUTO_INCREMENT,
    `UserID` INT NOT NULL,
    `EventID` INT NOT NULL,
    `FeedBack` VARCHAR(255) NULL,
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`EventID`) REFERENCES `Event`(`EventID`),
    PRIMARY KEY (`FeedBackID`)
);

CREATE TABLE IF NOT EXISTS `Lecturer`(
    `StaffID` INT NOT NULL,
    `UserID` INT NOT NULL,
    `InstituteID` INT NOT NULL,
    `CourseID` INT NOT NULL,
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`InstituteID`) REFERENCES `Institute`(`InstituteID`),
    FOREIGN KEY (`CourseID`) REFERENCES `Course`(`CourseID`),
    PRIMARY KEY (`StaffID`,`InstituteID`)
);

CREATE TABLE IF NOT EXISTS `CompanyStaff`(
    `StaffID` INT NOT NULL,
    `UserID` INT NOT NULL,
    `CompanyID` INT NOT NULL,
    FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`),
    FOREIGN KEY (`CompanyID`) REFERENCES `Company`(`CompanyID`),
    PRIMARY KEY (`StaffID`,`CompanyID`)
);
