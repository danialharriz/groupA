<?php
/*
CREATE TABLE `resume` (
    `ResumeID` varchar(6) NOT NULL,
    `StudentID` varchar(6) NOT NULL,
    `Resume` text NOT NULL,
    PRIMARY KEY (`ResumeID`),
    KEY `StudentID` (`StudentID`),
    CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/

class Resume{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function addResume($data) {
        $this->db->query('INSERT INTO Resume (ResumeID, StudentID, Resume) VALUES(:resumeID, :studentID, :resume)');

        //Bind values
        $this->db->bind(':resumeID', $data['resumeID']);
        $this->db->bind(':studentID', $data['studentID']);
        $this->db->bind(':resume', $data['resume']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateResume($data) {
        $this->db->query('UPDATE Resume SET Resume = :resume WHERE ResumeID = :resumeID');

        //Bind values
        $this->db->bind(':resumeID', $data['resumeID']);
        $this->db->bind(':resume', $data['resume']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMaxResumeId() {
        $this->db->query('SELECT MAX(ResumeID) AS ResumeID FROM Resume');
        $row = $this->db->single();
        return $row->ResumeID;
    }

    public function getResume($resumeID) {
        $this->db->query('SELECT * FROM Resume WHERE ResumeID = :resumeID');
        $this->db->bind(':resumeID', $resumeID);
        $row = $this->db->single();
        return $row;
    }

    public function getAllResume() {
        $result = $this->db->query('SELECT ResumeID FROM Resume ORDER BY ResumeID DESC');
        $resumeIds = $result->fetchAll(PDO::FETCH_COLUMN);
        return $resumeIds;
    }

    public function getResumeByStudentID($studentID) {
        $this->db->query('SELECT * FROM Resume WHERE StudentID = :studentID');
        $this->db->bind(':studentID', $studentID);
        $row = $this->db->single();
        return $row;
    }

    public function deleteResume($resumeID) {
        $this->db->query('DELETE FROM Resume WHERE ResumeID = :resumeID');
        $this->db->bind(':resumeID', $resumeID);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}
}