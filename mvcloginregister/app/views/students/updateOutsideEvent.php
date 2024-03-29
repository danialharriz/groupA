<?php require APPROOT . '/views/students/nav.php' ?>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            color: #183D64; /* Updated text color */
        }

        h1 {
            text-align: center;
            background-color: #7C1C2B; /* Updated background color */
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .container15 {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            width: 100%;
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
        input[type="submit"],
        select {
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
        button {
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #183D64; /* Updated color */
            color: #ffffff;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class = "container15">
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
                        <select name="eventType" style="width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 10px; box-sizing: border-box;">
                            <option value="1" <?php if ($data['event']->OEventType == 1) echo 'selected'; ?>>Workshop</option>
                            <option value="2" <?php if ($data['event']->OEventType == 2) echo 'selected'; ?>>Seminar</option>
                            <option value="3" <?php if ($data['event']->OEventType == 3) echo 'selected'; ?>>Conference</option>
                            <option value="4" <?php if ($data['event']->OEventType == 4) echo 'selected'; ?>>Competition</option>
                            <option value="5" <?php if ($data['event']->OEventType == 5) echo 'selected'; ?>>Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Organization</td>
                    <td><input type="text" name="organization" value="<?php echo $data['event']->OOrganization; ?>"></td>
                    <td><span style="color:red"><?php echo $data['organizationError']; ?></span></td>
                </tr>
                <tr>
                    <td>Reference</td>
                    <td><input type="text" name="reference" value="<?php echo $data['event']->reference; ?>" placeholder="Enter reference as proof such as link of event, link of cert etc"></td>
                </tr>
            </table>
            <input type="submit" value="Update">
        </form>
        <div style = "text-align: center;">
            <button onclick="window.history.back()" style = "background-color: #630E25;"><i class="bi bi-arrow-left-circle"></i> Back</button>
        </div>
    </div>
    <br>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
