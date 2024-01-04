<?php
/*
database
CREATE TABLE `participant` (
    `ParticipantID` varchar(6) NOT NULL,
    `StudentID` varchar(6) NOT NULL,
    `EventID` varchar(6) NOT NULL,
    `Attendance` varchar(15) NOT NULL,
    PRIMARY KEY (`ParticipantID`),
    KEY `StudentID` (`StudentID`),
    KEY `EventID` (`EventID`),
    CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
    CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/

class Participant{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    //get last participant id
    public function getLastParticipantId(){
        $this->db->query('SELECT ParticipantID FROM participant ORDER BY ParticipantID DESC LIMIT 1');

        $results = $this->db->single();

        return $results->ParticipantID;
    }

    public function addParticipant($data){
        $this->db->query('INSERT INTO participant (ParticipantID, StudentID, EventID) VALUES(:participantId, :studentId, :eventId)');

        //Bind values
        $this->db->bind(':participantId', $data['participant_id']);
        $this->db->bind(':studentId', $data['student_id']);
        $this->db->bind(':eventId', $data['event_id']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //get participant by event id
    public function getParticipantByEventId($eventId){
        $this->db->query('SELECT * FROM participant WHERE EventID = :eventId');

        $this->db->bind(':eventId', $eventId);

        $results = $this->db->resultSet();

        return $results;
    }
    
    //get participant by student id
    public function getParticipantByStudentId($studentId){
        $this->db->query('SELECT * FROM participant WHERE StudentID = :studentId');

        $this->db->bind(':studentId', $studentId);

        $results = $this->db->resultSet();

        return $results;
    }
    //get eventid by userid
    public function get_eventid($userid){
        $this->db->query('SELECT EventID FROM participant WHERE StudentID = :userid');

        $this->db->bind(':userid', $userid);

        $results = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $results;
        } else {
            return false;
        }
    }
    public function cancel_participation($participantid){
        $this->db->query('DELETE FROM participant WHERE ParticipantID = :participantid');
        
        $this->db->bind(':participantid', $participantid);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function check_participated($userid, $eventid){
        $this->db->query('SELECT * FROM participant WHERE StudentID = :userid AND EventID = :eventid');

        $this->db->bind(':userid', $userid);
        $this->db->bind(':eventid', $eventid);

        $results = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //get participant id
    public function get_participant_id($studentid, $eventid){
        $this->db->query('SELECT ParticipantID FROM participant WHERE StudentID = :studentid AND EventID = :eventid');

        $this->db->bind(':studentid', $studentid);
        $this->db->bind(':eventid', $eventid);

        $results = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $results->ParticipantID;
        } else {
            return false;
        }
    }
}

?>