<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
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
            background-color: #f2f2f2;
            color: #333;
        }

        .staff-table tr:hover {
            background-color: #f5f5f5;
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
            color: #333;
        }

        .card h1 {
            color: #007BFF;
            font-size: 36px;
            margin-top: 10px;
        }
    </style>
    <head>
        <title>Pending Approval Staff</title>
        <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/pending_approval_staff.css">
    </head>
    <body>
        <div class="container">
                <table class="summary-table">
                <th>
                    <div class = "card">
                        <h3>Total User in the system</h3>
                        <h1><?php echo $data['totalUser']; ?></h1>
                    </div>
                </th>
                <th>
                    <div class = "card">
                        <h3>Total Event in the system</h3>
                        <h1><?php echo $data['totalEvent']; ?></h1>
                    </div>
                </th>
                <th>
                    <div class = "card">
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
                        <?php foreach($data['staffs'] as $staff) : ?>
                            <tr>
                                <td><?php echo $staff->User->Name; ?></td>
                                <td><?php echo $staff->OrganizationName; ?></td>
                                <td><?php echo $staff->User->Email; ?></td>
                                <td><?php echo $staff->JobTitle; ?></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/admins/approve_staff/<?php echo $staff->StaffID; ?>" class="button">Approve</a>
                                    <a href="<?php echo URLROOT; ?>/admins/reject_staff/<?php echo $staff->StaffID; ?>" class="button delete">Reject</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </body>
</html>