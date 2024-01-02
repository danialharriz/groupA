<?php
class Admins extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('Staff');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');      
        $this->courseModel = $this->model('Course');
    }
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
                'organizationName' => trim($_POST['organizationName']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'state' => trim($_POST['state']),
                'website' => trim($_POST['website']),
                'type' => trim($_POST['type']),
                'contactEmail' => trim($_POST['contactEmail']),
                'contactPhone' => trim($_POST['contactPhone']),
                'emailending' => trim($_POST['emailending']),
                'organization_id_err' => '',
                'organization_name_err' => '',
                'address_err' => '',
                'city_err' => '',
                'state_err' => '',
                'website_err' => '',
                'type_err' => '',
                'contact_email_err' => '',
                'contact_phone_err' => '',
                'emailending_err' => '',
            ];
            //check if organization is registered
            if ($this->organizationModel->getOrganizationByName($data['organizationName'])) {
                $data['organization_name_err'] = 'Organization name is already taken';
            }
            //run add model
            if ($this->organizationModel->addOrganization($data)) {
                echo "<script>alert('Organization registered successfully'); window.location.href = '" . URLROOT . "/admins';</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
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
                'emailending' => '',
                'organization_id_err' => '',
                'organization_name_err' => '',
                'address_err' => '',
                'city_err' => '',
                'state_err' => '',
                'website_err' => '',
                'type_err' => '',
                'contact_email_err' => '',
                'contact_phone_err' => '',
                'emailending_err' => '',
            ];
            // Load view
            $this->view('admins/register_organization', $data);
        }
        $this->view('admins/register_organization');
    }
    public function register_course() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate course id
            $course_id = $this->courseModel->getCourseId();
            //if there is no course id in database, set course id to C00001, else auto increment
            if ($course_id == null) {
                $course_id = 'C00001';
            } else {
                $course_id = substr($course_id, 1);
                $course_id = intval($course_id);
                $course_id = 'C' . sprintf('%05d', $course_id + 1);
            }
            $data = [
                'courseId' => $course_id,
                'courseName' => trim($_POST['course_name']),
                'courseDescription' => trim($_POST['course_description']),
                'course_id_err' => '',
                'course_name_err' => '',
                'course_description_err' => '',
            ];
            // Validate course name
            if (empty($data['courseName'])) {
                $data['course_name_err'] = 'Please enter course name';
            }
            // validate course description
            if (empty($data['courseDescription'])) {
                $data['course_description_err'] = 'Please enter course description';
            }
            // Make sure errors are empty
            if (empty($data['course_name_err']) && empty($data['course_description_err'])) {
                // Validated
                // Register course
                if ($this->courseModel->addCourse($data)) {
                    // Redirect to login
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/register_course', $data);
            }
        } else {
            // Init data
            $data = [
                'courseId' => '',
                'courseName' => '',
                'courseDescription' => '',
                'course_id_err' => '',
                'course_name_err' => '',
                'course_description_err' => '',
            ];
            // Load view
            $this->view('admins/register_course', $data);
        }
        $this->view('admins/register_course');
    }
    //create event
    public function create_event() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate event id
            $last_event_id = $this->eventModel->getMaxEventId();
            //if there is no event id in database, set event id to E00001, else auto increment
            if ($last_event_id) {
                //get the last 4 digits of event id
                $last_event_id = substr($last_event_id, 1);
                //convert string to integer
                $last_event_id = intval($last_event_id);
                //increment by 1
                $eventid = 'E' . sprintf('%05d', $last_event_id + 1);
            } else {
                $eventid = 'E00001';
            }
            $data = [
                'eventId' => $eventid,
                'eventName' => trim($_POST['event_name']),
                'description' => trim($_POST['description']),
                'startDateAndTime' => trim($_POST['start_date_and_time']),
                'endDateAndTime' => trim($_POST['end_date_and_time']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['event_type']),
                //'rewardPoints' => trim($_POST['reward_points']),
                //get the organization id from stafff table
                'organizationId' => $this->adminModel->getOrganizationId($_SESSION['user_id']),
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
            if(empty($data['organizationId'])){
                $data['organization_id_err'] = 'Something went wrong';
            }
            //verify if end time is later than start time
            if($data['endDateAndTime'] < $data['startDateAndTime']){
                $data['end_date_and_time_err'] = 'End date and time must be later than start date and time';
                echo "<script>alert('End date and time must be later than start date and time');</script>";
            }
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) && empty($data['organization_id_err']) && empty($data['end_date_and_time_err'])) {
                // Validated
                // Register event
                if ($this->eventModel->addEvent($data)) {
                    header('location: ' . URLROOT . '/admins/all_events');
                } else {
                    echo "<script>alert('Something went wrong');</script>";
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
    public function update_event() {
        //get event id from url
        $url = $this->getUrl();
        $eventId = $url[2];
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
                //'rewardPoints' => trim($_POST['reward_points']),
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
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) ) {
                // Validated
                // Register event
                if ($this->eventModel->updateEvent($data)) {
                    // Redirect to login
                    //redirect to all events page
                    echo "<script>alert('Event updated successfully'); window.location.href = '" . URLROOT . "/admins/all_events';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                // Load view with errors
                $this->view('admins/update_event', $data);
            }
        } else {
            // Get existing event from model
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
                'organizationId' => $event->OrganizationID,
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
    public function delete_event() {
        //get event id from url
        $url = $this->getUrl();
        $eventId = $url[2];
        //delete event
        if ($this->eventModel->deleteEvent($eventId)) {
            header('location: ' . URLROOT . '/admins/all_events');
        } else {
            echo "<script>alert('Something went wrong');</script>";
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

    //view participants of an event
    public function view_participants($eventId) {
        $participants = $this->participantModel->getParticipantByEventId($eventId);
        $data = [
            'participants' => $participants,
        ];
        $this->view('admins/view_participants', $data);
    }
    public function all_events(){
        $events = $this->eventModel->getAllEvent();
        //get the organizer name of each event
        foreach($events as $event){
            $event->OrganizationName = $this->organizationModel->getOrganizationName($event->OrganizationID);
        }
        $data = [
            'events' => $events,
        ];
        $this->view('admins/all_events', $data);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
        }
    }
    public function index() {
        $this->view('admins/index');
    }
}
?>