<?php
// Include your database connection code or any necessary files
require_once('db_conn.php');
require_once('session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Event</title>
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

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
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
    <div class="form-container">
        <h2>Register New Event</h2>
        <form action="register_new_event_process.php" method="post">
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="start_date_and_time">Start Date and Time:</label>
            <input type="datetime-local" id="start_date_and_time" name="start_date_and_time" required>

            <label for="end_date_and_time">End Date and Time:</label>
            <input type="datetime-local" id="end_date_and_time" name="end_date_and_time" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="event_type">Event Type:</label>
            <select id="event_type" name="event_type" required>
                <option value="0">Workshop</option>
                <option value="1">Competition</option>
                <option value="2">Seminar</option>
                <option value="3">Talk</option>
            </select>
            <label for="reward_points">Reward Points:</label>
            <input type="number" id="reward_points" name="reward_points" required>

            <button type="submit">Register Event</button>
        </form>
    </div>
</body>
</html>