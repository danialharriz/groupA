<html>
    <head>
        <title>Events</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }
            
            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            
            h1 {
                text-align: center;
                margin-bottom: 20px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            tr:hover {
                background-color: #f5f5f5;
            }
            
            a {
                text-decoration: none;
                color: #333;
                margin-right: 10px;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .button {
                display: inline-block;
                padding: 8px 12px;
                background-color: #4CAF50; /* Edited color */
                color: #fff;
                border: none;
                text-align: center;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            
            .button:hover {
                background-color: #4CAF50; /* Edited color */
            }
            
            .button.delete {
                background-color: #FF0000; /* Red color */
            }
            
            .button.edit {
                background-color: #0000FF; /* Blue color */
            }
        </style>
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
