<?php
require_once('session.php');
require_once('db_conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user input
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate the user input (you may want to add more validation)
    if (empty($email) || empty($password)) {
        // Handle validation errors
        echo "Please enter both email and password.";
    } 
    else {
        // Prepare and execute the SQL query
        $sql = "SELECT * FROM Users WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['Password'])) {
                // Password is correct

                // Set user data in the session
                setUserData($row['UserID'], $row['Name'], $row['Role']);

                // Check if the user is logging in for the first time (role is empty)
                if (empty($row['Role'])) {
                    // Redirect to the role selection page for first-time login
                    header("Location: select_role.php"); // Change 'select_role.php' to your actual role selection page
                    exit();
                } 
                else {
                    // Redirect to the dashboard or home page for regular login
                    header("Location: dashboard.php"); // Change 'dashboard.php' to your actual dashboard or home page
                    exit();
                }
            } 
            else {
                // Password is incorrect
                echo "<script>alert('Incorrect password.');</script>";
                echo "<script>window.location.href='login.php';</script>";
            }
        } 
        else {
            // User not found
            echo "<script>alert('User not found.');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    }
}
?>
