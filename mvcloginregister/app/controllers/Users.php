<?php

class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->organizationModel = $this->model('Organization');
        $this->courseModel = $this->model('Course');
        $this->staffModel = $this->model('Staff');
        $this->participantModel = $this->model('Participant');
        $this->studentModel = $this->model('Student');
        $this->resumeModel = $this->model('Resume');
    }
    
    public function signup() {
        $data = [
            'title' => 'Sign Up ',
            'userId' => '',
            'email' => '',
            'name' => '',
            'password' => '',
            'role' => '',
            'profilePic' => '',
            'credentialsError' => '',
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the user input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Sign Up ',
                'userId' => '',
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'role' => '',
                'profilePic' => '', // fix profile picture set here
                'credentialsError' => '',
            ];
            //check if email registered
            $emailRegistered = $this->userModel->findUserByEmail($data['email']); 
            // Validate the user input (you may want to add more validation)
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                echo "<script>alert('Please enter all required fields.');</script>";
            }
            else if (!empty($emailRegistered)) {
                echo "<script>alert('Email has been registered.');</script>";
            }
            else {
                // Hash the password (you should use a stronger hashing algorithm in a production environment)
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //get last user id, if no user, set userid to U0001 else increment by 1
                $lastUserId = $this->userModel->getLastUserId();
                if ($lastUserId) {
                    //get the last 4 digits of the last user id
                    $last4Digits = substr($lastUserId, -4);
                    //convert the last 4 digits to integer
                    $last4Digits = intval($last4Digits);
                    //increment by 1
                    $last4Digits++;
                    //convert back to string
                    $last4Digits = strval($last4Digits);
                    //pad with leading zeros
                    $last4Digits = str_pad($last4Digits, 4, '0', STR_PAD_LEFT);
                    //concatenate with U
                    $data['userId'] = 'U' . $last4Digits;
                } else {
                    $data['userId'] = 'U0001';
                }

                //Check Email
                $emailEnd = explode('@', $data['email']);

                //Run SQL
                $registerNewUser = $this->userModel->signup($data);
                if ($registerNewUser) {
                    echo "<script>alert('Registration successful!');</script>";
                    $loggedInUser = $this->userModel->login($data['email'], $_POST['password']);
                    if(empty($loggedInUser)){
                        echo "<script>alert('Something went wrong.');</script>";
                    }
                    else{
                        $this->createUserSession($loggedInUser);
                    }
                } else {
                    // Registration failed
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/signup', $data);
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'password' => '',
            'credentialsError' => '',
        ];

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the user input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'credentialsError' => '',
            ];

            //check if input is empty
            if (empty($data['email']) || empty($data['password'])) {
                // Handle validation errors
                $data['credentialsError'] = 'Please enter all required fields.';
            }

            if (empty($data['credentialsError'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    //$data['credentialsError'] = 'Password or username is incorrect. Please try again.';
                    echo "<script>alert('Password or username is incorrect. Please try again.');</script>";
                    $this->view('users/login', $data);
                    $data = [
                        'email' => '',
                        'password' => '',
                        'credentialsError' => '',
                    ];                    
                }
            }

        } else {
            $data = [
                'username' => '',
                'password' => '',
                'credentialsError' => '',
            ];
        }
        $this->view('users/login', $data);
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        header('location:' . URLROOT . '/users/login');
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->UserID;
        $_SESSION['username'] = $user->Name;
        $_SESSION['email'] = $user->Email;
        $_SESSION['role'] = $user->Role;
        if (empty($_SESSION['role'])) {
            // Redirect to the role selection page for first-time login
            header('location:' . URLROOT . '/users/selectRole'); // Change 'selectRole.php' to your actual role selection page
            exit();
        } 
        else {
            // Redirect to the specific page for the selected role
            //redirect to eg. users/staff_details.php or users/student_details.php
            $this->redirectToRole($_SESSION['role']);
        }
    }

    //redirect to /index for each role
    function redirectToRole($role) {
        switch ($role) {
            case 3:
                header('location:' . URLROOT . '/admins');
                break;
            case 1:
                header('location:' . URLROOT . '/staffs');
                break;
            case 2:
                header('location:' . URLROOT . '/students');
                break;
            default:
                header('location:' . URLROOT . '/users/selectRole');
                break;
        }
    }

    public function selectRole() {
        //verify if user already selected role
        if (!empty($_SESSION['role'])) {
            // Redirect to the specific page for the selected role
            //redirect to eg. users/staff_details.php or users/student_details.php
            header('location:' . URLROOT . '/users/' . $_SESSION['role'] . '_details');
            exit();
        }
        $staffAccount = $this->staffModel->getOrganizationId($_SESSION['user_id']);
        if ($staffAccount) {
            if ($_SESSION['role'] == 3) {
                header('location:' . URLROOT . '/admins');
            } else if ($_SESSION['role'] == 1) {
                header('location:' . URLROOT . '/staffs');
            }else if ($staffAccount->Validated == 0) {
                //logout ('location:' . URLROOT . '/users/logout');
                echo "<script>alert('Your staff account is pending for approval.'; window.location.href='logout';</script>";
            }
        }
        //get the email hosting after @
        $emailEnd = explode('@', $_SESSION['email']);
        $Org = $this->organizationModel->checkEmailEnding($emailEnd[1]);
        if(!empty($Org)){
            if($Org->Type == 1){
                header('location:' . URLROOT . '/users/student_details');
            }else if($Org->Type == 2){
                header('location:' . URLROOT . '/users/staff_details');
            }
        }
        $data = [
            'title' => 'Select Role',
            'selected_role' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $allowedRoles = ['student', 'staff'];
            if (in_array($_POST['selected_role'], $allowedRoles)) {
                // Redirect to the specific page for the selected role
                //redirect to eg. users/staff_details.php or users/student_details.php
                header('location:' . URLROOT . '/users/' . $_POST['selected_role'] . '_details');
                exit();
            } else {
                // Handle validation errors
                echo "Invalid role selected.";
            }
        }
        //check if user is logged in
        if (isset($_SESSION['user_id'])) {
            $this->view('users/selectRole');
        } else {
            header('location:' . URLROOT . '/users/login');
        }
    }
    public function staff_details() {
        //if user already
        $staffAccount = $this->staffModel->getOrganizationId($_SESSION['user_id']);
        if ($staffAccount) {
            if ($_SESSION['role'] == 3) {
                header('location:' . URLROOT . '/admins');
            } else if ($_SESSION['role'] == 1) {
                header('location:' . URLROOT . '/staffs');
            } 
        }
        $data = [
            'title' => 'Staff Details',
            'organizations' => $this->organizationModel->getAllCompany(),
            'jobTitle' => '',
            `organizationId` => '',
        ];
        $emailEnd = explode('@', $_SESSION['email']);
        $org = $this->organizationModel->checkEmailEnding($emailEnd[1]);
        if(!empty($org)){
            $data['organizationId'] = $org->OrganizationID;    
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Staff Details',
                'organizations' => $this->organizationModel->getAllCompany(),
                'jobTitle' => $_POST['jobTitle'],
                'type' => '',
                'staffId' => '',
                'organizationId' => '',
                'validated' => '',
            ];
            $emailEnd = explode('@', $_SESSION['email']);
            $org = $this->organizationModel->checkEmailEnding($emailEnd[1]);
            if(!empty($org)){
                $data['organizationId'] = $org->OrganizationID;    
            } else {
                $data['organizationId'] = $_POST['organizationId'];
            }
            // Validate the user input (you may want to add more validation)
            if (empty($data['jobTitle'])) {
                echo "<script>alert('Please enter all required fields.');</script>";
            //verify the user email if are member of organization
            } else if (!$this->organizationModel->verifyOrganizationEmail($data['organizationId'], $_SESSION['email'])) {
                $data['validated'] = 0;
                $registerNewStaff = $this->staffModel->addStaff($data);
                if ($registerNewStaff) {
                    echo "<script>alert('Your staff account is pending for approval. Use your organization email to avoid this.');</script>";
                } else {
                    // Registration failed
                    echo "<script>alert('Something went wrong.');</script>";
                }
            }else {
                //get last staff id, if no staff, set staffid to S0001 else increment by 1
                $lastStaffId = $this->staffModel->getLastStaffId();
                if ($lastStaffId) {
                    //get the last 4 digits of the last staff id
                    $last4Digits = substr($lastStaffId, -4);
                    //convert the last 4 digits to integer
                    $last4Digits = intval($last4Digits);
                    //increment by 1
                    $last4Digits++;
                    //convert back to string
                    $last4Digits = strval($last4Digits);
                    //pad with leading zeros
                    $last4Digits = str_pad($last4Digits, 4, '0', STR_PAD_LEFT);
                    //concatenate with S
                    $data['staffId'] = 'S' . $last4Digits;
                } else {
                    $data['staffId'] = 'S0001';
                }
                $data['validated'] = 1;
                //Run SQL
                $registerNewStaff = $this->staffModel->addStaff($data);
                if ($registerNewStaff) {
                    //if organization id is O0001, set type to 3, else set type to 1
                    if ($data['organizationId'] == 'O00001') {
                        $this -> userModel -> addRole(3);
                        $_SESSION['role'] = 3;
                    } else {
                        $this -> userModel -> addRole(1);
                        $_SESSION['role'] = 1;
                    }
                    $this -> redirectToRole($_SESSION['role']);

                    exit();

                } else {
                    // Registration failed
                    echo "<script>alert('Something went wrong.');</script>";
                }
            }
        }
        $this->view('users/staff_details', $data);
    }
    //student details
    public function student_details()
    {
        if(!empty($_SESSION['role'])){
            $this->redirectToRole($_SESSION['role']);
        }

        $emailEnd = explode('@', $_SESSION['email']);
        $org = $this->organizationModel->checkEmailEnding($emailEnd[1]);
        $institution = $this->organizationModel->getAllInstitute();
        $course = $this->courseModel->getAllCourse();

        if(empty($institution) || empty($course)){
            echo "<script>alert('Please add institution and course first.');</script>";
        }
        $data = [
            'title' => 'Student Details',
            'userID' => $_SESSION['user_id'],
            'studentID' => '',  
            'courseID' => '',
            'address' => '',
            'gender' => '',
            'dateOfBirth' => '',
            'resumeID' => '',
            'resume' => '',
            'institution' => $institution,
            'course' => $course,
        ];

        if(!empty($org)){
            $data['organizationId'] = $org->OrganizationID;    
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //get last student id, if no student, set studentid to S0001 else increment by 1
            $studentID = $this->studentModel->getMaxStudentId();
            if ($studentID) {
                //get the last 4 digits of the last student id
                $last4Digits = substr($studentID, -4);
                //convert the last 4 digits to integer
                $last4Digits = intval($last4Digits);
                //increment by 1
                $last4Digits++;
                //convert back to string
                $last4Digits = strval($last4Digits);
                //pad with leading zeros
                $last4Digits = str_pad($last4Digits, 4, '0', STR_PAD_LEFT);
                //concatenate with S
                $data['studentID'] = 'S' . $last4Digits;
            } else {
                $data['studentID'] = 'S0001';
            }

            //do the same for resume id
            $resumeID = $this->resumeModel->getMaxResumeId();
            if (!empty($resumeID)   ) {
                //get the last 4 digits of the last resume id
                $last4Digits = substr($resumeID, -4);
                //convert the last 4 digits to integer
                $last4Digits = intval($last4Digits);
                //increment by 1
                $last4Digits++;
                //convert back to string
                $last4Digits = strval($last4Digits);
                //pad with leading zeros
                $last4Digits = str_pad($last4Digits, 4, '0', STR_PAD_LEFT);
                //concatenate with R
                $data['resumeID'] = 'R' . $last4Digits;
            } else {
                $data['resumeID'] = 'R0001';
            }

            if(!empty($org)){
                $data['organizationID'] = $org->OrganizationID;    
            } else {
                $data['organizationID'] = $_POST['organizationID'];
            }
            $data['courseID'] = $_POST['courseID'];
            $data['address'] = $_POST['address'];
            $data['gender'] = $_POST['gender'];
            $data['dateOfBirth'] = $_POST['dateOfBirth'];
            $data['resume'] = NULL;

            // Validate the user input (you may want to add more validation)
            if (empty($data['studentID']) || empty($data['organizationID']) || empty($data['courseID'])) {
                echo "<script>alert('Please enter all required fields.');</script>";
            } else {
                // Run SQL
                $registerNewStudent = $this->studentModel->addStudent($data);
                $createResume = $this->resumeModel->addResume($data);
                if ($registerNewStudent&&$createResume) {
                    $this->userModel->addRole(2);
                    $_SESSION['role'] = 2;
                    $this->redirectToRole($_SESSION['role']);
                    exit();
                } else {
                    // Registration failed
                    echo "<script>alert('Something went wrong.');</script>";
                }
            }
        }
        $this->view('users/student_details', $data);
    }

    // In your controller
    public function get_courses_by_organization_id() {
        $organizationId = $this->getUrl()[2];
        $courses = $this->courseModel->getCourseByOrganizationId($organizationId);
        echo json_encode($courses);
    }
    
    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
        }
    }
    //forgot password
    //index
    public function index() {
        $this->view('index');
    }
}
?>