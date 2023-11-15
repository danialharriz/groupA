<?php
    include 'topnav1.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Profile</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center">
        <h1>Update Your Profile</h1>
        <form method="post" action="update_profile_process.php">
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>" required disabled>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $_SESSION['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
        </form>
        <br><br><br><hr>
        <div class="row">
            <div class="col">
                <a href="change_password.php" class="btn btn-primary btn-block">Change Password</a>
            </div>
            <div class="col">
                <a href="delete_profile.php" class="btn btn-danger btn-block">Delete Profile</a>
            </div>
        </div>
    </div>
</body>
</html>
