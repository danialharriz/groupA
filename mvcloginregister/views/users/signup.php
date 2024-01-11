<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: url('<?php echo URLROOT ?>/public/img/YVBackground2.jpeg') center/cover no-repeat fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: #183D64;
            max-width: 400px; /* Adjust the max-width for better responsiveness */
        }

        .logo {
            margin-bottom: 20px;
            max-width: 100%; /* Make the logo responsive */
            width: 100px; /* Set the width of the logo */
            height: auto; /* Maintain aspect ratio */
        }

        h2 {
            color: #183D64;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #183D64;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: linear-gradient(to bottom, #FCBD32, #F29C1F);
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to bottom, #F29C1F, #FCBD32);
        }

        .login-link {
            text-align: center;
            margin-top: 16px;
            color: #183D64;
        }

        .login-link a {
            color: #7C1C2B;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }

        if (!empty($data['credentialsError'])) {
            alert("<?php echo $data['credentialsError']; ?>");
        }
    </script>
</head>

<body>
    <div class="signup-container">
    <img src="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" alt="Logo" style="width: 80px; height: auto;">
        <h2>Sign Up</h2>
        <form action="<?php echo URLROOT; ?>/users/signup" method="post" onsubmit="return validatePassword();">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Re-enter Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Sign Up</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Login</a></p>
        </div>
    </div>
</body>

</html>
