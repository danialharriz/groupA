<?php

class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('Users');
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
        
            // Validate the user input (you may want to add more validation)
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                // Handle validation errors
                $data['credentialsError'] = 'Please enter all required fields.';
            } else {
                // Hash the password (you should use a stronger hashing algorithm in a production environment)
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
                //Run SQL
                $registerNewUser = $this->userModel->signup($data);
                if ($registerNewUser) {
                    $registerDone = "Registration successful!";

                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    $_SESSION['user_id'] = $loggedInUser->userid;
                    $_SESSION['name'] = $loggedInUser->name;
                    $_SESSION['email'] = $loggedInUser->email;
                    $_SESSION['role'] = $loggedInUser->role;

                    header('location: ' . URLROOT . '/users/select_role');
                } else {
                    // Registration failed
                    die('Something went wrong.');
                }

            }
        }
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

            // Validate the user input (you may want to add more validation)
            if (empty($email) || empty($password)) {
                // Handle validation errors
                echo "Please enter both email and password.";
                $data['credentialsError'] = 'Please enter both email and password.';
            }

            if (empty($data['credentialsError'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //NEED CHANGE
                    $_SESSION['user_id'] = $loggedInUser->userid;
                    $_SESSION['name'] = $loggedInUser->name;
                    $_SESSION['email'] = $loggedInUser->email;
                    $_SESSION['role'] = $loggedInUser->role;
                    // $_SESSION['profile_pic'] = $user->profilepic;

                    if (empty($_SESSION['role'])) {
                        // Redirect to the role selection page for first-time login
                        header("Location: select_role.php"); // Change 'select_role.php' to your actual role selection page
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
                            header('location:' . URLROOT . '/users/select_roles.php'); // Change 'select_role.php' to your actual role selection page
                            exit();
                        }
                    }

                } else {
                    $data['credentialsError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('user/login', $data);
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

    public function selectRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $allowedRoles = ['student', 'staff'];
            if (in_array($_POST['selected_role'], $allowedRoles)) {
                // Redirect to the specific page for the selected role
                header('location:' . URLROOT . '/users/' . $_POST['_details.php'] . 'select_roles.php'); // Change 'select_role.php' to your actual role selection page
                exit();
            } else {
                // Handle validation errors
                echo "Invalid role selected.";
            }
        }
    }
    
    public function staff_details() {
        $data = [
            'organizational_id' => '',
            'type' => '',
            'job_title' => '',
            'key' => '',
            'error' => '',
        ];
        $organization_id = $this->organizationModel->getAllId();
        $data = 
        [
            'organization_id' => $organization_id
        ];
        $this->view('users/staff_details', $organization_id, $data);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'organizational_id' => $_POST['organization_id'],
                'type' => $_POST['type'],
                'job_title' => $_POST['job_title'],
                'key' => $_POST['key'],
                'error' => '',
            ];
            
            $admin_key = 'admin12345';
            $staff_key = 'staff12345';

            if ($data['key'] == $admin_key) {
                $user_role = $this->userModel->addRole('0');

                if ($user_role){
                    $data['type'] = 'admin';
                    $staff_details = $this->staffModel->addStaff($data);

                    if($staff_details) {
                        $data['error'] = 'Staff Details and ROle Updated but i didnt make admin dashboard, it supposedly go admin dashboard page.';
                        $this->view('users/staff_details', $organization_id, $data);
                    } else {
                        $data['error'] = 'Staff Details Updates Failed!';
                        $this->view('users/staff_details', $organization_id, $data);
                    }

                } else {
                    $data['error'] = 'Role Updates Failed!';
                    $this->view('users/staff_details', $organization_id, $data);
                }

            } else if ($data['key'] == $staff_key) {
                $user_role = $this->userModel->addRole('2');
            } else {
                $data['error'] = 'Wrong Key!';
                $this->view('users/staff_details', $organization_id, $data);
            }
        }
    }
}

?>
