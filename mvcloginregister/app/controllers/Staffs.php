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
    //index function
    public function index(){
        $this->view('staffs/index');
    }
}
?>