<?php
session_start();
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_SESSION['email'];

    // Check if the user exists
    $checkUserQuery = "SELECT password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkUserQuery);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Check if the current password matches the one in the database
        if (password_verify($currentPassword, $row['password'])) {
            if ($newPassword === $confirmPassword) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updatePasswordQuery = "UPDATE user SET password = ? WHERE email = ?";
                $stmt = mysqli_prepare($conn, $updatePasswordQuery);
                mysqli_stmt_bind_param($stmt, 'ss', $hashedPassword, $email);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Password updated successfully.');</script>";
                    echo "<script>window.location.replace('main_page.php');</script>";
                } else {
                    echo "<script>alert('Error updating password.');</script>";
                    echo "<script>window.location.replace('change_password.php');</script>";
                }
            } else {
                echo "<script>alert('New password and confirmation do not match. Please retype the same password.');</script>";
                echo "<script>window.location.replace('change_password.php');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
            echo "<script>window.location.replace('change_password.php');</script>";
        }
    } else {
        echo "<script>alert('User does not exist.');</script>";
        echo "<script>window.location.replace('change_password.php');</script>";
    }
}
?>