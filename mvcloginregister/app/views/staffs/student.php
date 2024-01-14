<?php
    require APPROOT . '/views/admins/nav.php';
?>
<htnl>
<head>
    <title>Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/student.css">
</head>
<body>
    <!--show profile picture-->
    <div class="upload">
        <?php if($data['student']->User->profilePic != null) : ?>
            <img src="<?php echo URLROOT."/public/".$data['student']->User->profilePic; ?>" alt="profile picture">
        <?php else : ?>
            <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" alt="profile picture">
        <?php endif; ?>
    <h1><?php echo $data['student']->User->Name; ?></h1>
    <hr>
    <div class="info">
        <h3>Organization: <?php echo $data['student']->Organization->OrganizationName; ?></h3>
        <h3>Course: <?php echo $data['student']->CourseID; ?></h3>
        <h3>Email: <?php echo $data['student']->User->Email; ?></h3>
        <h3>Phone: <?php echo $data['student']->User->Phone; ?></h3>
    </div>
</body>
<style>
/* student.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.upload img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 20px auto;
    display: block;
}

h1 {
    text-align: center;
    color: #007bff;
}

hr {
    border: 1px solid #ddd;
    margin: 20px 0;
}

.info {
    width: 50%;
    margin: 0 auto;
}

h3 {
    margin: 10px 0;
    color: #333;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .info {
        width: 80%;
    }
}

</style>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>