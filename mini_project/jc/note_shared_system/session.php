<?php
    session_start();
    include 'db_conn.php';

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $mysql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        $row = mysqli_fetch_assoc($mysql);

        if ($row) {
            $name = $row['name'];
            $type = $row['type'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['type'] = $type;

            /*
            if ($type == 0) {
                echo "<script>alert('Login successful.');</script>";
                echo "<script>window.location.replace('admin_page.php');</script>";
            } else {
                echo "<script>alert('Login successful.');</script>";
                echo "<script>window.location.replace('main_page.php');</script>";
            }
            */
        } else {
            echo "<script>alert('Invalid email. Please try again.');</script>";
            echo "<script>window.location.replace('login.php');</script>";
        }
    } else {
        echo "<script>alert('Please login to continue.');</script>";
        echo "<script>window.location.replace('login.php');</script>";
    }
?>
