<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
    <head>
        <title>View Outside Events</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #333;
                text-align: center;
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
            <h1>View Outside Events</h1>
            <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
            <div class="table-container">
                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>End Date and Time</th>
                        <th>Location</th>
                        <th>Event Type</th>
                        <th>Organizer</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($data['outsideEvents'])) : ?>
                        <tr>
                            <td colspan="6">No pending outside events.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach($data['outsideEvents'] as $outsideEvent) : ?>
                            <tr>
                                <td><?php echo $outsideEvent->OEventName; ?></td>
                                <td><?php echo $outsideEvent->OEndDateAndTime; ?></td>
                                <td><?php echo $outsideEvent->OLocation; ?></td>
                                <td><?php if($outsideEvent->OEventType == 1) {
                                    echo "Workshop";
                                } else if($outsideEvent->OEventType == 2) {
                                    echo "Seminar";
                                } else if($outsideEvent->OEventType == 3) {
                                    echo "Conference";
                                } else if($outsideEvent->OEventType == 4) {
                                    echo "Competition";
                                } else if($outsideEvent->OEventType == 5) {
                                    echo "Others";
                                }
                                ?></td>
                                <td><?php echo $outsideEvent->OOrganization; ?></td>
                                <td>
                                    <!-- view button -->
                                    <a href="<?php echo URLROOT; ?>/admins/view_outside_event/<?php echo $outsideEvent->OEventID; ?>" class="button">View</a>    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </body>
</html>