<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval Staff</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/pending_approval_staff.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #FCBD32;
            text-align: center;
        }

        /* Styles for the staff table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .staff-table th, .staff-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .staff-table th {
            background-color: #7C1C2B;
            color: #fff;
        }

        .staff-table tr:hover {
            background-color: #ffff80;
        }

        .button {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button.delete {
            background-color: #f44336;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button.delete:hover {
            background-color: #d32f2f;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            color: #fff;
        }

        .card h1 {
            color: #007BFF;
            font-size: 36px;
            margin-top: 10px;
        }

        /* Style for icons */
        i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="summary-table">
            <th>
                <div class="card" style="background-color: #FCBD32;">
                    <h3>Total User in the system</h3>
                    <h1><?php echo $data['totalUser']; ?></h1>
                </div>
            </th>
            <th>
                <div class="card" style="background-color: #7C1C2B;">
                    <h3>Total Event in the system</h3>
                    <h1><?php echo $data['totalEvent']; ?></h1>
                </div>
            </th>
            <th>
                <div class="card" style="background-color: #183D64;">
                    <h3>Total Student registered</h3>
                    <h1><?php echo $data['totalStudent']; ?></h1>
                </div>
            </th>
        </table>
    </div>
    <div class="container">
        <h1>Pending Approval Staff</h1>
        <div class="table-container">
            <table class="staff-table">
                <tr>
                    <th>Staff Name</th>
                    <th>Organization Name</th>
                    <th>Contact</th>
                    <th>Job Title</th>
                    <th>Actions</th>
                </tr>
                <?php if (empty($data['staffs'])) : ?>
                    <tr>
                        <td colspan="5">No pending approval staff</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['staffs'] as $staff) : ?>
                        <tr>
                            <td><?php echo $staff->User->Name; ?></td>
                            <td><?php echo $staff->OrganizationName; ?></td>
                            <td><?php echo $staff->User->Email; ?></td>
                            <td><?php echo $staff->JobTitle; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/admins/approve_staff/<?php echo $staff->StaffID; ?>" class="button"><i class="fas fa-check"></i> Approve</a>
                                <a href="<?php echo URLROOT; ?>/admins/reject_staff/<?php echo $staff->StaffID; ?>" class="button delete"><i class="fas fa-times"></i> Reject</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
