<?php require APPROOT . '/views/students/nav.php' ?>
<html>

<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 0;
        background-color: #f2f2f2;
    }

    h1 {
        text-align: center;
        color: #183D64;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
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
        background-color: #7C1C2B;
        color: #fff;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    a.button {
        display: inline-block;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin: 5px;
        cursor: pointer;
    }

    a.button.add-event {
        background-color: #183D64;
        color: #fff;
    }

    a.button.add-event:hover {
        background-color: #FCBD32;
    }

    .table-responsive-sm {
        overflow-x: auto;
    }

    .icon {
        font-size: 18px;
        margin-right: 5px;
        color: #FCBD32;
    }

    .search-bar {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .search-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-button {
        background-color: #183D64;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        margin-left: 10px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #FCBD32;
    }
</style>


    <title>Unique Events</title>
</head>

<body>
    <div class="container">
        <h1><i class="icon uil-calendar"></i>My Unique Events</h1>
        <!-- search bar -->
        <form action="<?php echo URLROOT; ?>/students/viewOutsideEvents" method="POST" class="search-bar">
            <input type="text" name="search" placeholder="Search Organization" class="search-input">
            <button type="submit" name="submit-search" class="search-button"><i class="icon uil-search"></i>Search</button>
            <a href="<?php echo URLROOT; ?>/students/addOutsideEvent" class="button add-event"><i class="icon uil-plus"></i>Add New Outside Event</a>
        </form>
        <!--button to add new outside event-->
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
                                    <?php foreach ($data['events'] as $event) : ?>
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
<?php require APPROOT . '/views/includes/footer.php'; ?>
