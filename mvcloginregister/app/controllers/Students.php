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
        $this->courseModel = $this->model('Course');
        $this->rewardModel = $this->model('Reward');

        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/logout');
        }
        if (isLoggedIn() && $_SESSION['role'] != 2) {
            header('location: ' . URLROOT . '/users/logout');    
        }
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

    public function viewOutsideEvents() {
        $student_id = $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID;
        $data = [
            'title' => 'Outside Events',
            'events' => '',
            'Error' => '',
        ];
        $data['events'] = $this->outsideEventModel->getEventByStudentId($student_id);
        if(empty($data['events'])){
            echo "<script>alert('You have not added any outside event yet.');window.location.href = '" . URLROOT . "/students/viewUpcomingEvents';</script>";    
        }
        $this->view('students/viewOutsideEvents', $data);
    }

    public function viewOutsideEvent(){
        $url = $this->getUrl();
        $eventid = $url[2];
        $data = [
            'title' => 'View Outside Event',
            'event' => '',
            'Error' => '',
        ];
        $data['event'] = $this->outsideEventModel->getEventById($eventid);
        $this->view('students/viewOutsideEvent', $data);
    }

    public function deleteOutsideEvent() {
        $url = $this->getUrl();
        $eventid = $url[2];
        $data = [
            'title' => 'Delete Outside Event',
            'event' => '',
            'Error' => '',
        ];
        $data['event'] = $this->outsideEventModel->getEventById($eventid);
        if ($this->outsideEventModel->deleteEvent($eventid)) {
            echo "<script>alert('Event deleted successfully.'); window.location.href = '" . URLROOT . "/students/viewOutsideEvents';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }

    public function updateOutsideEvent() {
        $url = $this->getUrl();
        $eventid = $url[2];
        //fetch existing event details
        $data = [
            'title' => 'Update Outside Event',
            'event' => '',
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
        $data['event'] = $this->outsideEventModel->getEventById($eventid);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'title' => 'Update Outside Event',
                'eventId' => $eventid, //this is the event id of the event that is being updated, not the new event id
                'event' => $this->outsideEventModel->getEventById($eventid),
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
                if ($this->outsideEventModel->updateEvent($data)) {
                    echo "<script>alert('Event updated successfully.'); window.location.href = '" . URLROOT . "/students/viewOutsideEvents';</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
            $this->view('students/updateOutsideEvent', $data);
        }
        $this->view('students/updateOutsideEvent', $data);
    }

    public function feedback(){
        $url = $this->getUrl();
        $participantid = $url[2];
        $data = [
            'title' => 'Feedback',
            'event' => '',
            'Error' => '',
        ];
        $eventid = $this->participateModel->getParticipantByParticipantId($participantid)->EventID;
        $data['event'] = $this->eventModel->getEventById($eventid);
        //if post add feedback
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Process form
            $data = [
                'title' => 'Feedback',
                'event' => $this->eventModel->getEventById($eventid),
                'participant_id' => $participantid,
                'feedback' => trim($_POST['feedback']),
                'feedbackError' => '',
                'event_id' => $eventid,
            ];
            $fid = $this->feedbackModel->getMaxFeedbackId();
            if(empty($fid)){
                $data['feedback_id'] = "F00001";
            }
            else{
                $fid = substr($fid, 1);
                $fid = intval($fid);
                $fid = $fid + 1;
                $fid = str_pad($fid, 5, '0', STR_PAD_LEFT);
                $data['feedback_id'] = 'F' . $fid;
            }
            // Validate Feedback
            if (empty($data['feedback'])) {
                $data['feedbackError'] = 'Please enter feedback';
            }
            if (empty($data['feedbackError'])) {
                $data['submitted_date_and_time'] = date("Y-m-d H:i:s");
                if ($this->feedbackModel->addFeedback($data)) {
                    echo "<script>alert('Feedback submitted successfully.'); window.location.href = '" . URLROOT . "/students/event_participated';</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
            $this->view('students/feedback', $data);
        }
        $this->view('students/feedback', $data);
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
                        echo "<script>alert('Password changed successfully.'); window.location.href = '" . URLROOT . "/students/profile';</script>";
                    }else{
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                }else{
                    $data['current_passwordError'] = 'Current password is incorrect';
                    $this->view('students/changepassword', $data);
                }
            }
            $this->view('students/changepassword', $data);
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
        $this->view('students/changepassword', $data);
    }
    public function reward(){
        $data = [
            'title' => 'Reward',
            'rewards' => '',
            'Error' => '',
        ];
        $points = 0;
        $student_id = $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID;
        $events = $this->participateModel->get_eventid($student_id);
        if($events){
            foreach ($events as $event) {
                if($event->event_details->EndDateAndTime > date("Y-m-d H:i:s")){
                    $points += $this->eventModel->getEventById($event->EventID)->RewardPoints;
                }
            }
        }
        $data['points'] = $points;
        $data['rewards'] = $this->rewardModel->getAllRewards();
        $stage = 0;
        $totalstage = 0;
        foreach ($data['rewards'] as $reward) {
            if ($points >= $reward->RewardPoints) {
                $stage++;
            }
            $totalstage++;
        }
        $data['stage'] = $stage;
        $data['totalstage'] = $totalstage;
        $this->view('students/reward', $data);
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
        $data['student'] = $this->studentModel->getStudentByUserId($_SESSION['user_id']);
        $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
        $data['organization'] = $this->organizationModel->getOrganizationById($data['student']->OrganizationID);
        //if post update profile
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(trim($_POST['type']) == "updateprofile"){
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Process form
                $data = [
                    'title' => 'Profile',
                    'student' => $this->studentModel->getStudentByUserId($_SESSION['user_id']),
                    'user' => $this->userModel->getUserById($_SESSION['user_id']),
                    'student_id' => $this->studentModel->getStudentByUserId($_SESSION['user_id'])->StudentID,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'organization_id' => $this->studentModel->getStudentByUserId($_SESSION['user_id'])->OrganizationID,
                    'course' => $this->studentModel->getStudentByUserId($_SESSION['user_id'])->CourseID,
                    'address' => trim($_POST['address']),
                    'gender' => trim($_POST['gender']),
                    'date_of_birth' => trim($_POST['date_of_birth']),
                    'nameError' => '',
                    'emailError' => '',
                    'phoneError' => '',
                    'organization_idError' => '',
                    'courseError' => '',
                    'addressError' => '',
                    'date_of_birthError' => '',
                ];
                // Validate Name
                if (empty($data['name'])) {
                    $data['nameError'] = 'Please enter name';
                }
                // Validate Email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email';
                }
                // Validate Phone
                if (empty($data['phone'])) {
                    $data['phoneError'] = 'Please enter phone';
                }
                // Validate Organization ID
                if (empty($data['organization_id'])) {
                    $data['organization_idError'] = 'Please enter organization id';
                }
                // Validate Course
                if (empty($data['course'])) {
                    $data['courseError'] = 'Please enter course';
                }
                // Validate Address
                if (empty($data['address'])) {
                    $data['addressError'] = 'Please enter address';
                }
                if (empty($data['date_of_birth'])) {
                    $data['date_of_birthError'] = 'Please enter date of birth';
                }
    
                if(empty($data['nameError']) && empty($data['emailError']) && empty($data['organization_idError']) && empty($data['courseError']) && empty($data['addressError']) && empty($data['date_of_birthError'])){
                    if($this->userModel->updateUser($data) && $this->studentModel->updateStudent($data)){
                        echo "<script>alert('Profile updated successfully.'); window.location.href = '" . URLROOT . "/students/profile';</script>";
                    }else{
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                }
            }

            if(trim($_POST['type']) == "updateprofilepic"){
                $data = [
                    'title' => 'Profile Picture',
                    'user' => $this->userModel->getUserById($_SESSION['user_id']),
                    'profilePic' => '',
                    'profilePicError' => '',
                    'nameError' => '',
                    'emailError' => '',
                    'phoneError' => '',
                    'organization_idError' => '',
                    'courseError' => '',
                    'addressError' => '',
                    'date_of_birthError' => '',
                ];
                $data['student'] = $this->studentModel->getStudentByUserId($_SESSION['user_id']);
                $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
                $data['organization'] = $this->organizationModel->getOrganizationById($data['student']->OrganizationID);
                
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
                    //delete existing profile picture
                    if($data['user']->profilePic != null){
                        unlink($data['user']->profilePic);
                    }
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $data['profilePic'] = $target_file;
                        if ($this->userModel->updateProfilePic($data)) {
                            echo "<script>alert('Profile picture updated successfully.'); window.location.href = '" . URLROOT . "/students/profile';</script>";
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
            
            $this->view('students/profile', $data);
        }
        $this->view('students/profile', $data);
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