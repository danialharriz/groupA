<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<style>
.container1 {
    max-width: 1200px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Updated class name to summary-table */
table.summary-table {
    width: 100%;
    margin-top: 20px;
}

/* Updated class name to summary-table */
.summary-table th {
    padding: 12px;
    text-align: left;
}

.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card h3 {
    color: #333;
    margin-bottom: 10px;
}

.card h1 {
    color: #007BFF;
    font-size: 36px;
    margin-top: 10px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* Updated class name to event-table */
table.event-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

/* Updated class name to event-table */
.event-table th, .event-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Updated class name to event-table */
.event-table th {
    background-color: #f2f2f2;
    color: #333;
}

/* Updated class name to event-table */
.event-table tr:hover {
    background-color: #f5f5f5;
}

a {
    color: #337ab7;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}


</style>
<head>
    <title>Upcoming Events</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>
<body>
    <div class = "container1">
        <table class = "summary table">
            <th>
                <div class = "card">
                    <h3>Total event joined</h3>
                    <h1><?php echo $data['eventparticipatedcount']; ?></h1>
                </div>
            </th>
            <th>
                <div class = "card">
                    <?php if (!empty($data['reward'])) : ?>
                        <h3>Title</h3>
                        <h1><?php echo $data['reward']->RewardName ?></h1>
                    <?php endif; ?>
                </div>
            </th>
        </table>
    </div>
    <div class="container1">
        <h1>Upcoming Events</h1>
        <table class="event-table">
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
                    <?php foreach($data['events'] as $event) : ?>
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
                                <a href="<?php echo URLROOT; ?>/students/view_event/<?php echo $event->EventID; ?>">More Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
        </table>
    </div>
</body>
</html>