<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1><?php echo $data['title']; ?></h1>
    <form method="POST" action="<?php echo URLROOT; ?>/users/staff_details">
        <?php if (empty($data['organizationId'])) : ?>
            <label for="organizationId">Organization:</label>
            <select name="organizationId">
                <?php foreach ($data['organizations'] as $organization) : ?>
                    <option value="<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <br>
        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" id="jobTitle" value="<?php echo $data['jobTitle']; ?>">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
