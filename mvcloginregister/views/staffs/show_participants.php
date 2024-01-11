<?php require APPROOT . '/views/staffs/nav.php' ?>
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

        h1 {
            text-align: center;
            color: #333;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin: 0;
        }

        input[type="submit"] {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
    </style>
    <head>
        <title>Participants</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/show_participants.css">
    </head>
    <body>
        <div class="container">
            <h1>Participants</h1>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($data['participants'])) : ?>
                        <tr>
                            <td colspan="4">No participants found.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach($data['participants'] as $participant) : ?>
                            <tr>
                                <td><a href="<?php echo URLROOT; ?>/staffs/student/<?php echo $participant->student->StudentID; ?>"><?php echo $participant->User->Name; ?></a></td>
                                <td><?php echo $participant->User->Email; ?></td>
                                <td>
                                    <form action="<?php echo URLROOT; ?>/staffs/delete_participant/<?php echo $participant->ParticipantID; ?>" method="post">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </body>
</html>