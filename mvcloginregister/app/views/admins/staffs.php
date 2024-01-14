<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Staffs</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/staffs.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css">
    <style>
        /* Custom CSS styles */

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container11 {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #FCBD32;
        }

        h3 {
            text-align: center;
            margin-top: 10px;
            color: #FCBD32;
        }

        .button {
            display: inline-block;
            width: 120px;
            margin-left: 10px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #7C1C2B;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        input[type=text] {
            width: 20%;
            padding: 10px;
            margin: 20px auto;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type=submit] {
            display: inline-block;
            width: 120px;
            margin: 20px 0;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            border: none;
        }

        button[type=submit]:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 600px) {
            input[type=text] {
                width: 80%;
            }
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container11">
        <h1>Staffs List</h1>
        <h3>Organization: <?php echo $data['organization']->OrganizationName; ?></h3>
        <!-- search form -->
        <form action="<?php echo URLROOT; ?>/admins/staffs/<?php echo $data['organization']->OrganizationID; ?>" method="POST">
            <div style="text-align: center;">
                <input type="text" name="search" placeholder="Search by name, email, job title">
                <button type="submit" name="submit-search" class="button"><i class="bi bi-search"></i> Search</button>
            </div>
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Job Title</th>
            </tr>
            <?php if (empty($data['staffs'])) : ?>
                <tr>
                    <td colspan="4">No staffs available</td>
                </tr>
            <?php else : ?>
                <?php foreach ($data['staffs'] as $staff) : ?>
                    <tr>
                        <td><a href="<?php echo URLROOT; ?>/admins/staff/<?php echo $staff->StaffID; ?>"><?php echo $staff->User->Name; ?></a></td>
                        <td><?php echo $staff->User->Email; ?></td>
                        <td><?php echo $staff->User->Phone; ?></td>
                        <td><?php echo $staff->JobTitle; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <div style="text-align: center;">
            <button onclick="goBack()" class="back-button"><i class="bi bi-arrow-left"></i> Back</button>
        </div>
    </div>
</body>

<script>
    function goBack() {
        history.back();
    }
</script>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
