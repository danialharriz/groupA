<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        background-color: #7C1C2B;
        color: #fff;
        padding: 20px;
        margin-bottom: 20px;
    }

    .icon {
        font-size: 20px;
        margin-right: 5px;
    }

    .container16 {
        width: 70%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 50%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    td, th {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    form {
        text-align: center;
        margin-top: 20px;
    }

    input[type="submit"] {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    button {
        background-color: #7C1C2B;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
    }

    .button-container {
        text-align: center;
    }
</style>
<head>
    <title>View Outside Event</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class = "container16">
    <h1>View Outside Event</h1>
    <table>
        <tr>
            <td>Event Name</td>
            <td><?php echo $data['event']->OEventName; ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?php echo $data['event']->ODescription; ?></td>
        </tr>
        <tr>
            <td>Start Date and Time</td>
            <td><?php echo $data['event']->OStartDateAndTime; ?></td>
        </tr>
        <tr>
            <td>End Date and Time</td>
            <td><?php echo $data['event']->OEndDateAndTime; ?></td>
        </tr>
        <tr>
            <td>Location</td>
            <td><?php echo $data['event']->OLocation; ?></td>
        </tr>
        <tr>
            <td>Event Type</td>
            <td><?php if ($data['event']->OEventType == 1){
                echo "Workshop";
            } elseif ($data['event']->OEventType == 2){
                echo "Seminar";
            } else if ($data['event']->OEventType == 3){
                echo "Conference";
            } else if ($data['event']->OEventType == 4){
                echo "Competition";
            } else {
                echo "Other";
            } ?></td>
        </tr>
        <tr>
            <td>Organization</td>
            <td><?php echo $data['event']->OOrganization; ?></td>
        </tr>
        <tr>
            <td>Reference</td>
            <td><?php echo $data['event']->reference; ?></td>
        </tr>
        <tr>
            <td>Approval Status</td>
            <td><?php if ($data['event']->approvalStatus == 0) {
                echo "Pending";
            } elseif ($data['event']->approvalStatus == 1) {
                echo "Approved";
            } else {
                echo "Rejected";
            } ?></td>
        </tr>
        
    </table>
    <!-- if event is rejected, show update button -->
    <?php if ($data['event']->approvalStatus == 2) : ?>
            <form action="<?php echo URLROOT; ?>/students/updateOutsideEvent/<?php echo $data['event']->OEventID; ?>" method="get">
                <i class="icon fas fa-edit"></i><input type="submit" value="Update">
            </form>
        <?php endif; ?>
        <!-- delete button -->
        <form action="<?php echo URLROOT; ?>/students/deleteOutsideEvent/<?php echo $data['event']->OEventID; ?>" method="post">
            <i class="icon fas fa-trash-alt"></i><input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this event?');">
        </form>
        <div class = "button-container">
        <button onclick="window.location.href='<?php echo URLROOT; ?>/students/viewOutsideEvents'"><i class="icon fas fa-arrow-left"></i> Back</button>
    </div>
    </div>
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>