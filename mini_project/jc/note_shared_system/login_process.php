<?php
session_start();
include 'db_conn.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the hashed password from the database
    $sql = "SELECT password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $stored_password = $row['password'];

        // Verify the entered password with the hashed password
        if (password_verify($password, $stored_password)) {
            // Retrieve user information
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['type'] = $row['type'];
                $type = $row['type'];

                // Redirect based on user type
                if ($type == 0) {
                    echo "<script>alert('Login successful.');</script>";
                    echo "<script>window.location.replace('admin_page.php');</script>";
                } else {
                    echo "<script>alert('Login successful.');</script>";
                    echo "<script>window.location.replace('main_page.php');</script>";
                }
            } else {
                echo "<script>alert('Error retrieving user information.');</script>";
                echo "<script>window.location.replace('login.php');</script>";
            }
        } else {
            echo "<script>alert('Wrong password. Please try again.');</script>";
            echo "<script>window.location.replace('login.php');</script>";
        }
    } else {
        echo "<script>alert('Email not registered. Please try again.');</script>";
        echo "<script>window.location.replace('login.php');</script>";
    }
}

mysqli_close($conn);
?>
