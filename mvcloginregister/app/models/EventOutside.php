<?php
/*
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
    `studentID` varchar(6) NOT NULL,
    KEY `studentID` (`studentID`),
    CONSTRAINT `eventOutside_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`),
    PRIMARY KEY (`OEventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/


class EventOutside{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addEvent($data){
        $this->db->query('INSERT INTO eventOutside (OEventID, OEventName, ODescription, OStartDateAndTime, OEndDateAndTime, OLocation, OEventType, OOrganization, approvalStatus, studentID) VALUES(:eventId, :eventName, :description, :startDateAndTime, :endDateAndTime, :location, :eventType, :organization, :approvalStatus, :studentId)');

        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateTime']);
        $this->db->bind(':endDateAndTime', $data['endDateTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':organization', $data['organization']);
        $this->db->bind(':approvalStatus', $data['approvalStatus']);
        $this->db->bind(':studentId', $data['studentId']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function approveEvent($eventId){
        $this->db->query('UPDATE eventOutside SET approvalStatus = 1 WHERE OEventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $eventId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function rejectEvent($eventId){
        $this->db->query('UPDATE eventOutside SET approvalStatus = 2 WHERE OEventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $eventId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEventNA(){
        $this->db->query('SELECT * FROM eventOutside WHERE approvalStatus = 0');
        $results = $this->db->resultSet();

        return $results;
    }

    public function getEventById($eventId){
        $this->db->query('SELECT * FROM eventOutside WHERE OEventID = :eventId');

        $this->db->bind(':eventId', $eventId);

        $row = $this->db->single();

        return $row;
    }

    public function updateEvent($data){
        $this->db->query('UPDATE eventOutside SET OEventName = :eventName, ODescription = :description, OStartDateAndTime = :startDateAndTime, OEndDateAndTime = :endDateAndTime, OLocation = :location, OEventType = :eventType, OOrganization = :organization, approvalStatus = :approvalStatus WHERE OEventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateTime']);
        $this->db->bind(':endDateAndTime', $data['endDateTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':organization', $data['organization']);
        $this->db->bind(':approvalStatus', $data['approvalStatus']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($eventId){
        $this->db->query('DELETE FROM eventOutside WHERE OEventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $eventId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getEventByStudentId($studentId){
        $this->db->query('SELECT * FROM eventOutside WHERE studentID = :studentId');

        $this->db->bind(':studentId', $studentId);

        $results = $this->db->resultSet();

        return $results;
    }
    //get the max event id
    public function getMaxEventId(){
        $this->db->query('SELECT MAX(OEventID) AS id FROM eventOutside');

        $row = $this->db->single();

        if($row){
            return $row->id;
        }else{
            return false;
        }
    }
    public function getEventByStudentIdApproved($studentId){
        $this->db->query('SELECT * FROM eventOutside WHERE studentID = :studentId AND approvalStatus = 1');

        $this->db->bind(':studentId', $studentId);

        $results = $this->db->resultSet();

        return $results;
    }
}

