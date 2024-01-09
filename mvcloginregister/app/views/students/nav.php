<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #0e77ca;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }

        nav a:hover {
            background-color: #155d8b;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            color: #0e77ca;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?php echo URLROOT; ?>/students/index">Home</a>
        <!--view upcoming events-->
        <a href="<?php echo URLROOT; ?>/students/viewUpcomingEvents">Upcoming Events</a>
        <!--event participated-->
        <a href="<?php echo URLROOT; ?>/students/event_participated.php">Event Participated</a>
        <a href="<?php echo URLROOT; ?>/students/viewOutsideEvents">My Outside Event</a>
        <!--reward-->
        <a href="<?php echo URLROOT; ?>/students/reward">Reward</a>
        <!--resume-->
        <a href="<?php echo URLROOT; ?>/students/resume">Resume</a>
        <!--profile-->
        <a href="<?php echo URLROOT; ?>/students/profile">Profile</a>
        <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    </nav>
</body>
</html>
