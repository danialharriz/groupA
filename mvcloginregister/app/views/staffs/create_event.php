<?php require APPROOT . '/views/staffs/nav.php' ?>
<html>
<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
    <link rel="stylesheet" href="styles.css">
    <style>

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
    <form action="<?php echo URLROOT; ?>/staffs/create_event" method="POST">
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
