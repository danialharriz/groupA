<html>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f3f3f3;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tr:hover {
        background-color: #e6f7ff;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
        margin-right: 5px;
    }

    button.edit {
        background-color: #28a745;
    }

    button.delete {
        background-color: #dc3545;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
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
            <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/create_event'">Add New Event</button>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Event End Time</th>
                        <th>Organizer</th>
                        <th>Participants</th>
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
                                <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/show_participants/<?php echo $event->EventID; ?>'">Show Participants</button>
                            </td>
                            <td>
                                <button class="button edit" onclick="location.href='<?php echo URLROOT; ?>/admins/update_event/<?php echo $event->EventID; ?>'">View</button>
                                <!--confirmation box for delete-->
                                <button class="button delete" onclick="if (confirm('Are you sure you want to delete this event?')) location.href='<?php echo URLROOT; ?>/admins/delete_event/<?php echo $event->EventID; ?>'">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>
