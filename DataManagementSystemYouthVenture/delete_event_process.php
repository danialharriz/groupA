<?php
// Include your database connection code or any necessary files
include 'db_conn.php';
include 'session.php';

// Check if the event ID is provided in the POST request
if (isset($_POST['eventID'])) {
    $eventID = $_POST['eventID'];

    // Fetch event information to ensure it exists
    $sql = "SELECT * FROM Event WHERE EventID = '$eventID'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Event exists, proceed with deletion
        $deleteEventSql = "DELETE FROM Event WHERE EventID = '$eventID'";
        $deleteEventResult = mysqli_query($conn, $deleteEventSql);

        if ($deleteEventResult) {
            // Event deleted successfully
            header("Location: events.php"); // Redirect to events page or any other page after deletion
            exit();
        } else {
            // Error deleting event
            echo "Error deleting event: " . mysqli_error($conn);
        }
    } else {
        // Event not found
        echo "Event not found.";
    }
} else {
    // Event ID not provided
    echo "Event ID not provided.";
}
?>
