<?php

class Students extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');
        $this->participateModel = $this->model('Participant');
        $this->feedbackModel = $this->model('Feedback');
        $this->outsideEventModel = $this->model('EventOutside');
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
            'organization' => '',
            'approvalStatus' => '',
            'studentId' => '',
            'eventNameError' => '',
            'descriptionError' => '',
            'startDateTimeError' => '',
            'endDateTimeError' => '',
            'locationError' => '',
            'eventTypeError' => '',
            'organizationError' => '',
            'approvalStatusError' => '',
            'studentIdError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'title' => 'Add Outside Event',
                'eventName' => trim($_POST['eventName']),
                'description' => trim($_POST['description']),
                'startDateTime' => trim($_POST['startDateTime']),
                'endDateTime' => trim($_POST['endDateTime']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['eventType']),
                'organization' => trim($_POST['organization']),
                'approvalStatus' => 0,
                'studentId' => $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID,
                'eventNameError' => '',
                'descriptionError' => '',
                'startDateTimeError' => '',
                'endDateTimeError' => '',
                'locationError' => '',
                'eventTypeError' => '',
                'organizationError' => '',
                'approvalStatusError' => '',
                'studentIdError' => '',
            ];
            $id = $this->outsideEventModel->getMaxEventId();
            if(empty($id)){
                $data['eventId'] = "OE0001";
            }
            else{
                $id = substr($id, 2);
                $id = intval($id);
                $id = $id + 1;
                $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                $data['eventId'] = 'OE' . $id;
            }
            // Validate Event Name
            if (empty($data['eventName'])) {
                $data['eventNameError'] = 'Please enter event name';
            }
            // Validate Description
            if (empty($data['description'])) {
                $data['descriptionError'] = 'Please enter description';
            }
            // Validate Start Date and Time
            if (empty($data['startDateTime'])) {
                $data['startDateTimeError'] = 'Please enter start date and time';
            }
            // Validate End Date and Time
            if (empty($data['endDateTime'])) {
                $data['endDateTimeError'] = 'Please enter end date and time';
            }
            if ($data['startDateTime'] > $data['endDateTime']) {
                $data['endDateTimeError'] = 'End date and time must be later than start date and time';
            }
            if ($data['startDateTime'] == $data['endDateTime']) {
                $data['endDateTimeError'] = 'End date and time must be later than start date and time';
            }
            if ($data['endDateTime'] >= date("Y-m-d H:i:s")) {
                $data['endDateTimeError'] = 'You can only add event after the event ended';
            }
            // Validate Location
            if (empty($data['location'])) {
                $data['locationError'] = 'Please enter location';
            }
            // Validate Event Type
            if (empty($data['eventType'])) {
                $data['eventTypeError'] = 'Please enter event type';
            }
            if (empty($data['eventNameError']) && empty($data['descriptionError']) && empty($data['startDateTimeError']) && empty($data['endDateTimeError']) && empty($data['locationError']) && empty($data['eventTypeError'])) {
                if ($this->outsideEventModel->addEvent($data)) {
                    echo "<script>alert('Event added successfully.'); window.location.href = '" . URLROOT . "/students/viewOutsideEvents';</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
            $this->view('students/addOutsideEvent', $data);
        }
        $this->view('students/addOutsideEvent', $data);
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
        if(!empty($event_participated)){
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
        else{
            echo "<script>alert('You have not participated any event yet.');window.location.href = '" . URLROOT . "/students/viewUpcomingEvents';</script>";    
        }
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
        if($participated == true){
            $event->participant_id = $this->participateModel->get_participant_id($studentid, $eventid);
            //check if feedback already submitted
            $feedback = $this->feedbackModel->getfeedbackByParticipantId($event->participant_id);
        }
        if($participated == false && $event->StartDateAndTime > $current_date){
            $event->canparticipate = true;
        } //if event participated and event is not expired
        else if($participated == true && $event->StartDateAndTime > $current_date){
            $event->cancancel = true;
        } //if event participated and event is ended and
        else if($participated == true && $event-> EndDateAndTime < $current_date && empty($feedback)){
            $event->canfeedback = true;
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

    public function viewOutsideEvents() {
        $data = [
            'title' => 'Outside Events',
            'events' => '',
            'Error' => '',
        ];
        $data['events'] = $this->outsideEventModel->getAllEvent();
        $this->view('students/viewOutsideEvents', $data);
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