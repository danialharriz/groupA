<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
    <head>
        <title>Event Detail</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background-color: #f1f1f1;
            }
            
            .container {
                background-color: #FFFFFF;
                padding: 20px;
            }
            
            input[type=text], input[type=password], input[type=datetime-local], input[type=number] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: none;
                background: #f1f1f1;
            }
            
            input[type=text]:focus, input[type=password]:focus, input[type=datetime-local]:focus, input[type=number]:focus {
                background-color: #ddd;
                outline: none;
            }
            
            hr {
                border: 1px solid #f1f1f1;
                margin-bottom: 25px;
            }
            
            .registerbtn {
                background-color: #4CAF50;
                color: white;
                padding: 16px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }
            
            .registerbtn:hover {
                opacity: 1;
            }
            
            a {
                color: dodgerblue;
            }
            
            .signin {
                background-color: #f1f1f1;
                text-align: center;
            }
            
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                margin: 2px 2px;
                cursor: pointer;
            }
            
            .button.delete {
                background-color: #FF0000; /* Red color */
            }
            
            .button.edit {
                background-color: #0000FF; /* Blue color */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Event Detail</h1>
            <hr>
            <form action="<?php echo URLROOT; ?>/admins/update_event/<?php echo $data['eventId']; ?>" method="post">
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
                <span style="color:red;"><?php echo $data['reward_points_err']; ?></span>
                <button type="submit" class="registerbtn">Update</button>
                <!-- back button -->
                <a href="<?php echo URLROOT; ?>/admins/all_events" class="button">Back</a>
            </form>
        </div>
    </body>
</html>