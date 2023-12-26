<?php 

class Activities extends Controller{
    public function __construct(){
        $this->activityModel = $this->model('Activity');
    }

    public function index(){
        $activities = $this->activityModel->manageAllActivities();

        $data = [
            'activities' => $activities
        ];
        
        $this->view('activities/index', $data);
    }

    public function create()
    {
        // if (!isLoggedIn()){
        //     header("Location: " . URLROOT. "/posts" );
        // }

        $data = 
        [
            'act_title' => '',
            'act_desc' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'user_id' => $_SESSION['user_id'],
            'act_title' => trim($_POST['act_title']),
            'act_desc' => trim($_POST['act_desc'])
            ];


            if ($data['act_title'] && $data['act_desc']){
                if ($this->activityModel->addActivity($data)){
                    header("Location: " . URLROOT. "/activities" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('activities/index', $data);
            }
        }

        $this->view('activities/index', $data);
    }

}
?>