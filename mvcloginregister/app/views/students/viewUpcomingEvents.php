<?php require APPROOT . '/views/students/nav.php' ?>
<html>
    <head>
        <title>Upcoming Events</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 0;
                background-color: #f2f2f2;
            }

            .container {
                max-width: 1200px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .table-container {
                margin-top: 20px;
                overflow-x: auto;
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
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            .button {
                display: inline-block;
                padding: 8px 12px;
                margin: 5px;
                font-size: 14px;
                text-align: center;
                text-decoration: none;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Upcoming Events</h1>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>Organizer</th>
                        <th>Action</th>
                    </tr>
                    <?php if (empty($data['events'])) : ?>
                        <tr>
                            <td colspan="6">No upcoming events</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['events'] as $event) : ?>
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
                                <td><a href="<?php echo URLROOT; ?>/students/org/<?php echo $event->organization->OrganizationID; ?>"><?php echo $event->organization->OrganizationName; ?></a></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/students/view_event/<?php echo $event->EventID; ?>" class="button">More Detail</a>
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