<?php
include 'db_conn.php';
include 'session.php';

redirectToLogin();

// Include your database connection code here

$userID = $_SESSION['UserID'];

// Fetch events that the user has participated in
$sql = "SELECT E.EventID, E.Name AS EventName, E.StartDateAndTime, E.EndDateAndTime, O.Name AS OrganizationName
        FROM Event E
        JOIN Participants P ON E.EventID = P.EventID
        JOIN Organization O ON E.OrganizationID = O.OrganizationID
        WHERE P.UserID = '$userID'";

// Execute the query and fetch results

// Include your database connection code here (e.g., $conn is the connection variable)
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Participated Events</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
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

        .status-ongoing {
            color: green;
            font-weight: bold;
        }

        .status-past {
            color: #bf0e08;
            font-weight: bold;
        }

        .status-upcoming {
            color: #0056b3;
            font-weight: bold;
        }

        .action-link {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .no-events-message {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>

    <h2>Events Participated</h2>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Organizer</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <?php
                $status = "";
                $currentDateTime = date('Y-m-d H:i:s');
                if ($row['StartDateAndTime'] > $currentDateTime) {
                    $status = "Upcoming";
                    $statusClass = "status-upcoming";
                } elseif ($row['EndDateAndTime'] < $currentDateTime) {
                    $status = "Past";
                    $statusClass = "status-past";
                } else {
                    $status = "Ongoing";
                    $statusClass = "status-ongoing";
                }
                ?>
                <tr>
                    <td><?= $row['EventName'] ?></td>
                    <td><?= $row['StartDateAndTime'] ?></td>
                    <td><?= $row['EndDateAndTime'] ?></td>
                    <td><?= $row['OrganizationName'] ?></td>
                    <td class="<?= $statusClass ?>"><?= $status ?></td>
                    <td><a href='view_event.php?eventID=<?= $row['EventID'] ?>' class="action-link">View</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p class="no-events-message">No events participated.</p>
    <?php endif; ?>

    <!-- Add any additional HTML or scripts as needed -->

</body>

</html>
