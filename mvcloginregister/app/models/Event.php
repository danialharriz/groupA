<?php

class Event{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addEvent($data){
        $this->db->query("INSERT INTO `event`(`EventID`, `EventName`, `Description`, `StartDateAndTime`, `EndDateAndTime`, `Location`, `EventType`, `RewardPoints`, `OrganizationID`, `Picture`, `Deadline`, `MaxParticipants`) VALUES (:eventId, :eventName, :description, :startDateAndTime, :endDateAndTime, :location, :eventType, :rewardPoints, :organizationId, :picture, :deadline, :maxParticipant)");
        
        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateAndTime']);
        $this->db->bind(':endDateAndTime', $data['endDateAndTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':organizationId', $data['organizationId']);
        $this->db->bind(':rewardPoints', $data['rewardPoints']);
        $this->db->bind(':deadline', $data['deadline']);
        $this->db->bind(':maxParticipant', $data['maxParticipant']);
        
        $this->db->bind(':picture', $data['picture']);

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
        $this->db->query('UPDATE Event SET EventName = :eventName, Description = :description, StartDateAndTime = :startDateAndTime, EndDateAndTime = :endDateAndTime, Location = :location, EventType = :eventType, RewardPoints = :rewardPoints, Deadline = :deadline, MaxParticipants = :maxParticipant WHERE EventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':eventName', $data['eventName']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':startDateAndTime', $data['startDateAndTime']);
        $this->db->bind(':endDateAndTime', $data['endDateAndTime']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':eventType', $data['eventType']);
        $this->db->bind(':rewardPoints', $data['rewardPoints']);
        $this->db->bind(':deadline', $data['deadline']);
        $this->db->bind(':maxParticipant', $data['maxParticipant']);

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
    public function getEventByIdEnded($eventId){
        $this->db->query('SELECT * FROM Event WHERE EventID = :eventId AND EndDateAndTime < NOW()');

        $this->db->bind(':eventId', $eventId);

        $row = $this->db->single();

        return $row;
    }
    public function getEventCount(){
        $this->db->query('SELECT COUNT(*) AS count FROM Event');

        $row = $this->db->single();

        return $row->count;
    }
    public function updatePicture($eventId, $picture){
        $this->db->query('UPDATE Event SET Picture = :picture WHERE EventID = :eventId');

        //Bind values
        $this->db->bind(':eventId', $eventId);
        $this->db->bind(':picture', $picture);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //search, can either search by event name or organization name or event type
    public function searchEvent($search){
        $this->db->query('SELECT * FROM Event WHERE EventName LIKE :search OR EventType LIKE :search OR OrganizationID IN (SELECT OrganizationID FROM Organization WHERE OrganizationName LIKE :search)');

        $this->db->bind(':search', '%' . $search . '%');

        $results = $this->db->resultSet();

        return $results;
    }
    public function searchEventParticipated($search, $student_id){
        $this->db->query('SELECT * FROM Event WHERE EventName LIKE :search OR EventType LIKE :search OR OrganizationID IN (SELECT OrganizationID FROM Organization WHERE OrganizationName LIKE :search) AND EventID IN (SELECT EventID FROM Participant WHERE StudentID = :student_id)');

        $this->db->bind(':search', '%' . $search . '%');
        $this->db->bind(':student_id', $student_id);

        $results = $this->db->resultSet();

        return $results;
    }
}
?>