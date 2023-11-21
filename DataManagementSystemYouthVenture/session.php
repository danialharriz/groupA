<?php
// Start or resume a session
session_start();

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to redirect to the login page if not logged in
function redirectToLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php"); // Change 'login.php' to your actual login page
        exit();
    }
}

// Function to set user data in the session
function setUserData($user_id, $username, $role) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
}

// Function to get user data from the session
function getUserData() {
    return [
        'user_id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'role' => $_SESSION['role'] ?? null,
    ];
}

// Function to destroy the session and log out the user
function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php"); // Change 'login.php' to your actual login page
    exit();
}
?>
