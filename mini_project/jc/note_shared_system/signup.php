<?php include 'topnav.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Sign-Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</head>
<body>
    <div class="container mt-5 text-center"> <!-- Center-align content -->
        <h2>User Sign-Up</h2>
        <form action="signup_process.php" method="post" onsubmit="return validatePasswords();">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" class="form-control" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><input type="text" class="form-control" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" class="form-control" id="password" name="password" required minlength="4"></td>
                    </tr>
                    <tr>
                        <td><label for="retype_password">Retype Password</label></td>
                        <td><input type="password" class="form-control" id="retype_password" name="retype_password" required></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
            <br>
        </form>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>
