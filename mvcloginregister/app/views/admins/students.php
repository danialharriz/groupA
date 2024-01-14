<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Students</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/students.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css">
</head>

<body>
    <h1>Students List</h1>
    <h3>Organization: <?php echo $data['organization']->OrganizationName; ?></h3>
    <!-- search bar -->
    <form action="<?php echo URLROOT; ?>/admins/students/<?php echo $data['organization']->OrganizationID; ?>" method="POST">
        <div style="text-align: center;">    
            <input type="text" name="search" placeholder="Search by name, email, phone, or course" class="search-input">
            <button type="submit" name="submit-search" class="search-button"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
        </tr>
        <?php if (empty($data['students'])) : ?>
            <tr>
                <td colspan="4">No students available.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($data['students'] as $student) : ?>
                <tr>
                    <td><a href="<?php echo URLROOT; ?>/admins/student/<?php echo $student->StudentID; ?>"><?php echo $student->User->Name; ?></a></td> 
                    <td><?php echo $student->User->Email; ?></td>
                    <td><?php echo $student->User->Phone; ?></td>
                    <td><?php echo $student->CourseID; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div style="text-align: center;">
        <button onclick="goBack()" class="back-button"><i class="bi bi-arrow-left"></i> Back</button>
    </div>
</body>

<script>
    function goBack() {
        history.back();
    }
</script>

<style>
    /* students.css */

    body {
            background-color: #f8f8f8;
            margin: 0;
            font-family: Arial, sans-serif;
        }

    h1, h3 {
        text-align: center;
    }

    h1 {
        color: #FCBD32;
    }

    h3 {
        margin-top: 10px;
        color: #333;
    }

    .search-input {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 300px;
    }

    .search-button {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-button:hover {
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
        background-color: #7C1C2B;
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

    .back-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
</style>

<?php require APPROOT . '/views/includes/footer.php'; ?>
</html>
