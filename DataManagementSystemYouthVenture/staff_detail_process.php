<?php
// You may want to include session.php and other necessary files here
require_once('session.php');
require_once('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staffID = $_POST['staff_id'];
    $instituteID = $_POST['institute'];
    $position = $_POST['position'];

    // Insert data into the Staff table
    $sqlInsert = "INSERT INTO Staff (UserID, OrganizationID, Position) VALUES ('$staffID', '$instituteID', '$position')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "Staff details added successfully!";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}

$conn->close();
?>