<?php require APPROOT . '/views/students/nav.php' ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['event']->EventName; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff; /* Updated color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #183D64; /* Updated color */
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
            background-color: #7C1C2B; /* Updated background color */
            color: #fff; /* Updated text color */
        }

        tr {
            background-color: #ffffae;
            color: #183D64;
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

        .icon {
            /* Add your icon styles here */
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
                
            </table>
            <?php if ($data['event']->canparticipate == true) : ?>
                        <form action="<?php echo URLROOT; ?>/students/participate/<?php echo $data['event']->EventID; ?>" method="post">
                            <input type="submit" value="Participate">
                        </form>
            <?php elseif ($data['event']->cancancel == true) : ?>
                        <form action="<?php echo URLROOT; ?>/students/cancel_participation/<?php echo $data['event']->participant_id; ?>" method="post">
                            <input type="submit" value="Cancel Participant">
                        </form>
            <?php elseif ($data['event']->canfeedback == true) : ?>
                    <form action="<?php echo URLROOT; ?>/students/feedback/<?php echo $data['event']->participant_id; ?>" method="get">
                        <input type="submit" value="Feedback">
                    </form>
            <?php endif; ?>
            <?php if ($data['event']->canparticipate == false && $data['event']->cancancel == false && $data['event']->canfeedback == false) : ?>
                <p>Unavalable</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>