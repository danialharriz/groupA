<?php

class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');
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

        $events = $this->studentModel->getUpcomingEvents();
        $data['events'] = $events;

        $this->view('students/student_view_upcoming_events', $data);
    }
}

?>