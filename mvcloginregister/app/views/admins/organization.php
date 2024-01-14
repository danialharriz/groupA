<?php require APPROOT . '/views/admins/nav.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <!-- Adding Unicons for icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/organization.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #FCBD32;
        }

        .organization {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #333;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #7C1C2B;
            color: #fff;
        }

        a.button {
            display: inline-block;
            background-color: #6495ED;
            color: #fff;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        a.button.add {
            background-color: #239B56;
        }

        a.button.add:hover {
            background-color: #9FE2BF;
        }

        a.button.edit {
            background-color: #FFBF00;
        }

        a.button.delete {
            background-color: #DE3163;
        }

        /* Optional: Add some styling for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-right: 10px;
        }

        .search-bar button[type="submit"] {
            background-color: #6495ED;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="organization">
            <h1>Partnered Organizations and Institutes</h1>
            <!-- search bar -->
            <form action="<?php echo URLROOT; ?>/admins/organization" method="POST" class="search-bar">
                <input type="text" name="search" placeholder="Search Organization" class="search-input">
                <button type="submit" name="submit-search" class="search-button">Search</button>
                <a href="<?php echo URLROOT; ?>/admins/register_organization" class="button add">Add Organization</a>
            </form>
            <table>
                <tr>
                    <th>Organization Name</th>
                    <th>Organization Address</th>
                    <th>Organization Website</th>
                    <th>Organization Type</th>
                    <th>Organization Contact Email</th>
                    <th>Organization Contact Phone</th>
                    <th>Member</th>
                    <th>Action</th>
                </tr>
                <?php if (empty($data['organizations'])) : ?>
                    <tr>
                        <td colspan="10">No organizations found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['organizations'] as $organization) : ?>
                        <tr>
                            <td><a href="<?php echo URLROOT; ?>/admins/org/<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></a></td>
                            <td><?php echo $organization->Address; ?></td>
                            <td><?php echo $organization->Website; ?></td>
                            <td><?php echo ($organization->Type == 1) ? "Institute" : "Company"; ?></td>
                            <td><?php echo $organization->ContactEmail; ?></td>
                            <td><?php echo $organization->ContactPhone; ?></td>
                            <td>
                                <?php if ($organization->Type == 1) : ?>
                                    <a href="<?php echo URLROOT; ?>/admins/Students/<?php echo $organization->OrganizationID; ?>" class="button" style="Width: 90px;">Students</a>
                                <?php elseif ($organization->Type == 2) : ?>
                                    <a href="<?php echo URLROOT; ?>/admins/Staffs/<?php echo $organization->OrganizationID; ?>" class="button" style="Width: 90px;">Staffs</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/admins/editOrganization/<?php echo $organization->OrganizationID; ?>" class="button edit">
                                    <i class="uil uil-edit"></i> 
                                </a>
                                <a href="<?php echo URLROOT; ?>/admins/deleteOrganization/<?php echo $organization->OrganizationID; ?>" class="button delete">
                                    <i class="uil uil-trash-alt"></i> 
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
