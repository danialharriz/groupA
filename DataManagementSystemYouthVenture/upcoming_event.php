<?php
// Include your database connection code or any necessary files
require_once('db_conn.php');

// Fetch upcoming events from the database
$currentDate = date('Y-m-d H:i:s'); // Get the current date and time
$sql = "SELECT * FROM Event WHERE StartDateAndTime > '$currentDate' ORDER BY StartDateAndTime ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .events-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
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

        .button-cell {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="events-container">
        <h2>Upcoming Events</h2>

        <?php
        if ($result->num_rows > 0) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Start Date and Time</th>
                        <th>End Date and Time</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['StartDateAndTime']; ?></td>
                            <td><?php echo $row['EndDateAndTime']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><?php echo $row['Location']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<p>No upcoming events found.</p>";
        }
        ?>
    </div>
</body>
</html>
