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

        //check if user is logged in
        if (!isLoggedIn()) {
            //redirect to login page if not logged in
            header('location: ' . URLROOT . '/users/login');
        }
        //check if user is staff
        if  ($_SESSION['role'] != '1') {
            //redirect to login page if not logged in
            header('location: ' . URLROOT . '/users/logout');
        }
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
                'rewardPoints' => '',
                'deadline' => trim($_POST['deadline']),
                'maxParticipant' => trim($_POST['max_participant']),
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
                'deadline_err' => '',
                'max_participant_err' => '',
                //'validated_err' => '',
            ];
            $start_date = new DateTime($data['startDateAndTime']);
            $end_date = new DateTime($data['endDateAndTime']);
            $interval = $start_date->diff($end_date);

            // Calculate total hours in addition to days
            $total_hours = $interval->h + ($interval->days * 24);

            // reward points = duration (hours) < 24 hours = 1, 24.1 hours = 2, 48.1 hours = 3, etc.
            // event type 1 = 10, type 2 = 20, type 3 = 30, type 4 = 40, type 5 = 0
            if ($data['eventType'] == 1) {
                $data['rewardPoints'] = ceil($total_hours / 24) * 10;
            } else if ($data['eventType'] == 2) {
                $data['rewardPoints'] = ceil($total_hours / 24) * 20;
            } else if ($data['eventType'] == 3) {
                $data['rewardPoints'] = ceil($total_hours / 24) * 30;
            } else if ($data['eventType'] == 4) {
                $data['rewardPoints'] = ceil($total_hours / 24) * 40;
            } else if ($data['eventType'] == 5) {
                $data['rewardPoints'] = 0;
            }
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
            //start time must be 3 day later than current time
            if($data['startDateAndTime'] < date("Y-m-d H:i:s", strtotime("+3 days"))){
                $data['start_date_and_time_err'] = 'Start date and time must be 3 days later than current time';
                echo "<script>alert('Start date and time must be 3 days later than current time');</script>";
            }
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) && empty($data['organization_id_err']) && empty($data['end_date_and_time_err'])) {
                // Validated
                // Register event
                //upload picture
                if(isset($_FILES["image"])){
                    $target_dir = "event_pictures/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    
                    //check if file name already exist
                    if (file_exists($target_file)) {
                        //auto rename file
                        $i = 1;
                        while (file_exists($target_file)) {
                            $target_file = $target_dir . basename($_FILES["image"]["name"], "." . $imageFileType) . $i . "." . $imageFileType;
                            $i++;
                        }
                    }
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        $data['picture'] = $target_file;
                    } else {
                        $data['picture'] = null;
                    }
                } else {
                    $data['picture'] = null;
                }

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
                'deadline' => '',
                'maxParticipant' => '',
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                'deadline_err' => '',
                'max_participant_err' => '',
                //'validated_err' => '',
            ];
            // Load view
            $this->view('staffs/create_event', $data);
        }
        $this->view('staffs/create_event');
    }
    public function update_event() {
        //get event id from url
        $url = $this->getUrl();
        $eventId = $url[2];
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check if post type is updatepic
            if(isset($_POST['posttype'])){
                //upload picture
                if(isset($_FILES["picture"])){
                    $target_dir = "event_pictures/";
                    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    
                    //check if file name already exist
                    if (file_exists($target_file)) {
                        //auto rename file
                        $i = 1;
                        while (file_exists($target_file)) {
                            $target_file = $target_dir . basename($_FILES["picture"]["name"], "." . $imageFileType) . $i . "." . $imageFileType;
                            $i++;
                        }
                    }
                    if(move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)){
                        //delete old picture
                        $event = $this->eventModel->getEventById($eventId);
                        if($event->Picture != null){
                            unlink($event->Picture);
                        }
                        $data['picture'] = $target_file;
                    } else {
                        $data['picture'] = null;
                    }
                } else {
                    $data['picture'] = null;
                }
                //update picture
                if($this->eventModel->updatePicture($eventId, $data['picture'])){
                    echo "<script>alert('Picture updated successfully'); window.location.href = '" . URLROOT . "/staffs/update_event/$eventId';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            }
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
                'rewardPoints' => '',
                'deadline' => trim($_POST['deadline']),
                'maxParticipant' => trim($_POST['MaxParticipants']),
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
                'deadline_err' => '',
                //'validated_err' => '',
            ];
            $start_date = new DateTime($data['startDateAndTime']);
            $end_date = new DateTime($data['endDateAndTime']);
            $interval = $start_date->diff($end_date);

            // Calculate total hours in addition to days
            $total_hours = $interval->h + ($interval->days * 24);

            // Calculate reward points based on event type
            switch ($data['eventType']) {
                case 1:
                    $data['rewardPoints'] = ceil($total_hours / 24) * 10;
                    break;
                case 2:
                    $data['rewardPoints'] = ceil($total_hours / 24) * 20;
                    break;
                case 3:
                    $data['rewardPoints'] = ceil($total_hours / 24) * 30;
                    break;
                case 4:
                    $data['rewardPoints'] = ceil($total_hours / 24) * 40;
                    break;
                case 5:
                    $data['rewardPoints'] = 0;
                    break;
                default:
                    $data['rewardPoints'] = 0; // Handle any unexpected event type
            }
         
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
                    echo "<script>alert('Event updated successfully'); window.location.href = '" . URLROOT . "/staffs/all_events';</script>";
                } else {
                    echo "<script>alert('Something went wrong');</script>";
                }
            } else {
                // Load view with errors
                $this->view('staffs/update_event', $data);
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
                'deadline' => $event->Deadline,
                'maxParticipant' => $event->MaxParticipants,
                'picture' => $event->Picture,
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                'deadline_err' => '',
                'maxParticipant_err' => '',
                //'validated_err' => '',
            ];
            // Load view
            $this->view('staffs/update_event', $data);
        }
        $this->view('staffs/update_event');
    }
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
                    echo "<script>alert('Event deleted successfully'); window.location.href = '" . URLROOT . "/staffs/all_events';</script>";
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
        $this->view('staffs/show_participants', $data);
    }
    public function remove_participant($participantID){
        if($this->participantModel->cancel_participation($participantID)){
            echo "<script>alert('Participant removed successfully'); window.location.href = '" . URLROOT . "/staffs/all_events';</script>";
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
        $this->view('staffs/feedback', $data);
    }
    public function all_events(){
        $orgid = $this->staffModel->getOrganizationId($_SESSION['user_id']);
        $events = $this->eventModel->getEventByOrganizationId($orgid);
        //get the organizer name of each event
        foreach($events as $event){
            $event->Organization = $this->organizationModel->getOrganizationById($event->OrganizationID);
        }
        $data = [
            'events' => $events,
        ];
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            if ($search == "Workshop" || $search == "workshop"){
                $search = 1;
            } else if ($search == "Seminar" || $search == "seminar"){
                $search = 2;
            } else if ($search == "Conference" || $search == "conference"){
                $search = 3;
            } else if ($search == "Competition" || $search == "competition"){
                $search = 4;
            } else if ($search == "Others" || $search == "others"){
                $search = 5;
            } else {
                $search = $search;
            }
            $events = $this->eventModel->searchEventOrg($search, $orgid);
            foreach($events as $event){
                $event->Organization = $this->organizationModel->getOrganizationById($event->OrganizationID);
            }
            $data = [
                'events' => $events,
            ];
        }
        $this->view('staffs/all_events', $data);
    }
    public function profile(){
        $data = [
            'title' => 'Profile',
            'student' => '',
            'nameError' => '',
            'emailError' => '',
            'phoneError' => '',
            'organization_idError' => '',
            'courseError' => '',
            'addressError' => '',
            'date_of_birthError' => '', 
        ]; 
        $data['staff'] = $this->staffModel->getStaffByUserId($_SESSION['user_id']);
        $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
        $data['organization'] = $this->organizationModel->getOrganizationById($data['staff']->OrganizationID);
        //if post update profile
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(trim($_POST['type']) == "updateprofilepic"){
                $data = [
                    'title' => 'Profile Picture',
                    'user' => $this->userModel->getUserById($_SESSION['user_id']),
                    'profilePic' => '',
                    'profilePicError' => '',
                    'nameError' => '',
                    'emailError' => '',
                    'phoneError' => '',
                ];
                $data['staff'] = $this->staffModel->getStaffByUserId($_SESSION['user_id']);
                $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
                $data['organization'] = $this->organizationModel->getOrganizationById($data['staff']->OrganizationID);
                
                $target_dir = "profile_pictures/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                //check if file name already exist
                if (file_exists($target_file)) {
                    //auto rename file
                    $i = 1;
                    while (file_exists($target_file)) {
                        $target_file = $target_dir . basename($_FILES["image"]["name"], "." . $imageFileType) . $i . "." . $imageFileType;
                        $i++;
                    }
                }
                if ($check !== false) {
                    //delete old profile picture
                    if($data['user']->profilePic != "profile_pictures/default.png"){
                        unlink($data['user']->profilePic);
                    }
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $data['profilePic'] = $target_file;
                        if ($this->userModel->updateProfilePic($data)) {
                            echo "<script>alert('Profile picture updated successfully.'); window.location.href = '" . URLROOT . "/staffs/profile';</script>";
                        } else {
                            echo "<script>alert('Something went wrong. Please try again.');</script>";
                        }
                    } else {
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('File is not an image.');</script>";
                }
            }

            if(trim($_POST['type']) == "updateprofile"){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'title' => 'Profile',
                    'staff' => $this->staffModel->getStaffByUserId($_SESSION['user_id']),
                    'user' => $this->userModel->getUserById($_SESSION['user_id']),
                    'organization' => $this->organizationModel->getOrganizationById($data['staff']->OrganizationID),
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'nameError' => '',
                    'emailError' => '',
                ];
                // Validate name
                if (empty($data['name'])) {
                    $data['nameError'] = 'Please enter name';
                }
                // Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email';
                } else {
                    // Check email
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        if ($data['email'] != $data['user']->Email) {
                            $data['emailError'] = 'Email is already taken';
                        }
                    }
                }
                // Make sure errors are empty
                if (empty($data['nameError']) && empty($data['emailError'])) {
                    // Validated
                    // Update user
                    if ($this->userModel->updateUser($data)) {
                        // Redirect to login
                        echo "<script>alert('Profile updated successfully.'); window.location.href = '" . URLROOT . "/staffs/profile';</script>";
                    } else {
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                } else {
                    // Load view with errors
                    $this->view('staffs/profile', $data);
                }
            }
            $this->view('staffs/profile', $data);
        }
        $this->view('staffs/profile', $data);
    }
    public function changepassword(){
        //if post change password
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Process form
            $data = [
                'title' => 'Change Password',
                'current_password' => trim($_POST['current_password']),
                'new_password' => trim($_POST['new_password']),
                'confirm_new_password' => trim($_POST['confirm_new_password']),
                'current_passwordError' => '',
                'new_passwordError' => '',
                'confirm_new_passwordError' => '',
            ];
            // Validate Current Password
            if (empty($data['current_password'])) {
                $data['current_passwordError'] = 'Please enter current password';
            }
            // Validate New Password
            if (empty($data['new_password'])) {
                $data['new_passwordError'] = 'Please enter new password';
            }
            // Validate Confirm New Password
            if (empty($data['confirm_new_password'])) {
                $data['confirm_new_passwordError'] = 'Please enter confirm new password';
            }
            if($data['new_password'] != $data['confirm_new_password']){
                $data['confirm_new_passwordError'] = 'Confirm new password must be same as new password';
            }
            if(empty($data['current_passwordError']) && empty($data['new_passwordError']) && empty($data['confirm_new_passwordError'])){
                $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
                if($this->userModel->login($data['user']->Email, $data['current_password'])){
                    if($this->userModel->updatePassword($data)){
                        echo "<script>alert('Password changed successfully.'); window.location.href = '" . URLROOT . "/staffs/profile';</script>";
                    }else{
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                }else{
                    $data['current_passwordError'] = 'Current password is incorrect';
                    $this->view('staffs/changepassword', $data);
                }
            }
            $this->view('staffs/changepassword', $data);
        }
        $data = [
            'title' => 'Change Password',
            'current_password' => '',
            'new_password' => '',
            'confirm_new_password' => '',
            'current_passwordError' => '',
            'new_passwordError' => '',
            'confirm_new_passwordError' => '',
        ];
        $this->view('staffs/changepassword', $data);
    }
    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
        }
    }
    public function student(){
        $url = $this->getUrl();
        $studentId = $url[2];
        $student = $this->studentModel->getStudentById($studentId);
        $student->User = $this->userModel->getUserById($student->UserID);
        $student->Organization = $this->organizationModel->getOrganizationById($student->OrganizationID);
        $data = [
            'student' => $student,
        ];
        $this->view('staffs/student', $data);
    }
    //index function
    public function index(){
        $orgid = $this->staffModel->getOrganizationId($_SESSION['user_id']);
        $events = $this->eventModel->getEventByOrganizationId($orgid);
        //get the organizer name of each event
        foreach($events as $event){
            $event->Organization = $this->organizationModel->getOrganizationById($event->OrganizationID);
        }
        $data = [
            'events' => $events,
        ];
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            if ($search == "Workshop" || $search == "workshop"){
                $search = 1;
            } else if ($search == "Seminar" || $search == "seminar"){
                $search = 2;
            } else if ($search == "Conference" || $search == "conference"){
                $search = 3;
            } else if ($search == "Competition" || $search == "competition"){
                $search = 4;
            } else if ($search == "Others" || $search == "others"){
                $search = 5;
            } else {
                $search = $search;
            }
            $events = $this->eventModel->searchEventOrg($search, $orgid);
            foreach($events as $event){
                $event->Organization = $this->organizationModel->getOrganizationById($event->OrganizationID);
            }
            $data = [
                'events' => $events,
            ];
        }
        $data['totalEvent'] = count($data['events']);
        $this->view('staffs/index', $data);
    }
}
?>