<?php require APPROOT . '/views/students/nav.php' ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['event']->EventName; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            display: block;
            margin: 0 auto 15px;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $data['event']->EventName; ?></h1>
        <div class="table-container">
            <table>
            <?php if(isset($data['event']->Picture)) : ?>
        <img src="<?php echo URLROOT; ?>/public/<?php echo $data['event']->Picture; ?>" alt="Event Picture">
    <?php endif; ?>
                <tr>
                    <th>Event Name</th>
                    <td><?php echo $data['event']->EventName; ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $data['event']->Description; ?></td>
                </tr>
                <tr>
                    <th>Register Deadline</th>
                    <td><?php echo $data['event']->Deadline; ?></td>
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
                    <th>Seat</th>
                    <td><?php echo $data['participantcount'];?> / <?php echo $data['event']->MaxParticipants; ?></td>
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
                    <td><a href="<?php echo URLROOT; ?>/students/org/<?php echo $data['event']->organization->OrganizationID; ?>"><?php echo $data['event']->organization->OrganizationName; ?></a></td>
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
                        <form action="<?php echo URLROOT; ?>/students/feedback/<?php echo $data['event']->participant_id; ?>" method="get">
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
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>