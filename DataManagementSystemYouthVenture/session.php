<?php
    // Start or resume a session
    session_start();
    include 'db_conn.php';

    if(isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        $mysql = "SELECT * FROM Users WHERE UserID = '$userID'";
        $result = $conn->query($mysql);
        $row = $result->fetch_assoc();

        $name = $row['Name'];
        $email = $row['Email'];
        $nickname = $row['Nickname'];
        $profilePicture = $row['ProfilePic'];

        if($role == 3) {
            $mysql = "SELECT * FROM Organization WHERE (SELECT OrganizationID FROM Staff WHERE UserID = '$userID') = OrganizationID";
            $result = $conn->query($mysql);
            $row = $result->fetch_assoc();

            $organizationName = $row['Name'];
            $organizationID = $row['OrganizationID'];
        }
        else if($role == 2) {
            $mysql = "SELECT * FROM Organization WHERE (SELECT OrganizationID FROM OrganizationLecturer WHERE UserID = '$userID') = OrganizationID";
            $result = $conn->query($mysql);
            $row = $result->fetch_assoc();

            $organizationID = $row['OrganizationID'];
            $organizationName = $row['Name'];
        }
        else if($row == 1){
            $mysql = "SELECT * FROM Organization WHERE (SELECT OrganizationID FROM Student WHERE UserID = '$userID') = OrganizationID";
            $result = $conn->query($mysql);
            $row = $result->fetch_assoc();

            $organizationID = $row['OrganizationID'];
            $organizationName = $row['Name'];
        }
    }
    else {
        echo "<script>alert('Please login to continue.');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
?>
