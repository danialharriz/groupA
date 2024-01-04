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
        $this->db->query("INSERT INTO `event`(`EventID`, `EventName`, `Description`, `StartDateAndTime`, `EndDateAndTime`, `Location`, `EventType`, `RewardPoints`, `OrganizationID`)  VALUES(:eventId, :eventName, :description, :startDateAndTime, :endDateAndTime, :location, :eventType, :rewardPoints, :organizationId)");
        
        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateAndTime']);
        $this->db->bind(':endDateAndTime', $data['endDateAndTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':organizationId', $data['organizationId']);
        
        if (isset($data['rewardPoints'])) {
            $this->db->bind(':rewardPoints', $data['rewardPoints'], PDO::PARAM_INT);
        } else {
            $this->db->bind(':rewardPoints', null, PDO::PARAM_NULL);
        }
        

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
    public function getUpcomingEvents(){
        $this->db->query('SELECT * FROM Event WHERE StartDateAndTime > NOW() ORDER BY StartDateAndTime ASC');

        $results = $this->db->resultSet();

        return $results;
    }
    public function getAllEvent(){
        $this->db->query('SELECT * FROM Event ORDER BY StartDateAndTime DESC');

        $results = $this->db->resultSet();

        return $results;
    }

    public function updateEvent($data){
        $this->db->query('UPDATE Event SET EventName = :eventName, Description = :description, StartDateAndTime = :startDateAndTime, EndDateAndTime = :endDateAndTime, Location = :location, EventType = :eventType, RewardPoints = :rewardPoints, Validated = :validated WHERE EventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateAndTime']);
        $this->db->bind(':endDateAndTime', $data['endDateAndTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':rewardPoints', $data['rewardPoints']);
        $this->db->bind(':validated', $data['validated']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //get the max event id
    public function getMaxEventId(){
        $this->db->query('SELECT MAX(EventID) AS id FROM Event');

        $row = $this->db->single();

        if($row){
            return $row->id;
        }else{
            return false;
        }
    }

    public function getEventById($eventId){
        $this->db->query('SELECT * FROM Event WHERE EventID = :eventId');

        $this->db->bind(':eventId', $eventId);

        $row = $this->db->single();

        return $row;
    }

    public function deleteEvent($eventId){
        $this->db->query('DELETE FROM Event WHERE EventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $eventId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>