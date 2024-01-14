<?php require APPROOT . '/views/admins/nav.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <

    <style>


        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #183D64; /* Dark blue color */
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #FCBD32; /* Dark yellow color */
            color: #183D64; /* Dark blue color */
        }

        button {
            background-color: #7C1C2B; /* Dark red color */
            color: #fff;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 5px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #5C1521; /* Lighter shade on hover */
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        .button.register-button {
            background-color: #007bff; /* Dark blue color */
            color: #fff;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 5px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button.register-button:hover {
            background-color: #0056b3; /* Lighter shade on hover */
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .invalidFeedback {
            color: #7C1C2B; /* Dark red color */
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Course</h1>
        <form action="<?php echo URLROOT; ?>/admins/course" method="POST">
            <input type="text" name="search" placeholder="Search">
            <button type="submit"><i class="uil uil-search"></i></button>
        </form>
        <table>
            <tr>
                <th>Course Name</th>
                <th>Institute</th>
                <th>Action</th>
                <th></th>
            </tr>

            <!-- Add course form -->
            <form action="<?php echo URLROOT; ?>/admins/course" method="POST">
                <td>
                    <input type="text" name="courseName" placeholder="Course Name">
                    <span class="invalidFeedback"><?php echo $data['courseNameError']; ?></span>
                </td>
                <td>
                    <select name="organizationId" id="organizationId">
                        <option value="" selected disabled>Select an Institute</option>
                        <?php foreach ($data['organizations'] as $organization) : ?>
                            <option value="<?php echo $organization->OrganizationID; ?>"><?php echo $organization->OrganizationName; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="invalidFeedback"><?php echo $data['organizationIdError']; ?></span>
                </td>
                <td>
                    <button type="submit" name="addCourse"><i class="uil uil-plus"></i></button>
                </td>
            </form>

            <!-- Course entries -->
            <?php if (empty($data['courses'])) : ?>
                <tr>
                    <td colspan="4">No courses available</td>
                </tr>
            <?php else : ?>
                <?php foreach ($data['courses'] as $course) : ?>
                    <tr>
                        <td><?php echo $course->CourseName; ?></td>
                        <td><a href="<?php echo URLROOT; ?>/admins/org/<?php echo $course->Organization->OrganizationID; ?>"><?php echo $course->Organization->OrganizationName; ?></a></td>
                        <td>
                            <button onclick="deleteCourse('<?php echo URLROOT; ?>/admins/delete_course/<?php echo $course->CourseID; ?>')">
                                <i class="uil uil-trash-alt"></i>
                            </button>
                            <script>
                                function deleteCourse(url) {
                                    window.location.href = url;
                                }
                            </script>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <br>
</body>
</html>

<?php require APPROOT . '/views/includes/footer.php'; ?>
<!DOCTYPE html>