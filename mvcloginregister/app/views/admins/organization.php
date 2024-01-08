<html>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .organization {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a.button {
            display: inline-block;
            background-color: #4caf50;
            color: #fff;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        a.button.edit {
            background-color: #2196f3;
        }

        a.button.delete {
            background-color: #f44336;
        }

        /* Optional: Add some styling for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
    <head>
        <title>Organization</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/organization.css">
    </head>
    <body>
        <div class="container">
            <div class="organization">
                <h1>Organization</h1>
                <table>
                    <tr>
                        <th>Organization Name</th>
                        <th>Organization Address</th>
                        <th>Organization City</th>
                        <th>Organization State</th>
                        <th>Organization Website</th>
                        <th>Organization Type</th>
                        <th>Organization Contact Email</th>
                        <th>Organization Contact Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['organizations'] as $organization) : ?>
                        <tr>
                            <td><?php echo $organization->OrganizationName; ?></td>
                            <td><?php echo $organization->Address; ?></td>
                            <td><?php echo $organization->City; ?></td>
                            <td><?php echo $organization->State; ?></td>
                            <td><?php echo $organization->Website; ?></td>
                            <td><?php if ($organization->Type == 1) {
                                    echo "Institute";
                                } else {
                                    echo "Company";
                                } ?></td>
                            <td><?php echo $organization->ContactEmail; ?></td>
                            <td><?php echo $organization->ContactPhone; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/admins/editOrganization/<?php echo $organization->OrganizationID; ?>" class="button edit">Edit</a>
                                <a href="<?php echo URLROOT; ?>/admins/deleteOrganization/<?php echo $organization->OrganizationID; ?>" class="button delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>