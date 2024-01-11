<?php require APPROOT . '/views/staffs/nav.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background-color: #FFFFFF;
            padding: 20px;
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"],
        input[type="datetime-local"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .registerbtn, .button {
            display: inline-block;
            width: 49%;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            opacity: 0.9;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }

        .registerbtn:hover, .button:hover {
            opacity: 1;
        }

        .registerbtn {
            background-color: #4CAF50;
            color: white;
        }

        .button {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
        }

        .button.delete {
            background-color: #FF0000;
            color: white;
        }

        .button.edit {
            background-color: #0000FF;
            color: white;
        }

        img {
            width: 100%;
            height: auto;
            max-height: 300px;
        }

        span.error {
            color: red;
            display: block;
            margin-top: 5px;
        }

        /* Add the following styles for the file upload */
        .upload {
            margin-bottom: 15px;
        }

        .round {
            border: 2px solid #ddd;
            padding: 10px;
            border-radius: 8px;
        }

        .round input[type="file"] {
            display: none;
        }

        .round label {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Event Detail</h1>
        <hr>
        <?php if ($data['picture'] != null) : ?>
            <img src="<?php echo URLROOT; ?>/public/<?php echo $data['picture']; ?>" alt="Event Picture">
        <?php endif; ?>
        <form action="<?php echo URLROOT; ?>/staffs/update_event/<?php echo $data['eventId']; ?>" method="post" enctype="multipart/form-data" id="form">
            <label for="picture"><b>Update Event Picture</b></label>
            <div class="upload">
                <div class="round">
                    <input type="file" name="picture" id="picture" accept="image/*">
                    <label for="picture">Choose File</label>
                </div>
            </div>
            <input type="hidden" name="posttype" value="updatepic">
            <input type="submit" name="upload" value="Update" class="button">
        </form>
        <form action="<?php echo URLROOT; ?>/staffs/update_event/<?php echo $data['eventId']; ?>" method="post">
        
                <label for="event_name"><b>Event Name</b></label>
                <input type="text" placeholder="Enter Event Name" name="event_name" value="<?php echo $data['eventName']; ?>">
                <span style="color:red;"><?php echo $data['event_name_err']; ?></span>
                <label for="description"><b>Description</b></label>
                <input type="text" placeholder="Enter Description" name="description" value="<?php echo $data['description']; ?>">
                <span style="color:red;"><?php echo $data['description_err']; ?></span>
                <label for="start_date_and_time"><b>Start Date and Time</b></label>
                <input type="datetime-local" placeholder="Enter Start Date and Time" name="start_date_and_time" value="<?php echo $data['startDateAndTime']; ?>">
                <span style="color:red;"><?php echo $data['start_date_and_time_err']; ?></span>
                <label for="end_date_and_time"><b>End Date and Time</b></label>
                <input type="datetime-local" placeholder="Enter End Date and Time" name="end_date_and_time" value="<?php echo $data['endDateAndTime']; ?>">
                <span style="color:red;"><?php echo $data['end_date_and_time_err']; ?></span>
                <label for="deadline"><b>Deadline</b></label>
                <input type="datetime-local" placeholder="Enter Deadline" name="deadline" value="<?php echo $data['deadline']; ?>">
                <span style="color:red;"><?php echo $data['deadline_err']; ?></span>
                <label for="MaxParticipants"><b>Maximum Participants</b></label>
                <input type="number" placeholder="Enter Maximum Participants" name="MaxParticipants" value="<?php echo $data['maxParticipant']; ?>">
                <span style="color:red;"><?php echo $data['maxParticipant_err']; ?></span>
                <label for="location"><b>Location</b></label>
                <input type="text" placeholder="Enter Location" name="location" value="<?php echo $data['location']; ?>">
                <span style="color:red;"><?php echo $data['location_err']; ?></span>
                <label for="event_type"><b>Event Type</b></label>
                <select name="event_type" class="form-control <?php echo (!empty($data['event_type_err'])) ? 'is-invalid' : ''; ?>">
                    <option value="1" <?php echo ($data['eventType'] == 1) ? 'selected' : ''; ?>>Workshop</option>
                    <option value="2" <?php echo ($data['eventType'] == 2) ? 'selected' : ''; ?>>Seminar</option>
                    <option value="3" <?php echo ($data['eventType'] == 3) ? 'selected' : ''; ?>>Conference</option>
                    <option value="4" <?php echo ($data['eventType'] == 4) ? 'selected' : ''; ?>>Competition</option>
                    <option value="5" <?php echo ($data['eventType'] == 5) ? 'selected' : ''; ?>>Other</option>
                </select>
                <span style="color:red;"><?php echo $data['event_type_err']; ?></span>
                <button type="submit" class="registerbtn">Update</button>
                <!-- back button -->
                <a href="<?php echo URLROOT; ?>/staffs/all_events" class="button">Back</a>
            </form>
        </div>
    </body>
</html>