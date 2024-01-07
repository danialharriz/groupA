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
                        <td><?php echo $data['eventName']; ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo $data['description']; ?></td>
                    </tr>
                    <tr>
                        <th>Start Date and Time</th>
                        <td><?php echo $data['startDateAndTime']; ?></td>
                    </tr>
                    <tr>
                        <th>End Date and Time</th>
                        <td><?php echo $data['endDateAndTime']; ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $data['location']; ?></td>
                    </tr>
                    <tr>
                        <th>Event Type</th>
                        <td><?php echo $data['eventType']; ?></td>
                    </tr>
                    <tr>
                        <th>Organizer</th>
                        <td><?php echo $data['organization']; ?></td>
                    </tr>
                    <tr>
                        <th>Request By</th>
                        <td><?php echo $data['user']->Name; ?></td>
                    </tr>
                </table>
                <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/approve_outside_event/<?php echo $data['eventId']; ?>'">Approve</button>
                <button class="button delete" onclick="location.href='<?php echo URLROOT; ?>/admins/reject_outside_event/<?php echo $data['eventId']; ?>'">Reject</button>
            </div>
        </div>
    </body>
</html>

