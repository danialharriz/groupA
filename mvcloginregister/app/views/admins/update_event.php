<?php
/*
    public function update_event() {
        //get event id from url
        $url = $this->getUrl();
        $eventId = $url[2];
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'eventId' => $eventId,
                'eventName' => trim($_POST['event_name']),
                'description' => trim($_POST['description']),
                'startDateAndTime' => trim($_POST['start_date_and_time']),
                'endDateAndTime' => trim($_POST['end_date_and_time']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['event_type']),
                'rewardPoints' => trim($_POST['reward_points']),
                'organizationId' => $this->adminModel->getOrganizationIdByStaffId($_SESSION['user_id']),
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Validate data
            if(empty($data['eventName'])){
                $data['event_name_err'] = 'Please enter event name';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['startDateAndTime'])){
                $data['start_date_and_time_err'] = 'Please enter start date and time';
            }
            if(empty($data['endDateAndTime'])){
                $data['end_date_and_time_err'] = 'Please enter end date and time';
            }
            if(empty($data['location'])){
                $data['location_err'] = 'Please enter location';
            }
            if(empty($data['eventType'])){
                $data['event_type_err'] = 'Please enter event type';
            }
            if(empty($data['rewardPoints'])){
                $data['reward_points_err'] = 'Please enter reward points';
            }
            if(empty($data['organizationId'])){
                $data['organization_id_err'] = 'Something went wrong';
            }
            // Make sure errors are empty
            if (empty($data['event_name_err']) && empty($data['description_err']) && empty($data['start_date_and_time_err']) && empty($data['end_date_and_time_err']) && empty($data['location_err']) && empty($data['event_type_err']) && empty($data['reward_points_err']) && empty($data['organization_id_err'])) {
                // Validated
                // Register event
                if ($this->eventModel->updateEvent($data)) {
                    // Redirect to login
                    echo "<script>alert('Event updated successfully');</script>";
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/update_event', $data);
            }
        } else {
            // Get existing event from model
            $event = $this->eventModel->getEventById($eventId);
            // Check for owner
            if ($event->OrganizationId != $_SESSION['user_id']) {
                header('location: ' . URLROOT . '/admins');
            }
            $data = [
                'eventId' => $eventId,
                'eventName' => $event->EventName,
                'description' => $event->Description,
                'startDateAndTime' => $event->StartDateAndTime,
                'endDateAndTime' => $event->EndDateAndTime,
                'location' => $event->Location,
                'eventType' => $event->EventType,
                'rewardPoints' => $event->RewardPoints,
                'organizationId' => $event->OrganizationId,
                'event_id_err' => '',
                'event_name_err' => '',
                'description_err' => '',
                'start_date_and_time_err' => '',
                'end_date_and_time_err' => '',
                'location_err' => '',
                'event_type_err' => '',
                'reward_points_err' => '',
                'organization_id_err' => '',
                //'validated_err' => '',
            ];
            // Load view
            $this->view('admins/update_event', $data);
        }
        $this->view('admins/update_event');
    }
*/
?>
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
                <a href="<?php echo URLROOT; ?>/admins/allevents" class="button">Back</a>
            </form>
        </div>
    </body>
</html>