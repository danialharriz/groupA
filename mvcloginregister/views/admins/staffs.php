<?php
    require APPROOT . '/views/admins/nav.php';
?>
<htnl>
<head>
    <title>Staffs</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/staffs.css">
</head>
<body>
    <h1>Staffs List</h1>
    <h3>Organization: <?php echo $data['organization']->OrganizationName; ?></h3>
    <a href="<?php echo URLROOT; ?>/admins/register_staff/<?php echo $data['organization']->OrganizationID; ?>" class="button">Add Staff</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Job Title</th>
        </tr>
        <?php foreach ($data['staffs'] as $staff) : ?>
            <tr>
                <td><a href="<?php echo URLROOT; ?>/admins/staff/<?php echo $staff->StaffID; ?>"><?php echo $staff->User->Name; ?></a></td> 
                <td><?php echo $staff->User->Email; ?></td>
                <td><?php echo $staff->User->Phone; ?></td>
                <td><?php echo $staff->JobTitle; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>
<style>
    /* staffs.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #007bff;
}

h3 {
    text-align: center;
    margin-top: 10px;
    color: #333;
}

.button {
    display: block;
    width: 120px;
    margin: 20px auto;
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

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #007bff;
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

</style>
</htnl>