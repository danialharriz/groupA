<?php require APPROOT . '/views/staffs/nav.php'; ?>
<!DOCTYPE html>
<html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

form {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: black;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #495057;
}

input[type="text"],
input[type="datetime-local"],
select,
textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    margin-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

textarea {
    resize: vertical;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.invalid-feedback {
    color: #dc3545;
    display: block;
    margin-top: 5px;
}


</style>
<head>
    <title>Create Event</title>
</head>
<body>
    <form action="<?php echo URLROOT; ?>/staffs/create_event" enctype="multipart/form-data" method="POST">
        <h1>Create Event</h1>
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
                <option value="" selected disabled>Select an Event Type</option>
                <option value="1" <?php echo ($data['eventType'] == 1) ? 'selected' : ''; ?>>Workshop</option>
                <option value="2" <?php echo ($data['eventType'] == 2) ? 'selected' : ''; ?>>Seminar</option>
                <option value="3" <?php echo ($data['eventType'] == 3) ? 'selected' : ''; ?>>Conference</option>
                <option value="4" <?php echo ($data['eventType'] == 4) ? 'selected' : ''; ?>>Competition</option>
                <option value="5" <?php echo ($data['eventType'] == 5) ? 'selected' : ''; ?>>Other</option>
            </select>
            <span class="invalid-feedback"><?php echo $data['event_type_err']; ?></span>
        </div>
        <!--deadline-->
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control <?php echo (!empty($data['deadline_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['deadline']; ?>">
            <span class="invalid-feedback"><?php echo $data['deadline_err']; ?></span>
        </div>
        <!--Max participants-->
        <div class="form-group">
            <label for="max_participant">Max Participants</label>
            <input type="number" name="max_participant" class="form-control <?php echo (!empty($data['max_participant_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['maxParticipant']; ?>">
            <span class="invalid-feedback"><?php echo $data['max_participant_err']; ?></span>
        </div>
        <!--upload picture-->
        <!-- File upload field -->
        <div class="form-group">
            <label for="image">Upload Picture</label>
            <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg">
        </div>

        <input type="hidden" name="organization_id" value="<?php echo $data['organizationId']; ?>">
        <input type="submit" value="Create Event" class="btn btn-primary">
    </form>
</body>
</html>
