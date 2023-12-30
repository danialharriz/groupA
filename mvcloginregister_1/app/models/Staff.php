<?php

class Staff {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function addStaff() {
        $last_id = $this->getlastid();

        $this->db->query('INSERT INTO Staff (StaffId, UserId, OrganizationId, Type, JobTitle) VALUES(:staffId, :userId, :organizationId, :type, :jobTitle');

        //Bind values
        $this->db->bind(':staffId', $last_id);
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':organizationId', $data['organization_id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':jobTitle', $data['job_title']);

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
        $this->db->query('SELECT OrganizationId FROM Staff WHERE UserId = :userId');

        $this->db->bind(':userId', $userId);

        $results = $this->db->resultSet();

        return $results;
    }
}

?>
