<?php

class Staff {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function addStaff($data) {
        $this->db->query('INSERT INTO Staff (StaffID, UserID, OrganizationID, JobTitle, validated) VALUES(:staffId, :userId, :organizationId, :jobTitle, :validated)');
        //Bind values
        $this->db->bind(':staffId', $data['staffId']);
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':organizationId', $data['organizationId']);
        $this->db->bind(':jobTitle', $data['jobTitle']);
        $this->db->bind(':validated', $data['validated']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPendingStaff() {
        $this->db->query('SELECT * FROM Staff WHERE validated = 3');

        $results = $this->db->resultSet();

        return $results;
    }
    public function approvestaff($staffId) {
        $this->db->query('UPDATE Staff SET validated = 1 WHERE StaffId = :staffId');

        //Bind values
        $this->db->bind(':staffId', $staffId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function rejectstaff($staffId) {
        $this->db->query('UPDATE Staff SET validated = 2 WHERE StaffId = :staffId');

        //Bind values
        $this->db->bind(':staffId', $staffId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getlastid() {
        $result = $this->db->query('SELECT StaffId FROM Staff ORDER BY StaffId DESC LIMIT 1');
        $latestUserId = $result->fetchColumn();

        $numericPart = preg_replace('/[^0-9]/', '', $latestUserId);
        $newNumericPart = $numericPart ? ++$numericPart : '1';

        // Format the new UserId with leading zeros
        $newUserId = 'W' . str_pad($newNumericPart, strlen($numericPart), '0', STR_PAD_LEFT);
        return $newUserId;
    }
    //get the organization id of the staff
    public function getOrganizationId($userId) {
        $this->db->query('SELECT * FROM staff WHERE UserId = :userId');

        $this->db->bind(':userId', $userId);

        $results = $this->db->single();

        if ($results) {
            return $results->OrganizationID;
        } else {
            return null; // or handle the case when $results is false
        }
    }
    //get max staff id
    public function getLastStaffId() {
        $this->db->query('SELECT MAX(StaffId) AS maxStaffId FROM Staff');

        $row = $this->db->single();

        if ($row) {
            return $row->maxStaffId;
        } else {
            return false;
        }
    }

    public function getStaffByUserId($userId) {
        $this->db->query('SELECT * FROM staff WHERE UserId = :userId');

        $this->db->bind(':userId', $userId);

        $results = $this->db->single();

        if ($results) {
            return $results;
        } else {
            return null; // or handle the case when $results is false
        }
    }
    public function getStaff($staffId) {
        $this->db->query('SELECT * FROM staff WHERE StaffId = :staffId');

        $this->db->bind(':staffId', $staffId);

        $results = $this->db->single();

        if ($results) {
            return $results;
        } else {
            return null; // or handle the case when $results is false
        }
    }
    public function getStaffByOrganizationId($organizationId) {
        $this->db->query('SELECT * FROM staff WHERE OrganizationId = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $results = $this->db->resultSet();

        if ($results) {
            return $results;
        } else {
            return null; // or handle the case when $results is false
        }
    }
}

?>
