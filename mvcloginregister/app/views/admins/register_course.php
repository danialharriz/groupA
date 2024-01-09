<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
<style>
/* admins/register_course.css */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    select,
    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .invalidFeedback {
        color: #ff0000;
        margin-bottom: 10px;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
<head>
    <title>Register Course</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/register_course.css">
</head>
<body>
    <div class="container">
        <h1>Register Course</h1>
        <form action="<?php echo URLROOT; ?>/admins/register_course" method="POST">
            <label for="organizationId">Organization:</label>
            <select name="organizationId" id="organizationId" required>
                <option value="" selected disabled>Select an Organization</option>
                <?php foreach($data['organizations'] as $organization): ?>
                    <option value="<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalidFeedback"><?php echo $data['organization_id_err']; ?></span>

            <label for="courseName">Course Name:</label>
            <input type="text" name="courseName" id="courseName" value="<?php echo $data['courseName']; ?>" required>
            <span class="invalidFeedback"><?php echo $data['course_name_err']; ?></span>

            <button type="submit">Register Course</button>
        </form>
    </div>
</body>
</html>
