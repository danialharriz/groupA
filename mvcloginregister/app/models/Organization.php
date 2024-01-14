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
    `emailending` varchar(45) NOT NULL,
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
        $this->db->query('INSERT INTO Organization (OrganizationID, OrganizationName, Address, City, State, Website, Type, ContactEmail, ContactPhone, emailending) VALUES(:organizationId, :organizationName, :address, :city, :state, :website, :type, :contactEmail, :contactPhone, :emailending)');

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
        $this->db->bind(':emailending', $data['emailending']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateOrganization($data) {
        $this->db->query('UPDATE Organization SET OrganizationName = :organizationName, Address = :address, City = :city, State = :state, Website = :website, Type = :type, ContactEmail = :contactEmail, ContactPhone = :contactPhone, emailending = :emailending WHERE OrganizationID = :organizationId');

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
        $this->db->bind(':emailending', $data['emailending']);

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
        $this->db->query('SELECT * FROM organization ORDER BY TYPE ASC');

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
    //get all company type = 2
    public function getAllCompany(){
        $this->db->query('SELECT * FROM organization WHERE Type = 2');

        $results = $this->db->resultSet();

        return $results;
    }
    public function deleteOrganization($organizationId) {
        $this->db->query('DELETE FROM Organization WHERE OrganizationID = :organizationId');
        $this->db->bind(':organizationId', $organizationId);
        $this->db->execute();

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //select organizationid by emailending
    public function getOrganizationIdByEmailEnding($emailending) {
        $this->db->query('SELECT OrganizationID FROM Organization WHERE emailending = :emailending');

        $this->db->bind(':emailending', $emailending);

        $row = $this->db->single();

        if ($row) {
            return $row->OrganizationID;
        } else {
            return false;
        }
    }
    public function getOrganizationName($organizationId) {
        $this->db->query('SELECT OrganizationName FROM Organization WHERE OrganizationID = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $row = $this->db->single();

        if ($row) {
            return $row->OrganizationName;
        } else {
            return false;
        }
    }
    //verify organization pusing email ending
    public function verifyOrganizationEmail($organizationId, $email) {
        $this->db->query('SELECT * FROM Organization WHERE OrganizationID = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $row = $this->db->single();
        //verify if user is from ornagization using email ending
        $emailending = explode("@", $email);
        if ($row) {
            if ($row->emailending == $emailending[1]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Check email ending while register
    public function checkEmailEnding($emailEnd) {
        $this->db->query('SELECT * FROM Organization WHERE emailending = :emailEnd');

        $this->db->bind(':emailEnd', $emailEnd);

        $row = $this->db->single();

        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
    public function getOrganizationById($organizationId) {
        $this->db->query('SELECT * FROM organization WHERE OrganizationID = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $row = $this->db->single();

        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    public function searchOrganization($search) {
        $this->db->query('SELECT * FROM organization WHERE OrganizationName LIKE :search OR Address LIKE :search OR City LIKE :search OR State LIKE :search OR Website LIKE :search OR ContactEmail LIKE :search OR ContactPhone LIKE :search');

        $this->db->bind(':search', '%' . $search . '%');

        $results = $this->db->resultSet();

        return $results;
    }
} 
?>