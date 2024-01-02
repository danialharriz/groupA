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

    public function viewUpcomingEvents() {
        $data = [
            'title' => 'Upcoming Events',
            'events' => '',
            'Error' => '',
        ];
        $event_participated = $this->participateModel->get_eventid($_SESSION['user_id']);
        $events = $this->studentModel->getUpcomingEvents();
        //get event organization name
        foreach ($events as $event) {
            $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        }
        $data['events'] = $events;

        $this->view('students/ViewUpcomingEvents', $data);
    }
    public function view_event(){
        
        $eventid = $this->getUrl()[2];
        $data = [
            'title' => 'View Event',
            'event' => '',
            'Error' => '',
        ];
        $event = $this->eventModel->getEventById($eventid);
        $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        $data['event'] = $event;
        $this->view('students/view_event', $data);
    }
    public function participate(){
        $eventid = $this->getUrl()[2];
        $studentid = $_SESSION['user_id'];
        $data = [
            'title' => 'Participate',
            'event' => '',
            'Error' => '',
        ];
        $event = $this->eventModel->getEventById($eventid);
        $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        $data['event'] = $event;
        $this->view('students/participate', $data);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the user input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Participate',
                'event' => $event,
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
    }
    public function cancel_participation(){
        $eventid = $this->getUrl()[2];
        $studentid = $_SESSION['user_id'];
        $data = [
            'title' => 'Participate',
            'event' => '',
            'Error' => '',
        ];
        if($this->participateModel->cancel_participation($studentid, $eventid)){
            header ('location: ' . URLROOT . '/users/viewUpcomingEvents');
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