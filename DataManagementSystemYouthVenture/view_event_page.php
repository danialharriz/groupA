<?php
include 'db_conn.php';
include 'session.php';


// Get the event ID from the URL
$eventID = isset($_GET['eventID']) ? $_GET['eventID'] : die("Event ID not provided.");

// Fetch event information
$sql = "SELECT E.Name AS EventName, E.Description, E.StartDateAndTime, E.EndDateAndTime, E.Location, E.EventType, E.RewardPoints, O.Name AS OrganizerName
        FROM Event E
        LEFT JOIN Organization O ON E.OrganizationID = O.OrganizationID
        WHERE E.EventID = '$eventID'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Event not found.");
}
$sql1 = "SELECT * FROM Users WHERE UserID = '$row['UserID']'";
$result1 = $conn->query($sql);
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
}
else{
    die("Some error occured. The person who created this event is not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .description {
            margin-top: 20px;
            white-space: pre-line;
        }
    </style>
</head>

<body>

    <h2><?= $row['EventName'] ?></h2>

    <table>
        <tr>
            <th>Description</th>
            <td class="description"><?= $row['Description'] ?></td>
        </tr>
        <tr>
            <th>Start Date and Time</th>
            <td><?= $row['StartDateAndTime'] ?></td>
        </tr>
        <tr>
            <th>End Date and Time</th>
            <td><?= $row['EndDateAndTime'] ?></td>
        </tr>
        <tr>
            <th>Location</th>
            <td><?= $row['Location'] ?></td>
        </tr>
        <tr>
            <th>Event Type</th>
            <td><?= $row['EventType'] ?></td>
        </tr>
        <tr>
            <th>Organizer</th>
            <td><?= $row['OrganizerName'] ?></td>
        </tr>
        <tr>
            <th>Person in Charge</th>
            <td><?= $row1['Name'] ?></td>
        </tr>
        <tr>
            <th>Contact</th>
            <td><?= $row1['Email'] ?></td>
        </tr>
        <?php
            // Assume $loggedInUserID is the ID of the currently logged-in user, and $row1['Role'] is the role of the person in charge
            $loggedInUserID = $_SESSION['userID'];

            // Check if the logged-in user is a student or public
            if ($row1['Role'] == '1' || $row1['Role'] == '3') {
                // Display "Join Event" button
                echo '<form action="join_event_process.php" method="post" class="join-button">';
                echo '<input type="hidden" name="eventID" value="' . $eventID . '">';
                echo '<button type="submit">Join Event</button>';
                echo '</form>';
            }

            // Check if the logged-in user is the person in charge (creator) of the event
            if ($loggedInUserID == $row1['UserID']) {
                // Display "Edit Event" button
                echo '<form action="edit_event.php" method="get" class="edit-button">';
                echo '<input type="hidden" name="eventID" value="' . $eventID . '">';
                echo '<button type="submit">Edit Event</button>';
                echo '</form>';

                // Display "Delete Event" button
                echo '<form action="delete_event_process.php" method="post" class="delete-button">';
                echo '<input type="hidden" name="eventID" value="' . $eventID . '">';
                echo '<button type="submit">Delete Event</button>';
                echo '</form>';
            }
        ?>
    </table>
    <!-- Add any additional HTML or scripts as needed -->

</body>

</html>
