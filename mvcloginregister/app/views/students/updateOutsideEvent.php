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
        background-color: #007bff;
        color: #ffffff;
        padding: 20px;
        margin-bottom: 20px;
    }

    form {
        width: 50%;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    input[type="text"],
    input[type="datetime-local"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #28a745;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    span {
        color: red;
        display: block;
        margin-top: 5px;
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
</style>

<head>
    <title>Update Outside Event</title>
</head>
<body>
    <h1>Update Outside Event</h1>
    <form action="<?php echo URLROOT; ?>/students/updateOutsideEvent/<?php echo $data['event']->OEventID; ?>" method="post">
        <table>
            <tr>
                <td>Event Name</td>
                <td><input type="text" name="eventName" value="<?php echo $data['event']->OEventName; ?>"></td>
                <td><span style="color:red"><?php echo $data['eventNameError']; ?></span></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" value="<?php echo $data['event']->ODescription; ?>"></td>
                <td><span style="color:red"><?php echo $data['descriptionError']; ?></span></td>
            </tr>
            <tr>
                <td>Start Date and Time</td>
                <td><input type="datetime-local" name="startDateTime" value="<?php echo $data['event']->OStartDateAndTime; ?>"></td>
                <td><span style="color:red"><?php echo $data['startDateTimeError']; ?></span></td>
            </tr>
            <tr>
                <td>End Date and Time</td>
                <td><input type="datetime-local" name="endDateTime" value="<?php echo $data['event']->OEndDateAndTime; ?>"></td>
                <td><span style="color:red"><?php echo $data['endDateTimeError']; ?></span></td>
            </tr>
            <tr>
                <td>Location</td>
                <td><input type="text" name="location" value="<?php echo $data['event']->OLocation; ?>"></td>
                <td><span style="color:red"><?php echo $data['locationError']; ?></span></td>
            </tr>
            <tr>
                <td>Event Type</td>
                <td>
                    <select name="eventType">
                        <option value="1" <?php if ($data['event']->OEventType == 1) echo 'selected'; ?>>Workshop</option>
                        <option value="2" <?php if ($data['event']->OEventType == 2) echo 'selected'; ?>>Seminar</option>
                        <option value ="3" <?php if ($data['event']->OEventType == 3) echo 'selected'; ?>>Conference</option>
                        <option value ="4" <?php if ($data['event']->OEventType == 4) echo 'selected'; ?>>Compettion</option>
                        <option value ="5" <?php if ($data['event']->OEventType == 5) echo 'selected'; ?>>Other</option>                        
                    </select>
            </tr>
            <tr>
                <td>Organization</td>
                <td><input type="text" name="organization" value="<?php echo $data['event']->OOrganization; ?>"></td>
                <td><span style="color:red"><?php echo $data['organizationError']; ?></span></td>
            </tr>
            <tr>
                <td>Reference</td>
                <td><input type="text" name="reference" value="<?php echo $data['event']->reference; ?>" placeholder="Enter reference as prove such as link of event, link of cert etc"></td>
            </tr>
        </table>
        <input type="submit" value="Update">
    </form>
    <a href="<?php echo URLROOT; ?>/students/viewOutsideEvents">Back</a>
</body>
</html>