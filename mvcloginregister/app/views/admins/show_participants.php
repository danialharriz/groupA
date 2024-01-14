<?php require APPROOT . '/views/admins/nav.php'; ?>

<html>
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
            background-color: #FCBD32;
            color: #183D64;
        }

        form {
            margin: 0;
        }

        input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #183D64;
            color: #FCBD32;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #7C1C2B;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #7C1C2B;
            color: #FCBD32;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #5C1521;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <head>
        <title>Participants</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/show_participants.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <h1>Participants</h1>
            <!-- search bar -->
        <!--    <form id="searchForm" method="post" action="">
                <input type="text" name="search" placeholder="Search">
                <input type="submit" name="submit-search" value="Search">
            </form>

            <script>
                document.getElementById('searchForm').addEventListener('submit', function (e) {
                    e.preventDefault(); // Prevent the default form submission
                    var searchValue = document.getElementsByName('search')[0].value;
                    var currentUrl = window.location.href;
                    var newUrl = currentUrl + (currentUrl.includes('?') ? '&' : '?') + 'search=' + encodeURIComponent(searchValue);
                    window.history.pushState({path: newUrl}, '', newUrl);

                    // Now you can submit the form programmatically
                    e.currentTarget.submit();
                });
            </script>-->
            <div class="table-container">
                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Organization</th>
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
                                <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $participant->Student->StudentID; ?>"><?php echo $participant->User->Name; ?></a></td>
                                <td><?php echo $participant->Organization->OrganizationName; ?></td>
                                <td><?php echo $participant->User->Email; ?></td>
                                <td>
                                    <form action="<?php echo URLROOT; ?>/admins/delete_participant/<?php echo $participant->ParticipantID; ?>" method="post">
                                        <button type="submit" style="background-color: #FCBD32; color: #183D64;"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
                <!-- back button -->
                <div class="button-container">
                    <a class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
                <script>
                    function goBack() {
                        history.back();
                    }
                </script>
            </div>
        </div>
    </body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
