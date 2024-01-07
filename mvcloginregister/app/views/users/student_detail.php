<?php
/*
    public function student_details()
    {
        //if user already have role, redirect to index
        if ($_SESSION['role'] == 3) {
            header('location:' . URLROOT . '/admins');
        } else if ($_SESSION['role'] == 1) {
            header('location:' . URLROOT . '/staffs');
        } else if ($_SESSION['role'] == 2) {
            header('location:' . URLROOT . '/students');
        }

        $institution = $this->organizationModel->getAllInstitute();
        $course = $this->courseModel->getAllCourse();

        if(empty($institution) || empty($course)){
            echo "<script>alert('Please add institution and course first.');</script>";
        }
        $data = [
            'title' => 'Student Details',
            'userID' => $_SESSION['user_id'],
            'studentID' => '',
            'organizationID' => '',
            'courseID' => '',
            'address' => '',
            'gender' => '',
            'dateOfBirth' => '',
            'resumeID' => '',
            'resume' => '',
            'institution' => $institution,
            'course' => $course,
        ];

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
            if ($resumeID) {
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

            $data['organizationID'] = $_POST['organizationID'];
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
                if ($registerNewStudent) {
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
*/
?>

<html>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/student_details.css">
</head>
<body>
    <h1>Student Details</h1>
    <form action="<?php echo URLROOT; ?>/users/student_details" method="POST">
        <?php if (empty($data['organizationID'])): ?>
            <label for="organizationID">Institute:</label>
            <select name="organizationID" id="organizationID" required>
                <?php foreach($data['institution'] as $institution): ?>
                    <option value="<?php echo $institution->OrganizationID; ?>"><?php echo $institution->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>

        <?php if (!empty($data['organizationID'])): ?>
            <label for="organizationID">Institute:</label>        <label for="courseID">Course:</label>
            <select name="c`ourseID" id="courseID" required>
                <?php foreach($data['course'] as $course): ?>
                    <option value="<?php echo $course->CourseID; ?>"><?php echo $course->CourseName; ?></option>
                <?php endforeach; ?>
            </select>`
        <?php endif; ?>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>

        <label for="dateOfBirth">Date of Birth:</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>