<?php

class Staffs extends Controller {
    //constructor
    public function __construct() {
        $this->staffModel = $this->model('Staff');
        $this->userModel = $this->model('User');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');
        $this->feedbackModel = $this->model('Feedback');
        $this->participantModel = $this->model('Participant');
    }

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
                'organizationId' => $this->staffModel->getOrganizationId($_SESSION['user_id']),
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
                    header('location: ' . URLROOT . '/staffs/all_events');
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                // Load view with errors
                $this->view('staffs/create_event', $data);
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
            $this->view('staffs/create_event', $data);
        }
        $this->view('staffs/create_event');
    }

    //index function
    public function index(){
        $this->view('staffs/index');
    }
}
?>