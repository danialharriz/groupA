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
        <a href="<?php echo URLROOT; ?>/staffs/index">Home</a>
        <a href="<?php echo URLROOT; ?>/staffs/profile">Profile</a>
        <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    </nav>
</body>
</html>
