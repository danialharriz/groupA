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

public function addActivity($data)
    {
        $this->db->query('INSERT INTO activities (act_title, act_desc, user_id) VALUES (, :act_title, :act_desc,:user_id');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':act_title', $data['act_title']);
        $this->db->bind(':act_desc', $data['act_desc']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}




?>