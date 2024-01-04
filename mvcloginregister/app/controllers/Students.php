<?php

class Students extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');
        $this->participateModel = $this->model('Participant');
    }

    public function addOutsideEvent() {
        $data = [
            'title' => 'Add Outside Event',
            'eventName' => '',
            'description' => '',
            'startDateTime' => '',
            'endDateTime' => '',
            'location' => '',
            'eventType' => '',
            'Error' => '',
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the user input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Add Outside Event',
                'eventName' => $_POST['name'],
                'description' => $_POST['description'],
                'startDateTime' => $_POST['start_date_and_time'],
                'endDateTime' => $_POST['end_date_and_time'],
                'location' => $_POST['location'],
                'eventType' => $_POST['event_type'],
                'Error' => '',
            ];
        
            // Validate the user input (you may want to add more validation)
            if (empty($_POST['name']) || empty($_POST['start_date_and_time']) || empty($_POST['end_date_and_time']) || empty($_POST['location']) || empty($_POST['event_type'])) {
                // Handle validation errors
                $data['Error'] = 'Please enter all required fields.';
            } else {

                //Run SQL
                $addEvent = $this->studentModel->addOutsideEvent($data);
                if ($addEvent) {
                    $addEventDone = "Successful submitted the event to the admin. Waiting admin to approve it.";

                    header('location: ' . URLROOT . '/posts/index');
                } else {
                    // Registration failed
                    die('Something went wrong.');
                }

            }
        }
        $this->view('students/student_add_event', $data);
    }
    
    public function event_participated(){
        $data = [
            'title' => 'Event Participated',
            'events' => '',
            'Error' => '',
        ];
        $student_id = $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID;
        $event_participated = $this->participateModel->get_eventid($student_id);
        //for each event participated, get the event details
        foreach ($event_participated as $event) {
            $event->event_details = $this->eventModel->getEventById($event->EventID);
        }
        //get event organization name
        foreach ($event_participated as $event) {
            $event->organization_name = $this->organizationModel->getOrganizationName($event->event_details->OrganizationID);
        }
        $data['events'] = $event_participated;
        $this->view('students/event_participated', $data);
    }

    public function viewUpcomingEvents() {
        $data = [
            'title' => 'Upcoming Events',
            'events' => '',
            'Error' => '',
        ];
        $event_participated = $this->participateModel->get_eventid($_SESSION['user_id']);
        $data['events'] = $this->eventModel->getUpcomingEvents();
        //get event organization name
        foreach ($data['events'] as $event) {
            $event->organizationName = $this->organizationModel->getOrganizationName($event->OrganizationID);
        }

        $this->view('students/viewUpcomingEvents', $data);
    }
    public function view_event(){
        
        $eventid = $this->getUrl()[2];
        $data = [
            'title' => 'View Event',
            'event' => '',
            'Error' => '',
        ];
        $event = $this->eventModel->getEventById($eventid);
        $studentid = $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID;
        $event->organization_name = $this->organizationModel->getOrganizationName($event->OrganizationID);
        $participated = $this->participateModel->check_participated($studentid, $eventid);
        $current_date = date("Y-m-d H:i:s");
        //if event is not participated and event is not expired
        $event->canparticipate = false;
        $event->cancancel = false;
        $event->canfeedback = false;
        if($participated == false && $event->StartDateAndTime > $current_date){
            $event->canparticipate = true;
        } //if event participated and event is not expired
        else if($participated == true && $event->StartDateAndTime > $current_date){
            $event->cancancel = true;
        } //if event participated and event is ended and
        else if($participated == true && $event-> EndDateAndTime < $current_date){
            $event->canfeedback = true;
        }
        if($participated == true){
            $event->participant_id = $this->participateModel->get_participant_id($studentid, $eventid);
        }
        $data['event'] = $event;
        $this->view('students/view_event', $data);
    }
    public function participate(){
        $eventid = $this->getUrl()[2];
        $studentid = $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID;
        $data = [
            'title' => 'Participate',
            'event' => '',
            'Error' => '',
            'event_id' => $eventid,
            'student_id' => $studentid,
        ];
        //check if student already participated
        $participated = $this->participateModel->check_participated($studentid, $eventid);
        if($participated){
            echo "<script>alert('You have already participated this event.');window.location.href = '" . URLROOT . "/students/view_event/" . $eventid . "';</script>";        
        }
        //get last participant id
        $last_participant_id = $this->participateModel->getLastParticipantId();
        if(empty($last_participant_id)){
            $data['participant_id'] = "P00001";
        }
        else{
            $last_participant_id = substr($last_participant_id, 1);
            $last_participant_id = intval($last_participant_id);
            $last_participant_id = $last_participant_id + 1;
            $last_participant_id = str_pad($last_participant_id, 5, '0', STR_PAD_LEFT);
            $data['participant_id'] = 'P' . $last_participant_id;
        }
        if($this->participateModel->addParticipant($data)){
            echo "<script>alert('Participated successfully.'); window.location.href = '" . URLROOT . "/students/event_participated';</script>";
        }else{
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
    public function cancel_participation(){
        $participantid = $this->getUrl()[2];
        $data = [
            'title' => 'Participate',
            'event' => '',
            'Error' => '',
        ];
        if($this->participateModel->cancel_participation($participantid)){
            echo "<script>alert('You have withdraw from the event.'); window.location.href = '" . URLROOT . "/students/event_participated';</script>";
        }else{
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
        }
    }
    public function view_participated_event(){
        $data = [
            'title' => 'Participated Events',
            'events' => '',
            'Error' => '',
        ];
        $event_participated = $this->participateModel->get_eventid($_SESSION['user_id']);
        $events = $this->studentModel->get_participated_events($event_participated);
        //get event organization name
        foreach ($events as $event) {
            $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        }
        $data['events'] = $events;
        $this->view('students/view_participated_event', $data);
    }

    public function index() {
        $data = [
            'title' => 'Student Dashboard',
            'events' => '',
            'Error' => '',
        ];
        $this->view('students/index', $data);
    }
}
?>