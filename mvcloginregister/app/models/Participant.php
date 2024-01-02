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

    public function addParticipant($data){
        $this->db->query('INSERT INTO participant (ParticipantID, StudentID, EventID, Attendance) VALUES(:participantId, :studentId, :eventId, :attendance)');

        //Bind values
        $this->db->bind(':participantId', $data['participant_id']);
        $this->db->bind(':studentId', $data['student_id']);
        $this->db->bind(':eventId', $data['event_id']);
        $this->db->bind(':attendance', $data['attendance']);

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
    public function cancel_participation($userid, $eventid){
        $this->db->query('DELETE FROM participant WHERE StudentID = :userid AND EventID = :eventid');

        $this->db->bind(':userid', $userid);
        $this->db->bind(':eventid', $eventid);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>