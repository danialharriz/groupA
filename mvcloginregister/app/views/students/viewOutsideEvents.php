<html>
<style>
        <style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
    }

    .container {
        margin: 20px auto;
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

    .table-responsive-sm {
        overflow-x: auto;
    }
</style>

</style>
<head>
    <title><?php echo $data['title']; ?></title>
</head>
<body>
    <h1><?php echo $data['title']; ?></h1> 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Event Type</th>
                                <th>Organizer</th>
                                <th>Approval Status</th>
                                <th>Action</Details>
                            </tr>
                        </thead>
                        <tbody>
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
                                        <td><a href="<?php echo URLROOT; ?>/students/UpdateOutsideEvent/<?php echo $event->OEventID; ?>">Update</a></td>
                                    <?php else : ?>
                                        <td><a href="<?php echo URLROOT; ?>/students/OutsideEvent/<?php echo $event->OEventID; ?>">View</a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>