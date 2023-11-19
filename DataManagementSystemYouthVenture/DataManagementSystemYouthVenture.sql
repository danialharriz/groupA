CREATE DATABASE IF NOT EXISTS `DataManagementSystemYouthVenture`;

USE `DataManagementSystemYouthVenture`;

CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  'Name' VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(255) NULL,
  'Role' VARCHAR(45) NULL, --0 for admin, 1 for student, 2 for lecturer, 3 for partner company staff
  'profilePic' VARCHAR(255) NULL,
  PRIMARY KEY (`UserID`))

CREATE TABLE IF NOT EXISTS 'Institute'(
    'InstituteID' INT NOT NULL AUTO_INCREMENT,
    'Name' VARCHAR(45) NULL,
    'Address' VARCHAR(45) NULL,
    'City' VARCHAR(45) NULL,
    'State' VARCHAR(45) NULL,
    'Zip' INT NULL,
    'Website' VARCHAR(45) NULL,
    'ContactEmail' VARCHAR(45) NULL,
    'ContactPhone' INT NULL,
    PRIMARY KEY ('InstituteID'))

CREATE TABLE IF NOT EXISTS 'Course'(
    'CourseID' INT NOT NULL AUTO_INCREMENT,
    'Name' VARCHAR(45) NULL,
    'InstituteID' INT NOT NULL,
    PRIMARY KEY ('CourseID'),
    FOREIGN KEY ('InstituteID') REFERENCES 'Institute'('InstituteID'))

CREATE TABLE IF NOT EXISTS 'Student'(   
    'UserID' INT NOT NULL,
    'InstituteID' INT NOT NULL,
    'CourseID' INT NOT NULL,
    'Resume' VARCHAR(45) NULL,
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    FOREIGN KEY ('InstituteID') REFERENCES 'Institute'('InstituteID'),
    FOREIGN KEY ('CourseID') REFERENCES 'Course'('CourseID'),
    PRIMARY KEY ('UserID','InstituteID'))

CREATE TABLE IF NOT EXISTS 'Event'(
    'EventID' INT NOT NULL AUTO_INCREMENT,
    'Name' VARCHAR(45) NULL,
    'Date' DATE NULL,
    'Time' TIME NULL,
    'Location' VARCHAR(45) NULL,
    'Description' VARCHAR(45) NULL,
    PRIMARY KEY ('EventID'))

CREATE TABLE IF NOT EXISTS 'StudentEvent'(
    'StudentID' INT NOT NULL,
    'EventID' INT NOT NULL,
    FOREIGN KEY ('StudentID') REFERENCES 'Student'('ID'),
    FOREIGN KEY ('EventID') REFERENCES 'Event'('EventID'),
    PRIMARY KEY ('StudentID', 'EventID'))

CREATE TABLE IF NOT EXISTS 'EventFeedBack'(
    'FeedBackID' INT NOT NULL AUTO_INCREMENT,
    'StudentID' INT NOT NULL,
    'EventID' INT NOT NULL,
    'Comment' VARCHAR(45) NULL,
    FOREIGN KEY ('StudentID') REFERENCES 'Student'('ID'),
    FOREIGN KEY ('EventID') REFERENCES 'Event'('EventID'),
    PRIMARY KEY ('FeedBackID'))

CREATE TABLE IF NOT EXISTS 'lecturer'(
    'UserID' INT NOT NULL,
    'InstituteID' INT NOT NULL,
    'CourseID' INT NOT NULL,
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    FOREIGN KEY ('InstituteID') REFERENCES 'Institute'('InstituteID'),
    FOREIGN KEY ('CourseID') REFERENCES 'Course'('CourseID'),
    PRIMARY KEY ('UserID','InstituteID'))

CREATE TABLE IF NOT EXISTS 'PartnerCompany'(
    'PartnerCompanyID' INT NOT NULL AUTO_INCREMENT,
    'Name' VARCHAR(45) NULL,
    'Address' VARCHAR(45) NULL,
    'City' VARCHAR(45) NULL,
    'State' VARCHAR(45) NULL,
    'Zip' INT NULL,
    'Website' VARCHAR(45) NULL,
    'ContactEmail' VARCHAR(45) NULL,
    'ContactPhone' INT NULL,
    PRIMARY KEY ('PartnerCompanyID'))

