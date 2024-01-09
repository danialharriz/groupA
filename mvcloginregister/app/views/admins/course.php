<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
<style>
    /* admins/course.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

button {
    background-color: #4caf50;
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
    background-color: #45a049;
}

form {
    margin-top: 20px;
}

/* Add additional styling as needed */

</style>
<head>
    <title>Course</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/course.css">
</head>
<body>
    <div class="container">
        <h1>Course</h1>
        <table>
            <tr>
                <th>Course Name</th>
                <th>Organization</th>
                <th>Action</th>
                <th></th>
            </tr>
            <?php foreach($data['courses'] as $course): ?>
                <tr>
                    <td><?php echo $course->CourseName; ?></td>
                    <td><a href="<?php echo URLROOT; ?>/admins/org/<?php echo $course->Organization->OrganizationID; ?>"><?php echo $course->Organization->OrganizationName; ?></a></td>
                    <td>
                        <button onclick="deleteCourse('<?php echo URLROOT; ?>/admins/delete_course/<?php echo $course->CourseID; ?>')">Delete</button>
                        <script>
                            function deleteCourse(url) {
                                window.location.href = url;
                            }
                        </script>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form action="<?php echo URLROOT; ?>/admins/register_course" method="GET">
            <button type="submit">Register Course</button>
        </form>
    </div>
</body>
</html>