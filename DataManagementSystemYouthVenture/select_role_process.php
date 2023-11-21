<?php
// You may want to include session.php and other necessary files here
// require_once('session.php');
// require_once('db_conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedRole = $_POST['selected_role'] ?? '';

    // Validate the selected role
    $allowedRoles = ['student', 'lecturer', 'staff', 'public_user'];
    if (in_array($selectedRole, $allowedRoles)) {
        // Redirect to the specific page for the selected role
        header("Location: " . $selectedRole . "_details.php"); // Adjust the file name based on your actual file naming convention
        exit();
    } else {
        // Handle validation errors
        echo "Invalid role selected.";
    }
}
?>
