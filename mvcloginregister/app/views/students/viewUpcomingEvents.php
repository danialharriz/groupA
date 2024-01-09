<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<style>
    .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
}

.table-container {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
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
    <div class="container">
        <h1>Upcoming Events</h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Type</th>
                    <th>Event Start</th>
                    <th>Event End</th>
                    <th>Organizer</th>
                    <th>Action</th>
                </tr>
                    <?php if (empty($data['events'])) : ?>
                        <p>There are no upcoming events.</p>
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
                                <td><?php echo $event->organizationName; ?></td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/students/view_event/<?php echo $event->EventID; ?>">More Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </table>
        </div>
    </div>

