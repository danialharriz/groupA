<?php require APPROOT . '/views/admins/nav.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/student.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css">
</head>

<body>
    <!-- Name Card Style -->
    <div class="name-card">
        <div class="upload">
            <?php if($data['student']->User->profilePic != null) : ?>
                <img src="<?php echo URLROOT."/public/".$data['student']->User->profilePic; ?>" alt="profile picture">
            <?php else : ?>
                <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" alt="profile picture">
            <?php endif; ?>
        </div>
        <div class="info">
            <h1><?php echo $data['student']->User->Name; ?></h1>
            <hr>
            <h3>Organization: <?php echo $data['student']->Organization->OrganizationName; ?></h3>
            <h3>Course: <?php echo $data['student']->CourseID; ?></h3>
            <h3>Email: <?php echo $data['student']->User->Email; ?></h3>
            <h3>Phone: <?php echo $data['student']->User->Phone; ?></h3>
        </div>
        <button class="back-button" onclick="window.history.back()"><i class="bi bi-arrow-left"></i> Back</button>
    </div>
</body>

<style>
    /* student.css */

    body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

    .name-card {
        width: 500px;
        margin: 20px auto;
        background-color: #FCBD32;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .upload img {
        width: 100%;
        height: auto;
        border-radius: 8px 8px 0 0;
        display: block;
    }

    h1 {
        text-align: center;
        color: #007bff;
        margin: 10px 0;
    }

    hr {
        border: 1px solid #ddd;
        margin: 10px 0;
    }

    .info {
        padding: 20px;
    }

    h3 {
        margin: 10px 0;
        color: #333;
    }

    .back-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 0 0 8px 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #0056b3;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .name-card {
            width: 80%;
        }
    }
</style>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
