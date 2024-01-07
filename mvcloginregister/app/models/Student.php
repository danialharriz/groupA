<?php
class Student {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function addStudent($data){
        $this->db->query('INSERT INTO `student`(`StudentID`, `UserID`, `OrganizationID`, `CourseID`, `Address`, `Gender`, `DateOfBirth`)
        VALUES (:studentID, :userID, :organizationID, :courseID, :address, :gender, :dateOfBirth)');
        //Bind values
        $this->db->bind(':studentID', $data['studentID']);
        $this->db->bind(':userID', $data['userID']);
        $this->db->bind(':organizationID', $data['organizationID']);
        $this->db->bind(':courseID', $data['courseID']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dateOfBirth', $data['dateOfBirth']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getOrganizationId($userId) {
        $this->db->query('SELECT OrganizationID FROM student WHERE UserID = :userId');
        $this->db->bind(':userId', $userId);
        $result = $this->db->single();
        return $result;
    }
    
    public function getAllId() {
        $result = $this->db->query('SELECT OrganizationID FROM Organization ORDER BY OrganizationID DESC');
        $organizationIds = $result->fetchAll(PDO::FETCH_COLUMN);
        return $organizationIds;
    }

    //get max id
    public function getMaxStudentId() {
        $result = $this->db->query('SELECT MAX(OrganizationID) FROM Organization');
        if ($result) {
            $maxId = $result->fetch(PDO::FETCH_COLUMN);
        } else {
            $maxId = null; // or handle the error accordingly
        }
        return $maxId;
    }

    //get student by user id
    public function getStudentByUserId($userId){
        $this->db->query('SELECT * FROM student WHERE UserID = :userId');


        $this->db->bind(':userId', $userId);

        $results = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $results[0];
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            return false;
        }
    }
}

?>