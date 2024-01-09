<?php
/*
    public function students(){
        $url = $this->getUrl();
        $organizationId = $url[2];
        $students = $this->studentModel->getStudentByOrganizationId($organizationId);
        foreach($students as $student){
            $student->User = $this->userModel->getUserById($student->UserID);
        }
        $data = [
            'students' => $students,
        ];
        $this->view('admins/students', $data);
    }
    */
?>

<?php
    require APPROOT . '/views/admins/nav.php';
?>
<htnl>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/students.css">
</head>
<body>
    <h1>Students List</h1>
    <h3>Organization: <?php echo $data['organization']->OrganizationName; ?></h3>
    <a href="<?php echo URLROOT; ?>/admins/register_student/<?php echo $data['organization']->OrganizationID; ?>" class="button">Add Student</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
        </tr>
        <?php foreach ($data['students'] as $student) : ?>
            <tr>
                <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $student->StudentID; ?>"><?php echo $student->User->Name; ?></a></td> 
                <td><?php echo $student->User->Email; ?></td>
                <td><?php echo $student->User->Phone; ?></td>
                <td><?php echo $student->CourseID; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
<style>
    /* students.css */
    /* students.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #007bff;
}

h3 {
    text-align: center;
    margin-top: 10px;
    color: #333;
}

.button {
    display: block;
    width: 120px;
    margin: 20px auto;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border-radius: 5px;
}

.button:hover {
    background-color: #0056b3;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #007bff;
    color: #fff;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}

</style>
</html>