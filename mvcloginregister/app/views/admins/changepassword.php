<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }

        .container8 {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff; /* White background */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #183D64; /* Dark blue color */
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        hr {
            border: 1px solid #ccc;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #7C1C2B; /* Dark red color */
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #FCBD32; /* Yellow color */
            color: #ffffff; /* White text */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #FFD55E; /* Lighter shade on hover */
        }

        button:active {
            background-color: #F9A825; /* Darker shade on active */
        }

        button:focus {
            outline: none;
            box-shadow: none;
        }

        span {
            color: red;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #183D64; /* Dark blue color */
            color: #ffffff; /* White text */
            text-decoration: none;
            border-radius: 4px;
        }

        .back-button:hover {
            background-color: #001F3F; /* Darker shade on hover */
        }

        .icon {
            font-size: 20px;
            margin-right: 5px;
        }

        @media screen and (max-width: 768px) {
            .container8 {
                width: 95%;
            }
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container8">
        <h1>Change Password</h1>
        <hr>

        <form action="<?php echo URLROOT; ?>/admins/changepassword" method="post">
            <label for="current_password"><b><i class="fas fa-lock icon"></i>Current Password</b></label>
            <input type="password" placeholder="Enter Current Password" name="current_password">
            <span style="color:red;"><?php echo $data['current_passwordError']; ?></span>

            <label for="new_password"><b><i class="fas fa-key icon"></i>New Password</b></label>
            <input type="password" placeholder="Enter New Password" name="new_password">
            <span style="color:red;"><?php echo $data['new_passwordError']; ?></span>

            <label for="confirm_new_password"><b><i class="fas fa-key icon"></i>Confirm New Password</b></label>
            <input type="password" placeholder="Confirm New Password" name="confirm_new_password">
            <span style="color:red;"><?php echo $data['confirm_new_passwordError']; ?></span>

            <button type="submit"><i class="fas fa-key icon"></i>Change Password</button>
        </form>

        <!--back button-->
        <div class="button-container">
            <a href="<?php echo URLROOT; ?>/admins/profile" class="back-button"><i class="fas fa-arrow-left icon"></i>Back</a>
        </div>

        <!-- Include your additional HTML and scripts here -->
    </div>

    <!-- Include Bootstrap JS and Font Awesome JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-code.js" crossorigin="anonymous"></script>
</body>
</html>
