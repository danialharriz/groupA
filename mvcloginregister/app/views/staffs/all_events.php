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
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .button {
            background-color: #4caf50;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }

        .button.edit {
            background-color: #2196f3;
        }

        .button.delete {
            background-color: #f44336;
        }

        .button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Optional: Add some styling for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
    <head>
        <title>Events</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/all_events.css">
    </head>
    <body>
        <div class="container">
            <h1>Events</h1>
            <!--add event button-->
            <button class="button" onclick="location.href='<?php echo URLROOT; ?>/staffs/create_event'">Add New Event</button>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Location</th>
                        <th>Organizer</th>
                        <th>Participants</th>
                        <th>Feedbacks</th>
                        <th>Actions</th>
                    </tr>
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
                            <td><?php echo $event->OrganizationName; ?></td>
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
                </table>
            </div>
        </div>
    </body>
</html>
