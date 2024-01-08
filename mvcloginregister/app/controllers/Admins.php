<?php
class Admins extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('Staff');
        $this->organizationModel = $this->model('Organization');
        $this->eventModel = $this->model('Event');      
        $this->courseModel = $this->model('Course');
        $this->participantModel = $this->model('Participant');
        $this->outsideEventModel = $this->model('EventOutside');
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->feedbackModel = $this->model('Feedback');

        //check if user is logged in
        if (!isLoggedIn()) {
            //if not logged in, redirect to login page
            header('location: ' . URLROOT . '/users/login');
        }
        //check if user is admin
        if ($_SESSION['role'] != 3) {
            //if not admin, redirect to login page
            header('location: ' . URLROOT . '/users/logout');
        }
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
                echo "<script>alert('Organization registered successfully'); window.location.href = '" . URLROOT . "/admins/organization';</script>";
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
    public function organization(){
        $organizations = $this->organizationModel->getAllOrganizations();
        $data = [
            'organizations' => $organizations,
        ];
        $this->view('admins/organization', $data);
    }
    public function deleteOrganization(){
        $url = $this->getUrl();
        $organizationId = $url[2];
        if($this->organizationModel->deleteOrganization($organizationId)){
            echo "<script>alert('Organization deleted successfully'); window.location.href = '" . URLROOT . "/admins/organization';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    public function editOrganization(){
        $url = $this->getUrl();
        $organizationId = $url[2];
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'organizationId' => $organizationId,
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
            if ($this->organizationModel->updateOrganization($data)) {
                echo "<script>alert('Organization updated successfully'); window.location.href = '" . URLROOT . "/admins/organization';</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }
        } else {
            // Get existing organization from model
            $organization = $this->organizationModel->getOrganizationById($organizationId);

            $data = [
                'organization' => $organization,
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
            $this->view('admins/editOrganization', $data);
        }
        $this->view('admins/editOrganization');
    }
    public function register_course() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate course id
            $course_id = $this->courseModel->getMaxId();
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
                'organizationId' => trim($_POST['organizationId']),
                'courseName' => trim($_POST['courseName']),
                'course_id_err' => '',
                'organization_id_err' => '',
                'course_name_err' => '',
            ];
            //run add model
            if ($this->courseModel->addCourse($data)) {
                echo "<script>alert('Course registered successfully'); window.location.href = '" . URLROOT . "/admins/course';</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }
        } else {
            // Init data
            $data = [
                'courseId' => '',
                'organizationId' => '',
                'courseName' => '',
                'course_id_err' => '',
                'organization_id_err' => '',
                'course_name_err' => '',
                'organizations' => $this->organizationModel->getAllInstitute(),
            ];
            // Load view
            $this->view('admins/register_course', $data);
        }
        $this->view('admins/register_course');
    }
    public function course(){
        $courses = $this->courseModel->getAllCourse();
        foreach($courses as $course){
            $course->Organization = $this->organizationModel->getOrganizationById($course->OrganizationID);
        }
        $data = [
            'courses' => $courses,
        ];
        $this->view('admins/course', $data);
    }
    public function delete_course(){
        $url = $this->getUrl();
        $courseId = $url[2];
        if($this->courseModel->deleteCourse($courseId)){
            echo "<script>alert('Course deleted successfully'); window.location.href = '" . URLROOT . "/admins/course';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
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
        //get all participants of the event
        $participantId = $this->participantModel->getParticipantByEventId($eventId);
        //delete all feedbacks of the event
        if($this->feedbackModel->deleteFeedbackByParticipantId($participantId)){
            //delete all participants of the event
            if($this->participantModel->deleteParticipantByEventId($eventId)){
                //delete event
                if($this->eventModel->deleteEvent($eventId)){
                    echo "<script>alert('Event deleted successfully'); window.location.href = '" . URLROOT . "/admins/all_events';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }
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
    public function show_participants($eventId){
        $participants = $this->participantModel->getParticipantByEventId($eventId);
        foreach ($participants as $participant){
            $participant->Student = $this->studentModel->getStudentById($participant->StudentID);
            $participant->User = $this->userModel->getUserById($participant->Student->UserID);
            $participant->Organization = $this->organizationModel->getOrganizationById($participant->Student->OrganizationID);
        }
        $data = [
            'participants' => $participants,
        ];
        $this->view('admins/show_participants', $data);
    }
    public function remove_participant($participantID){
        if($this->participantModel->cancel_participation($participantID)){
            echo "<script>alert('Participant removed successfully'); window.location.href = '" . URLROOT . "/admins/all_events';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    public function feedback(){
        $url = $this->getUrl();
        $eventId = $url[2];
        $feedbacks = $this->feedbackModel->getFeedbackByEventId($eventId);
        $event = $this->eventModel->getEventById($eventId);
        foreach($feedbacks as $feedback){
            $feedback->Participant = $this->participantModel->getParticipantByParticipantId($feedback->ParticipantID);
            $feedback->Student = $this->studentModel->getStudentById($feedback->Participant->StudentID);
            $feedback->User = $this->userModel->getUserById($feedback->Student->UserID);
        }
        $data = [
            'feedbacks' => $feedbacks,
            'event' => $event,
        ];
        $this->view('admins/feedback', $data);
    }
    public function pending_approval_staff(){
        $staffs = $this->adminModel->getPendingStaff();
        foreach($staffs as $staff){
            $staff->OrganizationName = $this->organizationModel->getOrganizationName($staff->OrganizationID);
            $staff->User = $this->userModel->getUserById($staff->UserID);
        }
        $data = [
            'staffs' => $staffs,
        ];
        $this->view('admins/pending_approval_staff', $data);
    }
    //approve staff
    public function approve_staff(){
        $url = $this->getUrl();
        $staffId = $url[2];
        $userid = $this->adminModel->getStaff($staffId)->UserID;
        if($this->adminModel->approveStaff($staffId)){
            $orgid = $this->adminModel->getStaff($staffId)->OrganizationID;
            if($orgid = "O00001"){
                if($this->userModel->setRole($userid, 3)){
                    echo "<script>alert('Staff approved successfully'); window.location.href = '" . URLROOT . "/admins/pending_approval_staff';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                if($this->userModel->setRole($userrid, 1)){
                    echo "<script>alert('Staff approved successfully'); window.location.href = '" . URLROOT . "/admins/pending_approval_staff';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            }
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    //reject staff
    public function reject_staff(){
        $url = $this->getUrl();
        $staffId = $url[2];
        if($this->adminModel->rejectStaff($staffId)){
            echo "<script>alert('Staff rejected successfully'); window.location.href = '" . URLROOT . "/admins/pending_approval_staff';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    //view all outside events
    public function viewOutsideEvents(){
        $outsideEvents = $this->outsideEventModel->getEventNA();
        $data = [
            'outsideEvents' => $outsideEvents,
        ];
        $this->view('admins/viewOutsideEvents', $data);
    }
    //view outside event
    public function view_outside_event(){
        $url = $this->getUrl();
        $eventId = $url[2];
        $outsideEvent = $this->outsideEventModel->getEventById($eventId);
        $data = [
            'eventId' => $eventId,
            'eventName' => $outsideEvent->OEventName,
            'description' => $outsideEvent->ODescription,
            'startDateAndTime' => $outsideEvent->OStartDateAndTime,
            'endDateAndTime' => $outsideEvent->OEndDateAndTime,
            'location' => $outsideEvent->OLocation,
            'eventType' => $outsideEvent->OEventType,
            'organization' => $outsideEvent->OOrganization,
            'event_id_err' => '',
            'event_name_err' => '',
            'description_err' => '',
            'start_date_and_time_err' => '',
            'end_date_and_time_err' => '',
            'location_err' => '',
            'event_type_err' => '',
            'organization_err' => '',
        ];
        //show request student info
        $data['student'] = $this->studentModel->getStudentById($outsideEvent->studentID);
        //student user info
        $data['user'] = $this->userModel->getUserById($data['student']->UserID);
        $this->view('admins/view_outside_event', $data);
    }
    //approve outside event
    public function approve_outside_event($eventId){
        if($this->outsideEventModel->approveEvent($eventId)){
            echo "<script>alert('Event approved successfully'); window.location.href = '" . URLROOT . "/admins/viewOutsideEvents';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    //reject outside event
    public function reject_outside_event($eventId){
        if($this->outsideEventModel->rejectEvent($eventId)){
            echo "<script>alert('Event rejected successfully'); window.location.href = '" . URLROOT . "/admins/viewOutsideEvents';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
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
    public function index() {
        $this->view('admins/index');
    }
}
?>