<?php
/*
database
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
*/

class feedback{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addfeedback($data){
        $this->db->query('INSERT INTO feedback (FeedbackID, ParticipantID, Feedback, EventID, SubmittedDateAndTime) VALUES(:feedbackId, :participantId, :feedback, :eventId, :submittedDateAndTime)');

        //Bind values
        $this->db->bind(':feedbackId', $data['feedback_id']);
        $this->db->bind(':participantId', $data['participant_id']);
        $this->db->bind(':feedback', $data['feedback']);
        $this->db->bind(':eventId', $data['event_id']);
        $this->db->bind(':submittedDateAndTime', $data['submitted_date_and_time']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getmaxfeedbackId(){
        $this->db->query('SELECT MAX(FeedbackID) AS max FROM feedback');

        $row = $this->db->single();

        return $row->max;
    }

    public function getfeedbackByParticipantId($participantId){
        $this->db->query('SELECT * FROM feedback WHERE ParticipantID = :participantId');

        $this->db->bind(':participantId', $participantId);

        $results = $this->db->resultSet();

        return $results;
    }
    //get all feedback of a event
    public function getfeedbackByEventId($eventId){
        $this->db->query('SELECT * FROM feedback WHERE EventID = :eventId');

        $this->db->bind(':eventId', $eventId);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllfeedback(){
        $this->db->query('SELECT * FROM feedback');

        $results = $this->db->resultSet();

        return $results;
    }

    public function updatefeedback($data){
        $this->db->query('UPDATE feedback SET ParticipantID = :participantId, Feedback = :feedback, EventID = :eventId, SubmittedDateAndTime = :submittedDateAndTime WHERE FeedbackID = :feedbackId');

        //Bind values
        $this->db->bind(':feedbackId', $data['feedback_id']);
        $this->db->bind(':participantId', $data['participant_id']);
        $this->db->bind(':feedback', $data['feedback']);
        $this->db->bind(':eventId', $data['event_id']);
        $this->db->bind(':submittedDateAndTime', $data['submitted_date_and_time']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletefeedbackByParticipantId($participantId){
        $this->db->query('DELETE FROM feedback WHERE ParticipantID = :participantId');

        $this->db->bind(':participantId', $participantId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>