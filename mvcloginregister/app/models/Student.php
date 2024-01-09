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
        $this->db->query('SELECT MAX(StudentID) AS maxStudentId FROM student');
        $row = $this->db->single();
        if ($row) {
            return $row->maxStudentId;
        } else {
            return false;
        }
    }

    //get student by id
    public function getStudentById($studentId){
        $this->db->query('SELECT * FROM student WHERE StudentID = :studentId');
        $this->db->bind(':studentId', $studentId);
        $result = $this->db->single();
        return $result;
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
    //update student
    public function updateStudent($data){
        $this->db->query('UPDATE `student` SET `OrganizationID` = :organizationID, `CourseID` = :courseID, `Address` = :address, `Gender` = :gender, `DateOfBirth` = :dateOfBirth WHERE `StudentID` = :studentID');
        //Bind values
        $this->db->bind(':studentID', $data['student_id']);
        $this->db->bind(':organizationID', $data['organization_id']);
        $this->db->bind(':courseID', $data['course']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dateOfBirth', $data['date_of_birth']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getStudentByOrganizationId($organizationId){
        $this->db->query('SELECT * FROM student WHERE OrganizationID = :organizationId');
        $this->db->bind(':organizationId', $organizationId);
        $results = $this->db->resultSet();
        return $results;
    }
}

?>