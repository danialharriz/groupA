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
    border: 1px solid #ccc;
}

th {
    background-color: #f2f2f2;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
<head>
    <!--event name-->
    <title><?php echo $data['event']->EventName; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $data['event']->EventName; ?></h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Event Name</th>
                    <td><?php echo $data['event']->EventName; ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $data['event']->Description; ?></td>
                </tr>
                <tr>
                    <th>Start Date and Time</th>
                    <td><?php echo $data['event']->StartDateAndTime; ?></td>
                </tr>
                <tr>
                    <th>End Date and Time</th>
                    <td><?php echo $data['event']->EndDateAndTime; ?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?php echo $data['event']->Location; ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?php 
                        if ($data['event']->EventType == 1) {
                            echo 'Workshop';
                        } elseif ($data['event']->EventType == 2) {
                            echo 'Seminar';
                        } elseif ($data['event']->EventType == 3) {
                            echo 'Conference';
                        } elseif ($data['event']->EventType == 4) {
                            echo 'Competition';
                        } elseif ($data['event']->EventType == 5) {
                            echo 'Other';
                        } else {
                            echo 'Unknown';
                        }
                    ?></td>
                </tr>
                <tr>
                    <th>Organizer</th>
                    <td><?php echo $data['event']->organization_name; ?></td>
                </tr>
                <!-- if $data['event']->canparticipated true, show participate button, if['$data']->cancancel, show cancel participant button, if $data['event']->canfeedback true, show feedback button -->
                <?php if ($data['event']->canparticipate == true) : ?>
                    <tr>
                        <td colspan="2">
                            <form action="<?php echo URLROOT; ?>/students/participate/<?php echo $data['event']->EventID; ?>" method="post">
                                <input type="submit" value="Participate">
                            </form>
                        </td>
                    </tr>
                <?php elseif ($data['event']->cancancel == true) : ?>
                    <tr>
                        <td colspan="2">
                            <form action="<?php echo URLROOT; ?>/students/cancel_participation/<?php echo $data['event']->participant_id; ?>" method="post">
                                <input type="submit" value="Cancel Participant">
                            </form>
                        </td>
                    </tr>
                <?php elseif ($data['event']->canfeedback == true) : ?>
                    <tr>
                        <td colspan="2">
                            <form action="<?php echo URLROOT; ?>/students/feedback/<?php echo $data['event']->participant_id; ?>" method="post">
                                <input type="submit" value="Feedback">
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($data['event']->canparticipate == false && $data['event']->cancancel == false && $data['event']->canfeedback == false) : ?>
                    <tr>
                        <td colspan="2">Unavailable</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>