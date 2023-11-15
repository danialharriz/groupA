<?php
    include 'db_conn.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists. Please use another email.');</script>";
        echo "<script>window.location.replace('signup.php');</script>";
    } else {
        $sql = "INSERT INTO `user`(`name`, `password`, `type`, `email`) VALUES ('$name', '$password', 1, '$email')";

        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('Sign up successful. Please login to continue.');</script>";
            echo "<script>window.location.replace('login.php');</script>";
        }
        else{
            echo "<script>alert('Sign up failed. Please try again.');</script>";
            echo "<script>window.location.replace('signup.php');</script>";
        }
        mysqki_close($conn);

    }
    mysqli_close($conn);
?>