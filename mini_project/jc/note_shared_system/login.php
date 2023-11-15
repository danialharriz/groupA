<?php include 'topnav.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center"> <!-- Center-align content -->
        <h2>User Login</h2>
        <form action="login_process.php" method="post">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" class="form-control" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" class="form-control" id="password" name="password" required></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
            <br>
        </form>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>
