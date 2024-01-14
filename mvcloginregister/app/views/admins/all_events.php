<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
<style>
    .container {
        width: 80%;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #FCBD32;
    }

    .button-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .button {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
    }

    .button.edit {
        background-color: #007bff;
        color: #fff;
    }

    .button.edit:hover {
        background-color: #0056b3;
    }

    .button.delete {
        color: #ff8080;
    }

    .button.delete:hover {
        background-color: #EE2E2E;
    }

    button.add {
        background-color: #239B56;
        color: #fff;
    }

    button.add:hover {
        background-color: #9FE2BF;
    }

    .table-container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #183D64;
        color: #FCBD32;
    }

    /* Optional: Add some styling for better readability */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e5e5e5;
    }

    /* Edit and Delete button styling */
    .button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    /* Icons styling */
    .icon {
        font-size: 18px;
        margin-right: 5px;
    }

    .icon-edit {
        color: #007bff;
    }

    .icon-delete {
        color: #EE2E2E;
    }
</style>

<head>
    <title>Events</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>

<body>
    <div class="container">
        <h1>Events</h1>
        <!-- Search bar -->
        <form action="<?php echo URLROOT; ?>/admins/all_events" method="POST">
            <div class="button-container">
                <input type="text" placeholder="Search by event name or organizer" name="search">
                <button type="submit" class="button"><i class="fas fa-search icon"></i> Search</button>
                <a href="<?php echo URLROOT; ?>/admins/create_event"><button type="button" class="button add"><i class="fas fa-plus icon"></i>Add Event</button></a>
            </div>
        </form>

        <!-- Add event button -->
        <div class="table-container">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Type</th>
                    <th>Event Start</th>
                    <th>Event End</th>
                    <th>Location</th>
                    <th>Organizer</th>
                    <th>Participants</th>
                    <th>Feedbacks</th>
                    <th>Actions</th>
                </tr>
                <?php if (empty($data['events'])) : ?>
                    <tr>
                        <td colspan="9">No events available</td>
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
                            <td><?php echo $event->Location; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/admins/org/<?php echo $event->Organization->OrganizationID; ?>"><?php echo $event->Organization->OrganizationName; ?></a></td>
                            <td>
                                <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/show_participants/<?php echo $event->EventID; ?>'"><i class="fas fa-users icon"></i> Participants</button>
                            </td>
                            <td>
                                <?php if ($event->EndDateAndTime < date('Y-m-d H:i:s')) : ?>
                                    <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/feedback/<?php echo $event->EventID; ?>'"><i class="fas fa-comment-alt-lines icon"></i> Feedbacks</button>
                                <?php else : ?>
                                    <button class="button" disabled><i class="fas fa-lock-alt icon"></i> Unavailable</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="button edit" onclick="location.href='<?php echo URLROOT; ?>/admins/update_event/<?php echo $event->EventID; ?>'"><i class="fas fa-edit"></i> </button>
                                <button class="button delete" onclick="if (confirm('Are you sure you want to delete this event?')) location.href='<?php echo URLROOT; ?>/admins/delete_event/<?php echo $event->EventID; ?>'"><i class="fas fa-trash-alt"></i> </button>
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