CREATE TABLE IF NOT EXISTS 'PartnerCompanyStaff'(
    'UserID' INT NOT NULL,
    'staffID' INT NOT NULL,
    'PartnerCompanyID' INT NOT NULL,
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    FOREIGN KEY ('PartnerCompanyID') REFERENCES 'PartnerCompany'('PartnerCompanyID'),
    PRIMARY KEY ('UserID','PartnerCompanyID'))

CREATE TABLE IF NOT EXISTS 'UserPost'(
    'PostID' INT NOT NULL AUTO_INCREMENT,
    'UserID' INT NOT NULL,
    'Post' VARCHAR(255) NULL,
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    PRIMARY KEY ('PostID'))

CREATE TABLE IF NOT EXISTS 'Post_Attachment'(
    'AttachmentID' INT NOT NULL AUTO_INCREMENT,
    'PostID' INT NOT NULL,
    'Attachment' VARCHAR(255) NULL,
    FOREIGN KEY ('PostID') REFERENCES 'UserPost'('PostID'),
    PRIMARY KEY ('AttachmentID'))

CREATE TABLE IF NOT EXISTS 'UserPostComment'(
    'CommentID' INT NOT NULL AUTO_INCREMENT,
    'PostID' INT NOT NULL,
    'UserID' INT NOT NULL,
    'Comment' VARCHAR(255) NULL,
    FOREIGN KEY ('PostID') REFERENCES 'UserPost'('PostID'),
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    PRIMARY KEY ('CommentID'))

CREATE TABLE IF NOT EXISTS 'UserPostCommentReply'(
    'ReplyID' INT NOT NULL AUTO_INCREMENT,
    'CommentID' INT NOT NULL,
    'UserID' INT NOT NULL,
    'Reply' VARCHAR(255) NULL,
    FOREIGN KEY ('CommentID') REFERENCES 'UserPostComment'('CommentID'),
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    PRIMARY KEY ('ReplyID'))

CREATE TABLE IF NOT EXISTS 'UserPostLike'(
    'LikeID' INT NOT NULL AUTO_INCREMENT,
    'PostID' INT NOT NULL,
    'UserID' INT NOT NULL,
    FOREIGN KEY ('PostID') REFERENCES 'UserPost'('PostID'),
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    PRIMARY KEY ('LikeID'))

CREATE TABLE IF NOT EXISTS 'Staff'(
    'UserID' INT NOT NULL,
    'StaffID' INT NOT NULL,
    'Type' INT NOT NULL, --0 for full time, 1 for part time
    'Active' INT NOT NULL, --0 for inactive, 1 for active
    'JobTitle' VARCHAR(255) NULL,
    FOREIGN KEY ('UserID') REFERENCES 'Users'('UserID'),
    FOREIGN KEY ('InstituteID') REFERENCES 'Institute'('InstituteID'),
    PRIMARY KEY ('UserID','InstituteID'))

CREATE TABLE IF NOT EXISTS 'JobHistory'(
    'JobHistoryID' INT NOT NULL AUTO_INCREMENT,
    'StaffID' INT NOT NULL,
    'PartnerCompanyID' INT NOT NULL,
    'JobTitle' VARCHAR(255) NULL,
    'StartDate' DATE NOT NULL,
    'EndDate' DATE NULL,
    FOREIGN KEY ('StaffID') REFERENCES 'Staff'('StaffID'),
    FOREIGN KEY ('PartnerCompanyID') REFERENCES 'PartnerCompany'('PartnerCompanyID'),
    PRIMARY KEY ('JobHistoryID'))

CREATE TABLE IF NOT EXISTS 'PartnerCompanyJobHistory'(
    'JobHistoryID' INT NOT NULL AUTO_INCREMENT,
    'PartnerCompanyID' INT NOT NULL,
    'JobTitle' VARCHAR(255) NULL,
    'StartDate' DATE NOT NULL,
    'EndDate' DATE NULL,
    FOREIGN KEY ('PartnerCompanyID') REFERENCES 'PartnerCompany'('PartnerCompanyID'),
    PRIMARY KEY ('JobHistoryID'))

