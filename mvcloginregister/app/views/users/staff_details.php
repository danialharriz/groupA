<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    /*controller
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
    */
    ?>
    <h1><?php echo $data['title']; ?></h1>
    <form method="POST" action="<?php echo URLROOT; ?>/users/staff_details">
        <?php if (empty($data['organizationId'])) : ?>
            <label for="organizationId">Organization:</label>
            <select name="organizationId">
                <?php foreach ($data['organizations'] as $organization) : ?>
                    <option value="<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <br>
        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" id="jobTitle" value="<?php echo $data['jobTitle']; ?>">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
