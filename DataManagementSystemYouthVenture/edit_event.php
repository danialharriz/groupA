<?php
// Include your database connection code or any necessary files
require_once('db_conn.php');
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            width: 50%;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>
    <h2>Edit Event</h2>

    <form action="edit_event_process.php" method="post">
        <input type="hidden" name="eventID" value="<?php echo $eventID; ?>">

        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" value="<?php echo $row['EventName']; ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo $row['Description']; ?></textarea>

        <label for="startDateAndTime">Start Date and Time:</label>
        <input type="datetime-local" id="startDateAndTime" name="startDateAndTime" value="<?php echo date('Y-m-d\TH:i', strtotime($row['StartDateAndTime'])); ?>" required>

        <label for="endDateAndTime">End Date and Time:</label>
        <input type="datetime-local" id="endDateAndTime" name="endDateAndTime" value="<?php echo date('Y-m-d\TH:i', strtotime($row['EndDateAndTime'])); ?>" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $row['Location']; ?>" required>

        <label for="eventType">Event Type:</label>
        <!-- Add a dropdown list for event type use word to replace the numberic in the option-->
        <!-- /* 0 for workshop, 1 for competition, 2 for seminar, 3 for talk */ -->
        <select id="eventType" name="eventType" required>
            <option value="0" <?php if ($row['EventType'] == 0) echo 'selected'; ?>>Workshop</option>
            <option value="1" <?php if ($row['EventType'] == 1) echo 'selected'; ?>>Competition</option>
            <option value="2" <?php if ($row['EventType'] == 2) echo 'selected'; ?>>Seminar</option>
            <option value="3" <?php if ($row['EventType'] == 3) echo 'selected'; ?>>Talk</option>
        </select>
        <button type="submit">Save Changes</button>
    </form>
</body>

</html>
