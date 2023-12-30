<?php 
/*
database:
CREATE TABLE `course` (
    `CourseID` varchar(6) NOT NULL,
    `InstitudeID` varchar(6) NOT NULL,
    `CourseName` varchar(45) NOT NULL,
    PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/

class Course{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addCourse($data){
        $this->db->query('INSERT INTO Course (CourseID, InstitudeID, CourseName) VALUES(:courseId, :institudeId, :courseName)');

        //Bind values
        $this->db->bind(':courseId', $data['course_id']);
        $this->db->bind(':institudeId', $data['institude_id']);
        $this->db->bind(':courseName', $data['course_name']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCourseByInstitudeId($institudeId){
        $this->db->query('SELECT * FROM Course WHERE InstitudeID = :institudeId');

        $this->db->bind(':institudeId', $institudeId);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllCourse(){
        $this->db->query('SELECT * FROM Course');

        $results = $this->db->resultSet();

        return $results;
    }

    public function updateCourse($data){
        $this->db->query('UPDATE Course SET InstitudeID = :institudeId, CourseName = :courseName WHERE CourseID = :courseId');

        //Bind values
        $this->db->bind(':courseId', $data['course_id']);
        $this->db->bind(':institudeId', $data['institude_id']);
        $this->db->bind(':courseName', $data['course_name']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCourse($id){
        $this->db->query('DELETE FROM Course WHERE CourseID = :id');

        //Bind values
        $this->db->bind(':id', $id);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>