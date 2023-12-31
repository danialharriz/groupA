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
    <h2>Orgnanization Registration</h2>
    <form action="<?php echo URLROOT; ?>/admins/register_organization" method="POST">
        <div class="form-group">
            <label for="organization_name">Organization Name</label>
            <input type="text" name="organization_name" value="<?php echo $data['organizationName']; ?>" class="form-control">
            <span class="error"><?php echo $data['organization_name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" value="<?php echo $data['address']; ?>" class="form-control">
            <span class="error"><?php echo $data['address_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" value="<?php echo $data['city']; ?>" class="form-control">
            <span class="error"><?php echo $data['city_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" name="state" value="<?php echo $data['state']; ?>" class="form-control">
            <span class="error"><?php echo $data['state_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" value="<?php echo $data['website']; ?>" class="form-control">
            <span class="error"><?php echo $data['website_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control">
                <option value="0" <?php echo (isset($data['type']) && $data['type'] == 0) ? 'selected' : ''; ?>>Company</option>
                <option value="1" <?php echo (isset($data['type']) && $data['type'] == 1) ? 'selected' : ''; ?>>Institute</option>
            </select>
            <span class="error"><?php echo $data['type_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="contact_email">Contact Email</label>
            <input type="email" name="contact_email" value="<?php echo $data['contactEmail']; ?>" class="form-control">
            <span class="error"><?php echo $data['contact_email_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="contact_phone">Contact Phone</label>
            <input type="text" name="contact_phone" value="<?php echo $data['contactPhone']; ?>" class="form-control">
            <span class="error"><?php echo $data['contact_phone_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" name="pass" value="<?php echo $data['pass']; ?>" class="form-control">
            <span class="error"><?php echo $data['pass_err']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Register" class="btn btn-primary">
        </div>
    </form>
</body>
</html>
