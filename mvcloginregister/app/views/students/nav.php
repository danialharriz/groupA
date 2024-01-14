<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            top: 0;
            position: sticky;
        }

        nav {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            transition: background-color 0.3s ease-in-out;
        }

        nav a:hover {
            background-color: B9BABA;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            color: white;
        }

        /* Center the navbar items */
        .navbar-nav {
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
        }
    </style>

</head>

<body>
    <header>
    <nav>
        <a href="<?php echo URLROOT; ?>/students/index"><i class="bi bi-house"></i>  Home</a>
        <!-- View upcoming events -->
        <a href="<?php echo URLROOT; ?>/students/viewUpcomingEvents">Upcoming Events</a>
        <!-- Event participated -->
        <a href="<?php echo URLROOT; ?>/students/event_participated.php">Event Participated</a>
        <a href="<?php echo URLROOT; ?>/students/viewOutsideEvents">Unique Events</a>
        <!-- Reward -->
        <a href="<?php echo URLROOT; ?>/students/reward">Reward</a>
        <!-- Resume -->
        <a href="<?php echo URLROOT; ?>/students/resume">Resume</a>
        <!-- Profile -->
        <a href="<?php echo URLROOT; ?>/students/profile">Profile</a>
        <a href="<?php echo URLROOT; ?>/users/logout"><i class="bi bi-arrow-right-square-fill"></i>  Logout</a>
    </nav>
    </header>
</body>

</html>
