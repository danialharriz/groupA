<?php
/*
database
CREATE TABLE `event` (
    `EventID` varchar(6) NOT NULL,
    `EventName` int(45) NOT NULL,
    `Description` int(45) NOT NULL,
    `StartDateAndTime` datetime NOT NULL,
    `EndDateAndTime` datetime NOT NULL,
    `Location` varchar(255) NOT NULL,
    `EventType` varchar(15) NOT NULL,
    `RewardPoints` int(11) NOT NULL,
    `OrganizationID` varchar(6) NOT NULL,
    `Validated` varchar(3) NOT NULL,
    PRIMARY KEY (`EventID`),
    KEY `OrganizationID` (`OrganizationID`),
    CONSTRAINT `event_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/

class Event{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addEvent($data){
        $this->db->query('INSERT INTO Event (EventID, EventName, Description, StartDateAndTime, EndDateAndTime, Location, EventType, RewardPoints, OrganizationID, Validated) VALUES(:eventId, :eventName, :description, :startDateAndTime, :endDateAndTime, :location, :eventType, :rewardPoints, :organizationId, :validated)');

        //Bind values
        $this->db->bind(':eventId', $data['event_id']);
        $this->db->bind(':eventName', $data['event_name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['start_date_and_time']);
        $this->db->bind(':endDateAndTime', $data['end_date_and_time']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['event_type']);
        $this->db->bind(':rewardPoints', $data['reward_points']);
        $this->db->bind(':organizationId', $data['organization_id']);
        $this->db->bind(':validated', $data['validated']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEventByOrganizationId($organizationId){
        $this->db->query('SELECT * FROM Event WHERE OrganizationID = :organizationId');

        $this->db->bind(':organizationId', $organizationId);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getUpcomingEventByOrganizationId($organizationId){
        $this->db->query('SELECT * FROM Event WHERE OrganizationID = :organizationId AND StartDateAndTime > NOW()');

        $this->db->bind(':organizationId', $organizationId);

        $results = $this->db->resultSet();

        return $results;
    }
    public function getUpcomingEventByName($eventName){
        $this->db->query('SELECT * FROM Event WHERE EventName = :eventName AND StartDateAndTime > NOW()');

        $this->db->bind(':eventName', $eventName);

        $results = $this->db->resultSet();

        return $results;
    }
    public function getUpcomingEvent(){
        $this->db->query('SELECT * FROM Event WHERE StartDateAndTime > NOW()');

        $results = $this->db->resultSet();

        return $results;
    }
    public function getAllEvent(){
        $this->db->query('SELECT * FROM Event');

        $results = $this->db->resultSet();

        return $results;
    }

    public function updateEvent($data){
        $this->db->query('UPDATE Event SET EventName = :eventName, Description = :description, StartDateAndTime = :startDateAndTime, EndDateAndTime = :endDateAndTime, Location = :location, EventType = :eventType, RewardPoints = :rewardPoints, OrganizationID = :organizationId, Validated = :validated WHERE EventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $data['event_id']);
        $this->db->bind(':eventName', $data['event_name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['start_date_and_time']);
        $this->db->bind(':endDateAndTime', $data['end_date_and_time']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['event_type']);
        $this->db->bind(':rewardPoints', $data['reward_points']);
        $this->db->bind(':organizationId', $data['organization_id']);
        $this->db->bind(':validated', $data['validated']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //get the last event id
    public function getLastid(){
        $this->db->query('SELECT EventID FROM Event ORDER BY EventID DESC LIMIT 1');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getEventById($eventId){
        $this->db->query('SELECT * FROM Event WHERE EventID = :eventId');

        $this->db->bind(':eventId', $eventId);

        $row = $this->db->single();

        return $row;
    }
}
?>