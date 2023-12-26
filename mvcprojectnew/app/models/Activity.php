<?php 

class Activity{
    private $db;


public function __construct(){
    $this->db = new Database;
}

public function manageAllActivities(){
    $this->db->query('SELECT * FROM activities');
    $results = $this->db->resultSet();
    return $results;
}


}




?>