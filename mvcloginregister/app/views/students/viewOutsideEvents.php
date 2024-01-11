<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 0;
        background-color: #f2f2f2;
        
    }

    h1 {
        text-align: center;
        color: black;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .btn-add-event {
        display: inline-block;
        padding: 8px 12px;
        margin-bottom: 10px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-add-event:hover {
        background-color: #0056b3;
    }

    .table-responsive-sm {
        overflow-x: auto;
    }
</style>
<head>
    <title>Unique Events</title>
</head>
<body>
    <div class="container">
        <h1>My Unique Events</h1> 
        <!--button to add new outside event-->
        <a href="<?php echo URLROOT; ?>/students/addOutsideEvent" class="btn btn-add-event">Add New Outside Event</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Event Type</th>
                                    <th>Organizer</th>
                                    <th>Approval Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['events'])) : ?>
                                    <tr>
                                        <td colspan="5">You don't have any outside event.</td>
                                    </tr>
                                <?php else : ?>
                                    <?php foreach($data['events'] as $event) : ?>
                                        <tr>
                                            <td><?php echo $event->OEventName; ?></td>
                                            <td><?php 
                                                switch ($event->OEventType) {
                                                    case 1:
                                                        echo 'Workshop';
                                                        break;
                                                    case 2:
                                                        echo 'Seminar';
                                                        break;
                                                    case 3:
                                                        echo 'Conference';
                                                        break;
                                                    case 4:
                                                        echo 'Competition';
                                                        break;
                                                    case 5:
                                                        echo 'Other';
                                                        break;
                                                    default:
                                                        echo 'Unknown';
                                                        break;
                                                }
                                            ?></td>
                                            <td><?php echo $event->OOrganization; ?></td>
                                            <td><?php 
                                                switch ($event->approvalStatus) {
                                                    case 0:
                                                        echo 'Pending';
                                                        break;
                                                    case 1:
                                                        echo 'Approved';
                                                        break;
                                                    case 2:
                                                        echo 'Rejected';
                                                        break;
                                                    default:
                                                        echo 'Unknown';
                                                        break;
                                                }
                                            ?></td>
                                            <?php if ($event->approvalStatus == 2) : ?>
                                                <td><a href="<?php echo URLROOT; ?>/students/updateOutsideEvent/<?php echo $event->OEventID; ?>">Update</a></td>
                                            <?php else : ?>
                                                <td><a href="<?php echo URLROOT; ?>/students/viewOutsideEvent/<?php echo $event->OEventID; ?>">View</a></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
