<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .role-selection-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="role-selection-container">
        <h2>Select Your Role</h2>
        <form action="<?php echo URLROOT; ?>/users/selectRole" method="post">
            <label for="selected_role">Choose your role:</label>
            <select id="selected_role" name="selected_role" required>
                <option value="student">Student</option>
                <option value="staff">Staff</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
