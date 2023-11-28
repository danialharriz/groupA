<?php
require_once('session.php');
require_once('db_conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user input
    $name = $_POST['name'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate the user input (you may want to add more validation)
    if (empty($name) || empty($nickname) || empty($email) || empty($password)) {
        // Handle validation errors
        echo "Please enter all required fields.";
    } else {
        // Hash the password (you should use a stronger hashing algorithm in a production environment)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert a new user
        $sql = "INSERT INTO Users (Name, Nickname, Email, Password) VALUES ('$name', '$nickname', '$email', '$hashedPassword')";

        if ($conn->query($sql) === true) {
            // Registration successful
            echo "<script>alert('Registration successful.');</script>";
            //auto login
            $sql = "SELECT * FROM Users WHERE Email = '$email'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            setUserData($row['UserID'], $row['Name'], $row['Role']);
            header("Location: select_role.php"); // Change 'dashboard.php' to your actual dashboard or home page
        } else {
            // Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>