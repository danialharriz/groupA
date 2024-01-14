<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/org.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .organization {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #FCBD32;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .info {
            margin-top: 20px;
        }

        h3 {
            margin: 10px 0;
            color: #333;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        /* Style for icons */
        i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="organization">
            <h1><?php echo $data['organization']->OrganizationName; ?></h1>
            <hr>
            <div class="info">
                <h3>Address: <?php echo $data['organization']->Address; ?></h3>
                <h3>City: <?php echo $data['organization']->City; ?></h3>
                <h3>State: <?php echo $data['organization']->State; ?></h3>
                <h3>Website: <?php echo $data['organization']->Website; ?></h3>
                <h3>Type: <?php echo ($data['organization']->Type == 1) ? "Institute" : "Company"; ?></h3>
                <h3>Contact Email: <?php echo $data['organization']->ContactEmail; ?></h3>
                <h3>Contact Phone: <?php echo $data['organization']->ContactPhone; ?></h3>
            </div>
            <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
    </div>
    <script>
        function goBack() {
            history.back();
        }
    </script>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
