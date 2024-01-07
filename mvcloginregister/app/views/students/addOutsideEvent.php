<html>
<head>
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            background-color: #f3f3f3;
        }
        h1 {
            text-align: center;
            font-family: "Trebuchet MS", Helvetica, sans-serif;
            color: #003300;
        }
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0px 0px 10px 10px;
        }
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: white;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        label {
            font-family: "Trebuchet MS", Helvetica, sans-serif;
            font-size: 18px;
            color: #003300;
        }
        #submit {
            font-family: "Trebuchet MS", Helvetica, sans-serif;
            font-size: 18px;
            background: #003300;
            color: #fff;
            border-radius: 5px;
            padding: 5px;
            border: none;
            width: 100px;
        }
        .invalidFeedback {
            color: red;
        }
    </style>
</head>
<body>
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
        
        <!--submit btn-->
        <button type="submit" id="submit" value="submit">Submit</button>
    </form>
</body>
</html>
        

