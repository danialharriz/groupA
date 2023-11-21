<?php
// You may want to include session.php and other necessary files here
require_once('session.php');
require_once('db_conn.php');

// Fetch the list of available institutes from the database
// Modify the query based on your actual database structure
$sqlInstitute = "SELECT * FROM Institute";
$resultInstitute = $conn->query($sqlInstitute);

// Fetch the list of available courses from the database
// Modify the query based on your actual database structure
$sqlCourse = "SELECT * FROM Course";
$resultCourse = $conn->query($sqlCourse);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .details-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <h2>Student Details</h2>
        <form action="student_details_process.php" method="post">
            <label for="matric_number">Matric Number:</label>
            <input type="text" id="matric_number" name="matric_number" required>

            <label for="institute">Choose Institute:</label>
            <select id="institute" name="institute" required>
                <?php
                while ($rowInstitute = $resultInstitute->fetch_assoc()) {
                    echo "<option value='{$rowInstitute['InstituteID']}'>{$rowInstitute['Name']}</option>";
                }
                ?>
            </select>

            <label for="course">Choose Course:</label>
            <select id="course" name="course" required>
                <?php
                while ($rowCourse = $resultCourse->fetch_assoc()) {
                    echo "<option value='{$rowCourse['CourseID']}'>{$rowCourse['Name']}</option>";
                }
                ?>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
