<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .feedback {
            text-align: center;
        }

        h1 {
            color: #333;
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

        /* Optional: Add some styling for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }
    </style>
    <head>
        <title>Feedback</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/feedback.css">
    </head>
    <body>
        <div class="container">
            <div class="feedback">
                <h1>Feedback</h1>
                <h2>Event: <?php echo $data['event']->EventName; ?></h2>
                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Submitted Time</th>
                        <th>Feedback</th>
                    </tr>
                    <?php foreach($data['feedbacks'] as $feedback): ?>
                        <tr>
                            <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $feedback->Student->StudentID; ?>"><?php echo $feedback->User->Name; ?></a></td>
                            <td><?php echo $feedback->SubmittedDateAndTime; ?></td>
                            <td><?php echo $feedback->Feedback; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/all_events'">Back</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>