<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: black;
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
        <a href="<?php echo URLROOT; ?>/admins/index">Home</a>
        <!--organization-->
        <a href="<?php echo URLROOT; ?>/admins/organization">Organization</a>
        <!--course-->
        <a href="<?php echo URLROOT; ?>/admins/course">Course</a>
        <!--pending_approval_staff-->
        <a href="<?php echo URLROOT; ?>/admins/pending_approval_staff">Pending Approval Staff</a>
        <!--all_events-->
        <a href="<?php echo URLROOT; ?>/admins/all_events">All Events</a>
        <!--outside_events-->
        <a href="<?php echo URLROOT; ?>/admins/viewOutsideEvents">Outside Events</a>
        <!--reward-->
        <a href="<?php echo URLROOT; ?>/admins/reward">Reward</a>
        <!--profile-->
        <a href="<?php echo URLROOT; ?>/admins/profile">Profile</a>
        <!--logout-->
        <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    </nav>
</body>
</html>
