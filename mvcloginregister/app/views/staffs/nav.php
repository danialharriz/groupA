<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
    body {
        font-family: Arial, sans-serif;
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
        padding: 10px 20px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    nav a {
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        display: inline-block;
        transition: background-color 0.3s ease-in-out;
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
    <header>
    <nav>
        <a href="<?php echo URLROOT; ?>/staffs/index"><i class="bi bi-house"></i> Home </a>
        <a href="<?php echo URLROOT; ?>/staffs/all_events"><i class="bi bi-calendar3"></i>  Events</a>
        <a href="<?php echo URLROOT; ?>/staffs/profile"><i class="bi bi-person"></i>  Profile</a>
        <a href="<?php echo URLROOT; ?>/users/logout"><i class="bi bi-arrow-right-square-fill"></i>  Logout</a>
    </nav>
    </header>
</body>

</html>