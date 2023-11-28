<?php
include 'db_conn.php';
include 'session.php';

// Get the user ID from the session
$userID = $_SESSION['UserID'];

// Fetch student information
$sql = "SELECT U.Name, U.Nickname, U.Email, S.MatricNo, I.Name AS InstituteName, C.Name AS CourseName, S.Resume
        FROM Users U
        JOIN Student S ON U.UserID = S.UserID
        JOIN Institute I ON S.InstituteID = I.InstituteID
        JOIN Course C ON S.CourseID = C.CourseID
        WHERE U.UserID = '$userID'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .resume {
            margin-top: 20px;
            white-space: pre-line;
        }
    </style>
</head>

<body>

    <h2>Student Profile</h2>

    <table>
        <tr>
            <th>Name</th>
            <td><?= $row['Name'] ?></td>
        </tr>
        <tr>
            <th>Nickname</th>
            <td><?= $row['Nickname'] ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $row['Email'] ?></td>
        </tr>
        <tr>
            <th>Matric No</th>
            <td><?= $row['MatricNo'] ?></td>
        </tr>
        <tr>
            <th>Institute</th>
            <td><?= $row['InstituteName'] ?></td>
        </tr>
        <tr>
            <th>Course</th>
            <td><?= $row['CourseName'] ?></td>
        </tr>
    </table>

    <div class="resume">
        <h3>Resume</h3>
        <?= $row['Resume'] ?>
    </div>

    <!-- Add any additional HTML or scripts as needed -->

</body>

</html>
