<?php require APPROOT . '/views/staffs/nav.php' ?>
<html>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    .container {
        width: 80%;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
    }

    h1 {
        text-align: center;
        color: #FCBD32;
    }

    .button-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .button {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
    }

    .button.edit {
        background-color: #007bff;
        color: #fff;
    }

    .button.edit:hover {
        background-color: #0056b3;
    }

    .button.delete {
        color: #ff8080;
    }

    .button.delete:hover {
        background-color: #EE2E2E;
    }

    button.add {
        background-color: #239B56;
        color: #fff;
    }

    button.add:hover {
        background-color: #9FE2BF;
    }

    .table-container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #183D64;
        color: #FCBD32;
    }

    /* Optional: Add some styling for better readability */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e5e5e5;
    }

    /* Edit and Delete button styling */
    .button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Icons styling */
    .icon {
        font-size: 18px;
        margin-right: 5px;
    }

    .icon-edit {
        color: #007bff;
    }

    .icon-delete {
        color: #EE2E2E;
    }
    
    .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        color: #fff;
    }

    .card h1 {
        color: #007BFF;
        font-size: 36px;
        margin-top: 10px;
    }

    /* Style for icons */
    i {
        margin-right: 5px;
    }
    </style>
    <head>
        <title>Events</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/all_events.css">
    </head>
    <body>
        <div class="container">
            <table class="summary-table">
                <th style = "background-color: #FCBD32;">
                    <div class="card" style="background-color: #7C1C2B;">
                        <h3>Total Event</h3>
                        <h1><?php echo $data['totalEvent']; ?></h1>
                    </div>
                </th>
            </table>
        </div>
        <div class="container">
            <h1>Events</h1>
            <!--add event button-->
            <form action="<?php echo URLROOT; ?>/staffs/index" method="POST">
                <div class="button-container">
                    <input type="text" placeholder="Search by event name or organizer" name="search">
                    <button type="submit" class="button"><i class="fas fa-search icon"></i> Search</button>
                    <a href="<?php echo URLROOT; ?>/staffs/create_event"><button type="button" class="button add"><i class="fas fa-plus icon"></i> Add Event</button></a>
                </div>
            </form>

            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Location</th>
                        <th>Participants</th>
                        <th>Feedbacks</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($data['events'])) : ?>
                        <tr>
                            <td colspan="9">No events available</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach($data['events'] as $event) : ?>
                            <tr>
                                <td><?php echo $event->EventName; ?></td>
                                <td><?php 
                                    if ($event->EventType == 1) {
                                        echo 'Workshop';
                                    } elseif ($event->EventType == 2) {
                                        echo 'Seminar';
                                    } elseif ($event->EventType == 3) {
                                        echo 'Conference';
                                    } elseif ($event->EventType == 4) {
                                        echo 'Competition';
                                    } elseif ($event->EventType == 5) {
                                        echo 'Other';
                                    } else {
                                        echo 'Unknown';
                                    }
                                ?></td>
                                <td><?php echo $event->StartDateAndTime; ?></td>
                                <td><?php echo $event->EndDateAndTime; ?></td>
                                <td><?php echo $event->Location; ?></td>
                                <td>
                                    <button class="button" onclick="location.href='<?php echo URLROOT; ?>/staffs/show_participants/<?php echo $event->EventID; ?>'">Show Participants</button>
                                </td>
                                <td>
                                    <?php if ($event->EndDateAndTime < date('Y-m-d H:i:s')) : ?>
                                        <button class="button" onclick="location.href='<?php echo URLROOT; ?>/staffs/feedback/<?php echo $event->EventID; ?>'">Show Feedbacks</button>
                                    <?php else : ?>
                                        <button class="button" disabled>Unavailable</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="button edit" onclick="location.href='<?php echo URLROOT; ?>/staffs/update_event/<?php echo $event->EventID; ?>'">View</button>
                                    <!--confirmation box for delete-->
                                    <button class="button delete" onclick="if (confirm('Are you sure you want to delete this event?')) location.href='<?php echo URLROOT; ?>/staffs/delete_event/<?php echo $event->EventID; ?>'">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>