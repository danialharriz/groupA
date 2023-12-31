<?php
/*
//database
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
//model
class Organization {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

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
*/

class Admins extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('Staff');
        $this->organizationModel = $this->model('Organization');
    }
    //register organization
    public function register_organization() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate organization id
            $organization_id = $this->organizationModel->getOrganizationId();
            //if there is no organization id in database, set organization id to O00001, else auto increment
            if ($organization_id == null) {
                $organization_id = 'O00001';
            } else {
                $organization_id = substr($organization_id, 1);
                $organization_id = intval($organization_id);
                $organization_id = 'O' . sprintf('%05d', $organization_id + 1);
            }
            $data = [
                'organizationId' => $organization_id,
                'organizationName' => trim($_POST['organization_name']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'state' => trim($_POST['state']),
                'website' => trim($_POST['website']),
                'type' => trim($_POST['type']),
                'contactEmail' => trim($_POST['contact_email']),
                'contactPhone' => trim($_POST['contact_phone']),
                'pass' => trim($_POST['pass']),
                'organization_id_err' => '',
                'organization_name_err' => '',
                'address_err' => '',
                'city_err' => '',
                'state_err' => '',
                'website_err' => '',
                'type_err' => '',
                'contact_email_err' => '',
                'contact_phone_err' => '',
                'pass_err' => '',
            ];
            // Validate organization name
            if (empty($data['organizationName'])) {
                $data['organization_name_err'] = 'Please enter organization name';
            }
            // validate pass
            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please enter pass';
            }
            // Make sure errors are empty
            if (empty($data['organization_name_err']) && empty($data['pass_err'])) {
                // Validated
                // Hash password
                $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                // Register organization
                if ($this->organizationModel->addOrganization($data)) {
                    // Redirect to login
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/register_organization', $data);
            }
        } else {
            // Init data
            $data = [
                'organizationId' => '',
                'organizationName' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'website' => '',
                'type' => '',
                'contactEmail' => '',
                'contactPhone' => '',
                'pass' => '',
                'organization_id_err' => '',
                'organization_name_err' => '',
                'address_err' => '',
                'city_err' => '',
                'state_err' => '',
                'website_err' => '',
                'type_err' => '',
                'contact_email_err' => '',
                'contact_phone_err' => '',
                'pass_err' => '',
            ];
            // Load view
            $this->view('admins/register_organization', $data);
        }
        $this->view('admins/register_organization');
    }
    
    //create event
    public function create_event() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate event id
            $event_id = $this->eventModel->getEventId();
            //if there is no event id in database, set event id to E00001, else auto increment
            if ($event_id == null) {
                $event_id = 'E00001';
            } else {
                $event_id = substr($event_id, 1);
                $event_id = intval($event_id);
                $event_id = 'E' . sprintf('%05d', $event_id + 1);
            }
            $data = [
                'eventId' => $event_id,
                'eventName' => trim($_POST['event_name']),
                'description' => trim($_POST['description']),
                'startDateAndTime' => trim($_POST['start_date_and_time']),
                'endDateAndTime' => trim($_POST['end_date_and_time']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['event_type']),
                'rewardPoints' => trim($_POST['reward_points']),
                //get the organization id from stafff table
                'organizationId' => $this->adminModel->getOrganizationIdByStaffId($_SESSION['user_id']),
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Validate data
            if(empty($data['eventName'])){
                $data['event_name_err'] = 'Please enter event name';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['startDateAndTime'])){
                $data['start_date_and_time_err'] = 'Please enter start date and time';
            }
            if(empty($data['endDateAndTime'])){
                $data['end_date_and_time_err'] = 'Please enter end date and time';
            }
            if(empty($data['location'])){
                $data['location_err'] = 'Please enter location';
            }
            if(empty($data['eventType'])){
                $data['event_type_err'] = 'Please enter event type';
            }
            if(empty($data['rewardPoints'])){
                $data['reward_points_err'] = 'Please enter reward points';
            }
            if(empty($data['organizationId'])){
                $data['organization_id_err'] = 'Something went wrong';
            }
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) && empty($data['reward_points_err']) && empty($data['organization_id_err'])) {
                // Validated
                // Register event
                if ($this->eventModel->addEvent($data)) {
                    // Redirect to login
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/create_event', $data);
            }
        } else {
            // Init data
            $data = [
                'eventId' => '',
                'eventName' => '',
                'description' => '',
                'startDateAndTime' => '',
                'endDateAndTime' => '',
                'location' => '',
                'eventType' => '',
                'rewardPoints' => '',
                'organizationId' => '',
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Load view
            $this->view('admins/create_event', $data);
        }
        $this->view('admins/create_event');
    }
    //update event
    public function update_event($eventId) {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'eventId' => $eventId,
                'eventName' => trim($_POST['event_name']),
                'description' => trim($_POST['description']),
                'startDateAndTime' => trim($_POST['start_date_and_time']),
                'endDateAndTime' => trim($_POST['end_date_and_time']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['event_type']),
                'rewardPoints' => trim($_POST['reward_points']),
                'organizationId' => $this->adminModel->getOrganizationIdByStaffId($_SESSION['user_id']),
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Validate data
            if(empty($data['eventName'])){
                $data['event_name_err'] = 'Please enter event name';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['startDateAndTime'])){
                $data['start_date_and_time_err'] = 'Please enter start date and time';
            }
            if(empty($data['endDateAndTime'])){
                $data['end_date_and_time_err'] = 'Please enter end date and time';
            }
            if(empty($data['location'])){
                $data['location_err'] = 'Please enter location';
            }
            if(empty($data['eventType'])){
                $data['event_type_err'] = 'Please enter event type';
            }
            if(empty($data['rewardPoints'])){
                $data['reward_points_err'] = 'Please enter reward points';
            }
            if(empty($data['organizationId'])){
                $data['organization_id_err'] = 'Something went wrong';
            }
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) && empty($data['reward_points_err']) && empty($data['organization_id_err'])) {
                // Validated
                // Register event
                if ($this->eventModel->updateEvent($data)) {
                    // Redirect to login
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/update_event', $data);
            }
        } else {
            // Get existing event from model
            $event = $this->eventModel->getEventById($eventId);
            // Check for owner
            if ($event->OrganizationId != $_SESSION['user_id']) {
                header('location: ' . URLROOT . '/admins');
            }
            $data = [
                'eventId' => $eventId,
                'eventName' => $event->EventName,
                'description' => $event->Description,
                'startDateAndTime' => $event->StartDateAndTime,
                'endDateAndTime' => $event->EndDateAndTime,
                'location' => $event->Location,
                'eventType' => $event->EventType,
                'rewardPoints' => $event->RewardPoints,
                'organizationId' => $event->OrganizationId,
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Load view
            $this->view('admins/update_event', $data);
        }
        $this->view('admins/update_event');
    }
    //delete event
    public function delete_event($eventId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing event from model
            $event = $this->eventModel->getEventById($eventId);
            // Check for owner
            if ($event->OrganizationId != $_SESSION['user_id']) {
                header('location: ' . URLROOT . '/admins');
            }
            if ($this->eventModel->deleteEvent($eventId)) {
                header('location: ' . URLROOT . '/admins');
            } else {
                die('Something went wrong');
            }
        } else {
            header('location: ' . URLROOT . '/admins');
        }
    }
    //view event
    public function view_event($eventId) {
        $event = $this->eventModel->getEventById($eventId);
        $data = [
            'eventId' => $eventId,
            'eventName' => $event->EventName,
            'description' => $event->Description,
            'startDateAndTime' => $event->StartDateAndTime,
            'endDateAndTime' => $event->EndDateAndTime,
            'location' => $event->Location,
            'eventType' => $event->EventType,
            'rewardPoints' => $event->RewardPoints,
            'organizationId' => $event->OrganizationId,
            'event_id_err' => '',
            'event_name_err' => '',
            'description_err' => '',
            'start_date_and_time_err' => '',
            'end_date_and_time_err' => '',
            'location_err' => '',
            'event_type_err' => '',
            'reward_points_err' => '',
            'organization_id_err' => '',
            //'validated_err' => '',
        ];
        $this->view('admins/view_event', $data);
    }
    //view all events   
    public function view_all_events() {
        $events = $this->eventModel->getAllEvents();
        $data = [
            'events' => $events,
        ];
        $this->view('admins/view_all_events', $data);
    }
    //view participants of an event
    public function view_participants($eventId) {
        $participants = $this->participantModel->getParticipantByEventId($eventId);
        $data = [
            'participants' => $participants,
        ];
        $this->view('admins/view_participants', $data);
    }
    public function index() {
        $this->view('admins/index');
    }
}