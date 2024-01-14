<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Organization Registration</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS styles */

        body {
            background-color: #f8f8f8;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 0 auto;
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

        h2 {
            color: #183D64;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
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

        .btn:hover {
            background-color: #0056b3;
        }

        .btn:active {
            background-color: #004080;
        }

        .btn:focus {
            outline: none;
            box-shadow: none;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .back-button {
            background-color: #7C1C2B;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
            cursor: pointer;
        }

        .back-button i {
            margin-right: 5px;
        }

        .back-button:hover {
            background-color: #630E25;
        }

        /* Center align the buttons */
        .button-container {
            text-align: center;
            margin-top: 20px;
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
            <div class="button-container">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        <div class="button-container">
            <a class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <script>
            function goBack() {
                history.back();
            }
        </script>
    </div>
    <br>
    <br>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
