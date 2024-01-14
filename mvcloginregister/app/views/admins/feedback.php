<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/feedback.css">
    <style>
        body {
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
            color: #FCBD32;
        }

        h2 {
            color: #7C1C2B;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #FCBD32;
            color: #183D64;
        }

        /* Optional: Add some styling for better readability */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        /* Style for the back button */
        .button {
            background-color: #7C1C2B;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #630E25;
        }

        /* Style for icons */
        i {
            margin-right: 5px;
        }
    </style>
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
                <?php if (empty($data['feedbacks'])): ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No feedbacks available</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['feedbacks'] as $feedback): ?>
                        <tr>
                            <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $feedback->Student->StudentID; ?>"><?php echo $feedback->User->Name; ?></a></td>
                            <td><?php echo $feedback->SubmittedDateAndTime; ?></td>
                            <td><?php echo $feedback->Feedback; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <!-- Adding the icon to the button -->
                        <button class="button" onclick="location.href='<?php echo URLROOT; ?>/admins/all_events'"><i class="fas fa-arrow-left"></i> Back</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
