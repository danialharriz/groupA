<?php
// Include your database connection code or any necessary files
require_once('db_conn.php');
require_once('session.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $startDateAndTime = $_POST['start_date_and_time'];
    $endDateAndTime = $_POST['end_date_and_time'];
    $location = $_POST['location'];
    $eventType = $_POST['event_type'];
    $rewardPoints = $_POST['reward_points'];
    
    // Assuming you have a session or some way to identify the current user and organization
    // Adjust this part based on your authentication mechanism
    $userID = $_SESSION['user_id']; // Replace with your actual session variable
    $role = $_SESSION['role']; // Replace with your actual session variable
    if ($role == 3) {
        $sql = "SELECT OrganizationID FROM Company WHERE CompanyID = (SELECT CompanyID FROM CompanyStaff WHERE UserID = '$userID')";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $organizationID = $row['OrganizationID'];
    } 
    else if($role == 2) {
        $sql = "SELECT OrganizationID FROM OrganizationStaff WHERE UserID = '$userID'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $organizationID = $row['OrganizationID'];
    }
    else {
        echo "<script>alert('You are not authorized to register an event.');</script>";
    }
    // Perform database insertion (adjust this part based on your database structure)
    $sql = "INSERT INTO Event (Name, Description, StartDateAndTime, EndDateAndTime, Location, Organizer, EventType, RewardPoints, OrganizationID, UserID)
            VALUES ('$name', '$description', '$startDateAndTime', '$endDateAndTime', '$location', '$organizer', '$eventType', '$rewardPoints', '$organizationID', '$userID')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Event registered successfully.');</script>";
        header("Location: view_upcoming_event.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>