<?php
ob_start();
$servername = "localhost";
$username = "niagaped_groupA_user";
$password = "GroupA*&&%@^#";
$dbname = "DataManagementSystemYouthVenture";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>