<?php

class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->organizationModel = $this->model('Organization');
        $this->staffModel = $this->model('Staff');
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
                //Run SQL
                $registerNewUser = $this->userModel->signup($data);
                if ($registerNewUser) {
                    echo "<script>alert('Registration successful!');</script>";
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    $this->createUserSession($loggedInUser);
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
            // NEED CHANGE
            if(($_SESSION['role']) == 0){
                header('location:' . URLROOT . '/pages/admin');
                exit();
            }
            else if(($_SESSION['role']) == 1){
                header('location:' . URLROOT . '/pages/student');
                exit();
            }
            else if(($_SESSION['role']) == 2){
                header('location:' . URLROOT . '/pages/staff');
                exit();
            }
            else{
                header('location:' . URLROOT . '/users/selectRole'); // Change 'selectRole.php' to your actual role selection page
                //set currentMethod to selectRole

                exit();
            }
        }
    }

    public function selectRole() {
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
    public function staff_details(){
        /*
        CREATE TABLE `staff` (
            `StaffID` varchar(6) NOT NULL,
            `UserID` varchar(6) NOT NULL,
            `OrganizationID` varchar(6) NOT NULL,
            `Type` varchar(45) NOT NULL,
            `JobTitle` varchar(45) NOT NULL,
            PRIMARY KEY (`StaffID`),
            KEY `OrganizationID` (`OrganizationID`),
            KEY `UserID` (`UserID`),
            CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
            CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 
        */
        $data = [
            'title' => 'Staff Details',
            'staffId' => '',
            'userId' => '',
            'organizationId' => '',
            'type' => '',
            'jobTitle' => '',
            'staffId_err' => '',
            'userId_err' => '',
            'organizationId_err' => '',
            'type_err' => '',
            'jobTitle_err' => '',
            'organizations' => $this->organizationModel->getAllOrganizations(),
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the user input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Staff Details',
                'staffId' => $_POST['staffId'],
                'userId' => $_POST['userId'],
                'organizationId' => $_POST['organizationId'],
                'type' => $_POST['type'],
                'jobTitle' => $_POST['jobTitle'],
                'staffId_err' => '',
                'userId_err' => '',
                'organizationId_err' => '',
                'type_err' => '',
                'jobTitle_err' => '',
                //pass of organization
            ];
            //check if verify the organization pass
            $organizationVerify = $this->organizationModel->verufyOrganizationPass($data['organizationId'], $_POST['pass']);
            if (!$organizationVerify) {
                echo "<script>alert('The verification key is incorrect. Please try again.');</script>";
                $this->view('users/staff_details', $data);
                $data = [
                    'title' => 'Staff Details',
                    'staffId' => '',
                    'userId' => '',
                    'organizationId' => '',
                    'type' => '',
                    'jobTitle' => '',
                    'staffId_err' => '',
                    'userId_err' => '',
                    'organizationId_err' => '',
                    'type_err' => '',
                    'jobTitle_err' => '',
                    'organizations' => $this->organizationModel->getAllOrganizations(),
                ];
            } else {
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
                //Run SQL
                $registerNewStaff = $this->staffModel->addStaff($data);
                if ($registerNewStaff) {
                    //add role to user, if the organization id is O0001, set role to 0 else set role to 1
                    if ($data['organizationId'] == 'O0001') {
                        $this->userModel->addRole($data['userId'], 0);
                        echo "<script>alert('Registration successful!');</script>";
                        header('location:' . URLROOT . '/admins');
                    } else {
                        $this->userModel->addRole($data['userId'], 1);
                        echo "<script>alert('Registration successful!');</script>";
                        header('location:' . URLROOT . '/staffs');
                    }
                } else {
                    // Registration failed
                    die('Something went wrong.');
                }   
            }
        }
        $this->view('users/staff_details', $data);
    }
    public function index() {
        $data = [
            'title' => 'Home page'
        ];

        $this->view('index', $data);
    }
}
?>