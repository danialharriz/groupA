<?php 

class Activities extends Controller{
    public function __construct(){
        $this->activityModel = $this->model('Activity');
    }

    public function index(){
        
        $this->view('activities/index');
    }

}
?>