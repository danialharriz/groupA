<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #FCBD32;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #183D64;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #183D64;
        }

        select,
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #7C1C2B;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body>
    <form method="POST" action="<?php echo URLROOT; ?>/users/staff_details">
        <div class="logo-container">
            <img src="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" alt="Logo">
        </div>
        <h1><?php echo $data['title']; ?></h1>
        <?php if (empty($data['organizationId'])) : ?>
            <label for="organizationId">Select Organization:</label>
            <select name="organizationId" id="organizationId" required>
                <?php foreach ($data['organizations'] as $organization) : ?>
                    <option value="<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" id="jobTitle" value="<?php echo $data['jobTitle']; ?>" required>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
