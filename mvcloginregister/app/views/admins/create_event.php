<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
        }

        form {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: #555555;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 14px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" fill="%23555555"><polygon points="6 0 0 6 12 6"/></svg>') no-repeat right #ffffff;
            background-size: 12px;
            padding-right: 30px;
        }

        .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="<?php echo URLROOT; ?>/admins/create_event" method="POST">
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
