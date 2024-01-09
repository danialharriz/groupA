<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #183D64; /* Updated background color */
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
            color: #183D64;
            text-align: center;
        }

        h2 {
            color: #7C1C2B;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #183D64;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #FCBD32; /* Updated color for better visibility */
            color: #183D64;
            border: 1px solid #FCBD32; /* Matching border color */
            border-radius: 4px;
        }

        button {
            background-color: #7C1C2B;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #5E1623; /* Darker shade on hover */
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px; /* Added margin for spacing */
        }

        .logo-container img {
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="role-selection-container">
        <div class="logo-container">
            <img src="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" alt="Logo">
        </div>
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
