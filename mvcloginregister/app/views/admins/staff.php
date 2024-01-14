<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Staff</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/staff.css">
    <style>
        /* Custom CSS styles */

        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .name-card {
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 700px;
        }

        .upload {
            width: 125px;
            position: relative;
            margin: auto;
            align-items: center;
        }

        .upload img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
            display: block;
        }

        h1 {
            text-align: center;
            color: #FCBD32;
            margin: 10px 0;
        }

        hr {
            border: 1px solid #7C1C2B;
            margin: 10px 0;
        }

        .info {
            padding: 20px;
        }

        h3 {
            margin: 10px 0;
            color: #333;
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0 0 8px 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .name-card {
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <!-- Name Card Style -->
    <div class="name-card">
        <div class="upload">
            <?php if ($data['staff']->User->profilePic != null) : ?>
                <img src="<?php echo URLROOT . "/public/" . $data['user']->profilePic; ?>" alt="profile picture" style="width: 30px; height: auto; border-radius: 8px 8px 0 0; display: block;">
            <?php else : ?>
                <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" alt="profile picture">
            <?php endif; ?>
        </div>
        <h1><?php echo $data['staff']->User->Name; ?></h1>
        <hr>
        <div class="info">
            <h3>Organization: <?php echo $data['staff']->Organization->OrganizationName; ?></h3>
            <h3>Job Title: <?php echo $data['staff']->JobTitle; ?></h3>
            <h3>Email: <?php echo $data['staff']->User->Email; ?></h3>
            <h3>Phone: <?php echo $data['staff']->User->Phone; ?></h3>
        </div>
        <button class="back-button" onclick="window.history.back()">Back</button>
    </div>
</body>

</html>

<?php require APPROOT . '/views/includes/footer.php'; ?>
