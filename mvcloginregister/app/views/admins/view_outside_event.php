<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
    <head>
        <title>View Outside Event</title>
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

            .button {
                background-color: #4caf50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .button.delete {
                background-color: #f44336;
            }

            .button:hover {
                background-color: #45a049;
            }

            .button.delete:hover {
                background-color: #d32f2f;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>View Outside Event</h1>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <td><?php echo $data['outsideEvent']->OEventName; ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo $data['outsideEvent']->ODescription; ?></td>
                    </tr>
                    <tr>
                        <th>Start Date and Time</th>
                        <td><?php echo $data['outsideEvent']->OStartDateAndTime; ?></td>
                    </tr>
                    <tr>
                        <th>End Date and Time</th>
                        <td><?php echo $data['outsideEvent']->OEndDateAndTime; ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $data['outsideEvent']->OLocation; ?></td>
                    </tr>
                    <tr>
                        <th>Event Type</th>
                        <td><?php
                            if ($data['outsideEvent']->OEventType == 1) {
                                echo 'Workshop';
                            } else if ($data['outsideEvent']->OEventType == 2) {
                                echo 'Seminar';
                            } else if ($data['outsideEvent']->OEventType == 3) {
                                echo 'Conference';
                            } else if ($data['outsideEvent']->OEventType == 4) {
                                echo 'Competition';
                            } else if ($data['outsideEvent']->OEventType == 5) {
                                echo 'Others';
                            } else {
                                echo 'Unknown';
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <th>Organizer</th>
                        <td><?php echo $data['outsideEvent']->OOrganization; ?></td>
                    </tr>
                    <tr>
                        <th>Reference</th>
                        <td><?php echo $data['outsideEvent']->reference; ?></td>
                    <tr>
                        <th>Request By</th>
                        <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $data['outsideEvent']->studentID; ?>"><?php echo $data['user']->Name; ?></a></td>
                    </tr>
                </table>
                <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/approve_outside_event/<?php echo $data['outsideEvent']->OEventID; ?>'">Approve</button>
                <button class="button delete" onclick="location.href='<?php echo URLROOT; ?>/admins/reject_outside_event/<?php echo $data['outsideEvent']->OEventID; ?>'">Reject</button>
            </div>
        </div>
    </body>
</html>

