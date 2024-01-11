<?php require APPROOT . '/views/students/nav.php'; ?>
<html>
<style>
    /* org.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
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
    color: #007bff;
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

</style>
<head>
    <title>Organization</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/org.css">
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
                <h3>Type: <?php if ($data['organization']->Type == 1) {
                        echo "Institute";
                    } else {
                        echo "Company";
                    } ?></h3>
                <h3>Contact Email: <?php echo $data['organization']->ContactEmail; ?></h3>
                <h3>Contact Phone: <?php echo $data['organization']->ContactPhone; ?></h3>
            </div>
        </div>
    </div>
</body>
</html> 