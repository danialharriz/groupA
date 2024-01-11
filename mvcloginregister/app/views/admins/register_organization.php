<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Organization Registration</title>
    <style>
        /* Custom CSS styles */
        .container {
            margin: 0 auto; /* Add this line to center the container */
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Organization Registration</h2>
        <form action="register_organization.php" method="POST">
            <div class="form-group">
                <label for="organizationName">Organization Name</label>
                <input type="text" name="organizationName" id="organizationName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="website" id="website" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="1">Institute</option>
                    <option value="2">Company</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contactEmail">Contact Email</label>
                <input type="email" name="contactEmail" id="contactEmail" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contactPhone">Contact Phone</label>
                <input type="text" name="contactPhone" id="contactPhone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="emailending">Email Ending</label>
                <input type="text" name="emailending" id="emailending" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    
</body>
</html>
