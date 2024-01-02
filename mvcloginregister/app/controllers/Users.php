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
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Staff Details',
                'organizations' => $this->organizationModel->getAllCompany(),
                'jobTitle' => $_POST['jobTitle'],
                'type' => '',
                'staffId' => '',
                'organizationId' => $_POST['organizationId'],
            ];
            // Validate the user input (you may want to add more validation)
            if (empty($data['jobTitle'])) {
                echo "<script>alert('Please enter all required fields.');</script>";
            //verify the user email if are member of organization
            } else if (!$this->organizationModel->verifyOrganizationEmail($data['organizationId'], $_SESSION['email'])) {
                echo "<script>alert('Please use your organization email.');</script>";
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
    //forgot password
    //index
    public function index() {
        $this->view('index');
    }
}
?>