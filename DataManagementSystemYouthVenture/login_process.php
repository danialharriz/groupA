<?php
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
                session_start();
                // Set user data in the session
                $_SESSION['user_id'] = $row['UserID'];  // Replace 'user_id' with your actual session variable name
                $_SESSION['role'] = $row['Role'];  // Replace 'role' with your actual session variable name

                // Check if the user is logging in for the first time (role is empty)
                if (empty($row['Role'])) {
                    // Redirect to the role selection page for first-time login
                    header("Location: select_role.php"); // Change 'select_role.php' to your actual role selection page
                    exit();
                } 
                else {
                    if(($row['Role']) == 0){
                        header("Location: admin.php");
                        exit();
                    }
                    else if(($row['Role']) == 1){
                        header("Location: student.php");
                        exit();
                    }
                    else if(($row['Role']) == 2){
                        header("Location: lecturer.php");
                        exit();
                    }
                    else if(($row['Role']) == 3){
                        header("Location: staff.php");
                        exit();
                    }
                    else if(($row['Role']) == 4){
                        header("Location: public_user.php");
                        exit();
                    }
                    else{
                        header("Location: select_role.php"); // Change 'select_role.php' to your actual role selection page
                        exit();
                    }
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
