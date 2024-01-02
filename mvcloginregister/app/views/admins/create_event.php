<?php
/*
    public function create_event() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //auto generate event id
            $event_id = $this->eventModel->getEventId();
            //if there is no event id in database, set event id to E00001, else auto increment
            if ($event_id == null) {
                $event_id = 'E00001';
            } else {
                $event_id = substr($event_id, 1);
                $event_id = intval($event_id);
                $event_id = 'E' . sprintf('%05d', $event_id + 1);
            }
            $data = [
                'eventId' => $event_id,
                'eventName' => trim($_POST['event_name']),
                'description' => trim($_POST['description']),
                'startDateAndTime' => trim($_POST['start_date_and_time']),
                'endDateAndTime' => trim($_POST['end_date_and_time']),
                'location' => trim($_POST['location']),
                'eventType' => trim($_POST['event_type']),
                'rewardPoints' => trim($_POST['reward_points']),
                //get the organization id from stafff table
                <form action="<?php echo URLROOT; ?>/admins/create_event" method="POST">
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input type="text" name="event_name" class="form-control <?php echo (!empty($data['event_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['eventName']; ?>">
                        <span class="invalid-feedback"><?php echo $data['event_name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="start_date_and_time">Start Date and Time</label>
                        <input type="datetime-local" name="start_date_and_time" class="form-control <?php echo (!empty($data['start_date_and_time_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['startDateAndTime']; ?>">
                        <span class="invalid-feedback"><?php echo $data['start_date_and_time_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="end_date_and_time">End Date and Time</label>
                        <input type="datetime-local" name="end_date_and_time" class="form-control <?php echo (!empty($data['end_date_and_time_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['endDateAndTime']; ?>">
                        <span class="invalid-feedback"><?php echo $data['end_date_and_time_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control <?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>">
                        <span class="invalid-feedback"><?php echo $data['location_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="event_type">Event Type</label>
                        <input type="text" name="event_type" class="form-control <?php echo (!empty($data['event_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['eventType']; ?>">
                        <span class="invalid-feedback"><?php echo $data['event_type_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="reward_points">Reward Points</label>
                        <input type="number" name="reward_points" class="form-control <?php echo (!empty($data['reward_points_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['rewardPoints']; ?>">
                        <span class="invalid-feedback"><?php echo $data['reward_points_err']; ?></span>
                    </div>
                    <input type="hidden" name="organization_id" value="<?php echo $data['organizationId']; ?>">
                    <input type="submit" value="Create Event" class="btn btn-primary">
                </form>
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
                if ($this->eventModel->addEvent($data)) {
                    // Redirect to login
                    header('location: ' . URLROOT . '/admins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admins/create_event', $data);
            }
        } else {
            // Init data
            $data = [
                'eventId' => '',
                'eventName' => '',
                'description' => '',
                'startDateAndTime' => '',
                'endDateAndTime' => '',
                'location' => '',
                'eventType' => '',
                'rewardPoints' => '',
                'organizationId' => '',
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
            $this->view('admins/create_event', $data);
        }
        $this->view('admins/create_event');
    }
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
    <link rel="stylesheet" href="styles.css">
    <style>
/* FILEPATH: /c:/xampp/htdocs/mvcloginregister/app/views/admins/styles.css */

/* Form container */
.form-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 5px;
}

/* Form title */
.form-container h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* Form input fields */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Invalid input styling */
.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
}

/* Submit button */
.form-container button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <h1>Create Event</h1>
    <form action="<?php echo URLROOT; ?>/admins/create_event" method="POST">
        <!--Event name-->
        <div class="form-group">
            <label for="event_name">Event Name</label>
            <input type="text" name="event_name" class="form-control <?php echo (!empty($data['event_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['eventName']; ?>">
            <span class="invalid-feedback"><?php echo $data['event_name_err']; ?></span>
        </div>
        <!--Description-->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
        </div>
        <!--Start date and time-->
        <div class="form-group">
            <label for="start_date_and_time">Start Date and Time</label>
            <input type="datetime-local" name="start_date_and_time" class="form-control <?php echo (!empty($data['start_date_and_time_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['startDateAndTime']; ?>">
            <span class="invalid-feedback"><?php echo $data['start_date_and_time_err']; ?></span>
        </div>
        <!--End date and time-->
        <div class="form-group">
            <label for="end_date_and_time">End Date and Time</label>
            <input type="datetime-local" name="end_date_and_time" class="form-control <?php echo (!empty($data['end_date_and_time_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['endDateAndTime']; ?>">
            <span class="invalid-feedback"><?php echo $data['end_date_and_time_err']; ?></span>
        </div>
        <!--Location-->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control <?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>">
            <span class="invalid-feedback"><?php echo $data['location_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="event_type">Event Type</label>
            <select name="event_type" class="form-control <?php echo (!empty($data['event_type_err'])) ? 'is-invalid' : ''; ?>">
                <option value="1" <?php echo ($data['eventType'] == 1) ? 'selected' : ''; ?>>Workshop</option>
                <option value="2" <?php echo ($data['eventType'] == 2) ? 'selected' : ''; ?>>Seminar</option>
                <option value="3" <?php echo ($data['eventType'] == 3) ? 'selected' : ''; ?>>Conference</option>
                <option value="4" <?php echo ($data['eventType'] == 4) ? 'selected' : ''; ?>>Competition</option>
                <option value="5" <?php echo ($data['eventType'] == 5) ? 'selected' : ''; ?>>Other</option>
            </select>
            <span class="invalid-feedback"><?php echo $data['event_type_err']; ?></span>
        </div>
        <input type="hidden" name="organization_id" value="<?php echo $data['organizationId']; ?>">
        <input type="submit" value="Create Event" class="btn btn-primary">
    </form>
</body>
</html>
