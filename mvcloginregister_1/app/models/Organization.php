<?php
/*
CREATE TABLE `organization` (
    `OrganizationID` varchar(6) NOT NULL,
    `OrganizationName` varchar(45) NOT NULL,
    `Address` varchar(45) NOT NULL,
    `City` varchar(45) NOT NULL,
    `State` varchar(45) NOT NULL,
    `Website` varchar(45) NOT NULL,
    `Type` int(1) NOT NULL,
    `ContactEmail` varchar(45) NOT NULL,
    `ContactPhone` int(11) NOT NULL,
    `Pass` varchar(6) NOT NULL,
    PRIMARY KEY (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/
class Organization {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //add organization
    public function addOrganization($data) {
        $this->db->query('INSERT INTO Organization (OrganizationID, OrganizationName, Address, City, State, Website, Type, ContactEmail, ContactPhone, Pass) VALUES(:organizationId, :organizationName, :address, :city, :state, :website, :type, :contactEmail, :contactPhone, :pass)');

        //Bind values
        $this->db->bind(':organizationId', $data['organizationId']);
        $this->db->bind(':organizationName', $data['organizationName']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':contactEmail', $data['contactEmail']);
        $this->db->bind(':contactPhone', $data['contactPhone']);
        $this->db->bind(':pass', $data['pass']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateOrganization($data) {
        $this->db->query('UPDATE Organization SET OrganizationName = :organizationName, Address = :address, City = :city, State = :state, Website = :website, Type = :type, ContactEmail = :contactEmail, ContactPhone = :contactPhone WHERE OrganizationID = :organizationId');

        //Bind values
        $this->db->bind(':organizationId', $data['organizationId']);
        $this->db->bind(':organizationName', $data['organizationName']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':contactEmail', $data['contactEmail']);
        $this->db->bind(':contactPhone', $data['contactPhone']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOrganizationPassword($data) {
        $this->db->query('UPDATE Organization SET Pass = :pass WHERE OrganizationID = :organizationId');

        //Bind values
        $this->db->bind(':organizationId', $data['organizationId']);
        $this->db->bind(':pass', $data['pass']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrganizationByName($organizationName) {
        $this->db->query('SELECT * FROM Organization WHERE OrganizationName = :organizationName');

        $this->db->bind(':organizationName', $organizationName);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllOrganizations(){
        $this->db->query('SELECT * FROM organization');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllInstitute(){
        $this->db->query('SELECT * FROM organization WHERE Type = 1');

        $results = $this->db->resultSet();

        return $results;
    }

    //get max organization id
    public function getOrganizationId() {
        $this->db->query('SELECT MAX(OrganizationID) AS maxOrganizationId FROM Organization');

        $row = $this->db->single();

        if ($row) {
            return $row->maxOrganizationId;
        } else {
            return false;
        }
    }
    public function deleteOrganization($organizationId) {
        $this->db->query('DELETE FROM Organization WHERE OrganizationID = :organizationId');
        $this->db->bind(':organizationId', $organizationId);
        $this->db->execute();
    }
    //verify organization password
    public function verifyOrganizationPassword($organizationId, $pass) {
        $this->db->query('SELECT * FROM Organization WHERE OrganizationID = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $row = $this->db->single();

        $hashedPassword = $row->Pass;

        if (password_verify($pass, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
