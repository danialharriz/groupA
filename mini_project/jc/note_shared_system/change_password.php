<?php
    include 'topnav1.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <form method="post" action="change_password_process.php" onsubmit="return validatePasswords()">
            <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" name="currentPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" class="form-control" name="confirmPassword" id="retype_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</body>
<script>
    function validatePasswords() {
        var password = document.getElementById('password').value;
        var retypePassword = document.getElementById('retype_password').value;

        if (password !== retypePassword) {
            alert("Passwords do not match. Please retype the same password.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>
</html>
