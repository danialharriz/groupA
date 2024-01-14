<?php require APPROOT . '/views/students/nav.php' ?>
<html>
    <head>
        <title><?php echo $data['title']; ?></title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            .container12 {
                width: 80%;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #FCBD32;
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
                color: #333;
            }

            th {
                background-color: #FCBD32;
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

            /* Search bar styles */
            form {
                margin-top: 20px;
                display: flex;
                align-items: center;
            }

            #search {
                flex: 1;
                padding: 8px;
                margin-right: 10px;
            }

            button {
                background-color: #7C1C2B;
                color: #fff;
                padding: 8px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover {
                background-color: #4c0f1a;
            }

            /* Icon styles */
            .icon {
                margin-right: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container12">
            <h1><?php echo $data['title']; ?></h1>
            <!-- Search bar -->
            <form action="<?php echo URLROOT; ?>/students/event_participated" method="post">
                <input type="text" id="search" name="search" placeholder="Search for event name or organization name...">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Start Date and Time</th>
                    <th>End Date and Time</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Organizer</th>
                    <th>View</th>
                </tr>
                <?php if (empty($data['events'])) : ?>
                    <tr>
                        <td colspan="8">No events found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['events'] as $event) : ?>
                        <tr>
                            <td><?php echo $event->event_details->EventName; ?></td>
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
                            <td><a href="<?php echo URLROOT; ?>/students/org/<?php echo $event->organization->OrganizationID; ?>"><?php echo $event->organization->OrganizationName; ?></a></td>
                            <td><a href="<?php echo URLROOT; ?>/students/view_event/<?php echo $event->event_details->EventID; ?>"><span class="icon">👁️</span>View</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
