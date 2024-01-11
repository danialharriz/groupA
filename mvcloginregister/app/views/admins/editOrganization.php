<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
<style>
    /* editOrganization.css */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        width: 60%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        width: 80%;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Optional: Add some styling for better readability */
    select {
        padding: 8px;
    }
</style>
<head>
    <title>Edit Organization</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/editOrganization.css">
</head>
<body>
    <div class="container">
        <h1>Edit Organization</h1>
        <form action="<?php echo URLROOT; ?>/admins/editOrganization/<?php echo $data['organization']->OrganizationID; ?>" method="POST">
            <label for="organizationName">Organization Name</label>
            <input type="text" name="organizationName" value="<?php echo $data['organization']->OrganizationName; ?>">
            <label for="address">Address</label>
            <input type="text" name="address" value="<?php echo $data['organization']->Address; ?>">
            <label for="city">City</label>
            <input type="text" name="city" value="<?php echo $data['organization']->City; ?>">
            <label for="state">State</label>
            <input type="text" name="state" value="<?php echo $data['organization']->State; ?>">
            <label for="website">Website</label>
            <input type="text" name="website" value="<?php echo $data['organization']->Website; ?>">
            <label for="type">Type</label>
            <select name="type">
                <option value="1" <?php if ($data['organization']->Type == 1) {
                    echo "selected";
                } ?>>Institute</option>
                <option value="2" <?php if ($data['organization']->Type == 2) {
                    echo "selected";
                } ?>>Company</option>
            </select>
            <label for="contactEmail">Contact Email</label>
            <input type="text" name="contactEmail" value="<?php echo $data['organization']->ContactEmail; ?>">
            <label for="contactPhone">Contact Phone</label>
            <input type="text" name="contactPhone" value="<?php echo $data['organization']->ContactPhone; ?>">
            <label for="emailending">Email Ending</label>
            <input type="text" name="emailending" value="<?php echo $data['organization']->emailending; ?>">
            <br>
            <br>
            <input type="submit" value="Update Organization">
        </form>
    </div>
</body>
</html>
