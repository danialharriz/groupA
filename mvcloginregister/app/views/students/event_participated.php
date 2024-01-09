<?php require APPROOT . '/views/students/nav.php' ?>
<html>
    <style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    </style>
    <head>
        <title><?php echo $data['title']; ?></title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    </head>
    <body>
        <h1><?php echo $data['title']; ?></h1>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Description</th>
                <th>Start Date and Time</th>
                <th>End Date and Time</th>
                <th>Location</th>
                <th>Type</th>
                <th>Organizer</th>
                <th>View</th>
            </tr>
            <?php foreach ($data['events'] as $event) : ?>
                <tr>
                    <td><?php echo $event->event_details->EventName; ?></td>
                    <td><?php echo $event->event_details->Description; ?></td>
                    <td><?php echo $event->event_details->StartDateAndTime; ?></td>
                    <td><?php echo $event->event_details->EndDateAndTime; ?></td>
                    <td><?php echo $event->event_details->Location; ?></td>
                    <td><?php 
                        if ($event->event_details->EventType == 1) {
                            echo 'Workshop';
                        } elseif ($event->event_details->EventType == 2) {
                            echo 'Seminar';
                        } elseif ($event->event_details->EventType == 3) {
                            echo 'Conference';
                        } elseif ($event->event_details->EventType == 4) {
                            echo 'Competition';
                        } elseif ($event->event_details->EventType == 5) {
                            echo 'Other';
                        } else {
                            echo 'Unknown';
                        }
                    ?></td>
                    <td><?php echo $event->organization_name; ?></td>
                    <td><a href="<?php echo URLROOT; ?>/students/view_event/<?php echo $event->event_details->EventID; ?>">View</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>