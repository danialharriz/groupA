<?php require APPROOT . '/views/students/nav.php' ?>
<html>

<head>
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .invalidFeedback {
            color: red;
            margin-top: 5px;
            display: block;
        }

        /* Added styles for the icons */
        button i {
            margin-right: 5px;
        }

        .container13 {
            margin: 50px auto;
        }
    </style>
</head>

<body>
    <div class="container13">
    <h1><?php echo $data['title']; ?></h1>
    <form action="<?php echo URLROOT; ?>/students/addOutsideEvent" method="POST">
        <label for="eventName">Event Name:</label>
        <input type="text" name="eventName" id="eventName" value="<?php echo $data['eventName']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['eventNameError']; ?></span>

        <label for="organization">Organization:</label>
        <input type="text" name="organization" id="organization" value="<?php echo $data['organization']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['organizationError']; ?></span>

        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo $data['description']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['descriptionError']; ?></span>

        <label for="startDateTime">Start Date and Time:</label>
        <input type="datetime-local" name="startDateTime" id="startDateTime" value="<?php echo $data['startDateTime']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['startDateTimeError']; ?></span>

        <label for="endDateTime">End Date and Time:</label>
        <input type="datetime-local" name="endDateTime" id="endDateTime" value="<?php echo $data['endDateTime']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['endDateTimeError']; ?></span>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="<?php echo $data['location']; ?>" required>
        <span class="invalidFeedback"><?php echo $data['locationError']; ?></span>

        <label for="eventType">Event Type</label>
        <select name="eventType" class="form-control <?php echo (!empty($data['eventType_err'])) ? 'is-invalid' : ''; ?>">
            <option value="" <?php echo (empty($data['eventType'])) ? 'selected' : ''; ?>>Select Event Type</option>
            <option value="1" <?php echo ($data['eventType'] == 1) ? 'selected' : ''; ?>>Workshop</option>
            <option value="2" <?php echo ($data['eventType'] == 2) ? 'selected' : ''; ?>>Seminar</option>
            <option value="3" <?php echo ($data['eventType'] == 3) ? 'selected' : ''; ?>>Conference</option>
            <option value="4" <?php echo ($data['eventType'] == 4) ? 'selected' : ''; ?>>Competition</option>
            <option value="5" <?php echo ($data['eventType'] == 5) ? 'selected' : ''; ?>>Other</option>
        </select>
        <span class="invalid-feedback"><?php echo $data['eventTypeError']; ?></span>

        <label for="reference">Reference:</label>
        <input type="text" name="reference" id="reference" value="<?php echo $data['reference']; ?>" placeholder="Enter reference as prove such as link of event, link of cert etc">

        <!--submit btn-->
        <div style="text-align: center;">
            <button type="submit" id="submit" value="submit"><i class="bi bi-check-circle"></i> Submit</button>
        </div>
    </form>
    <div style="text-align: center;">
        <button onclick="window.history.back()" style = "background-color: #630E25;"><i class="bi bi-arrow-left-circle"></i> Back</button>
    </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
