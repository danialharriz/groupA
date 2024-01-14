<?php require APPROOT . '/views/admins/nav.php'; ?>

<html>

<head>
    <title>Pending Approval Staff</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/pending_approval_staff.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
            color: #FCBD32;
            text-align: center;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #333;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #7C1C2B;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .button {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }

        .button.approve {
            background-color: #45a049;
        }

        .button.reject {
            background-color: #d32f2f;
        }

        .button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Pending Approval Staff</h1>
        <div class="table-container">
            <table>
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
                            <td><a href="<?php echo URLROOT; ?>/org/<?php echo $staff->Organization->OrganizationID; ?>"><?php echo $staff->Organization->OrganizationName; ?></a></td>
                            <td><?php echo $staff->User->Email; ?></td>
                            <td><?php echo $staff->JobTitle; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/admins/approve_staff/<?php echo $staff->StaffID; ?>" class="button approve">
                                    <i class="uil uil-check"></i> Approve
                                </a>
                                <a href="<?php echo URLROOT; ?>/admins/reject_staff/<?php echo $staff->StaffID; ?>" class="button reject">
                                    <i class="uil uil-times"></i> Reject
                                </a>
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
