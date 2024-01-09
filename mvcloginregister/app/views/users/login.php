<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: url('<?php echo URLROOT ?>/public/img/YVBackground1.png') center/cover no-repeat fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: #183D64;
            max-width: 400px; /* Adjust the max-width for better responsiveness */
        }

        h2 {
            color: #183D64;
            margin-bottom: 20px;
        }

        h3 {
            color: #7C1C2B;
            margin-bottom: 20px;
            font-size: 18px;
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
        if (!empty($data['credentialsError'])) {
            alert("<?php echo $data['credentialsError']; ?>");
        }
    </script>
</head>

<body>
    <div class="login-container">
        <img src="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" alt="Logo" style="width: 80px; height: auto;">
        <h2>Login</h2>
        <h3>ADVENTURES AWAIT YOU!</h3>
        <form action="<?php echo URLROOT; ?>/users/login" method="post">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="login-link">
            <p>Don't have an account? <a href="<?php echo URLROOT; ?>/users/signup">Sign Up</a></p>
        </div>
    </div>
</body>

</html>
