<html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    margin: 20px;
    color: #333;
}

h1 {
    color: #333;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

hr {
    border: 1px solid #ccc;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

button:active {
    background-color: #004080;
}

button:focus {
    outline: none;
    box-shadow: none;
}

span {
    color: red;
}
</style>
<head>
    <title>Change Password</title>
    <!-- Include your CSS stylesheets and scripts here -->
</head>
<body>
    <h1>Change Password</h1>
    <hr>

    <form action="<?php echo URLROOT; ?>/admins/changepassword" method="post">
        <label for="current_password"><b>Current Password</b></label>
        <input type="password" placeholder="Enter Current Password" name="current_password">
        <span style="color:red;"><?php echo $data['current_passwordError']; ?></span>

        <label for="new_password"><b>New Password</b></label>
        <input type="password" placeholder="Enter New Password" name="new_password">
        <span style="color:red;"><?php echo $data['new_passwordError']; ?></span>

        <label for="confirm_new_password"><b>Confirm New Password</b></label>
        <input type="password" placeholder="Confirm New Password" name="confirm_new_password">
        <span style="color:red;"><?php echo $data['confirm_new_passwordError']; ?></span>

        <button type="submit">Change Password</button>
    </form>

    <!-- Include your additional HTML and scripts here -->
</body>
</html>
