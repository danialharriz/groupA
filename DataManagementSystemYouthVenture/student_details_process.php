<?php
// You may want to include session.php and other necessary files here
// require_once('session.php');
// require_once('db_conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered matriculation number, selected institute, and course
    $matricNumber = $_POST['matric_number'] ?? '';
    $instituteID = $_POST['institute'] ?? '';
    $courseID = $_POST['course'] ?? '';

    // Get the user ID from the session (assuming you store it in the session)
    $userID = $_SESSION['user_id'] ?? '';

    // Validate the user ID, matriculation number, institute ID, and course ID (you may want to add more validation)
    if (!empty($userID) && !empty($matricNumber) && !empty($instituteID) && !empty($courseID)) {
        // Update the user's role to 1 (assuming 1 is the role for students)
        $updateUserRoleSQL = "UPDATE Users SET Role = 1 WHERE UserID = $userID";
        $conn->query($updateUserRoleSQL);

        // Insert the student details into the student table
        $insertStudentDetailsSQL = "INSERT INTO Student (UserID, MatricNumber, InstituteID, CourseID) VALUES ($userID, '$matricNumber', $instituteID, $courseID)";
        $conn->query($insertStudentDetailsSQL);

        // Redirect to the student dashboard or home page
        header("Location: student_dashboard.php"); // Change 'student_dashboard.php' to your actual student dashboard page
        exit();
    } else {
        // Handle validation errors
        echo "Invalid data submitted.";
    }
}
?>