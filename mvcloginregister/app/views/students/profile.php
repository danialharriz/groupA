<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #183D64; /* Updated background color */
        margin: 20px;
        color: #fff; /* Updated text color */
    }

    h1 {
        color: #fff; /* Updated heading color */
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    hr {
        border: 1px solid #7C1C2B; /* Updated HR color */
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333; /* Updated label color */
    }

    input[type="text"],
    input[type="date"],
    input[type="radio"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        color: #333; /* Updated input text color */
    }

    input[type="text"]:not([disabled]),
    input[type="date"]:not([disabled]),
    input[type="radio"]:not([disabled]) {
        border-color: #FCBD32; /* Updated border color for editable fields */
    }

    input[type="text"][disabled],
    input[type="date"][disabled],
    input[type="radio"][disabled] {
        background-color: #f0f0f0;
        color: #555;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #0056b3;
    }

    .button:active {
        background-color: #004080;
    }

    .button:focus {
        outline: none;
        box-shadow: none;
    }

    .upload {
        width: 125px;
        position: relative;
        margin: auto;
        align-items: center;
    }

    .upload img {
        border-radius: 50%;
        border: 1px solid #DCDCDC;
        width: 140px;
        height: 140px;
        align-items: center;
    }

    .upload .round {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #FCBD32; /* Updated color */
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .upload .round input[type="file"] {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    input[type=file]::-webkit-file-upload-button {
        cursor: pointer;
    }

    .container14 {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Updated button styling */
    .btn-update,
    .btn-change-password {
        padding: 10px 20px;
        background-color: #7C1C2B;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none; /* Removed underline */
        display: inline-block; /* Added inline-block to align buttons horizontally */
    }

    .btn-update:hover,
    .btn-change-password:hover {
        background-color: #5A1521; /* Darker color on hover */
    }

    .btn-update:active,
    .btn-change-password:active {
        background-color: #3E0F18; /* Even darker color on click */
    }

    .btn-update:focus,
    .btn-change-password:focus {
        outline: none;
        box-shadow: none;
    }

    /* Updated icon styling */
    .fa-icon {
        margin-right: 5px;
    }
</style>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <script src="<?php echo URLROOT; ?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container14">
        <h1>Profile</h1>
        <hr>
        <!-- profile picture -->
        <form action="<?php echo URLROOT; ?>/students/profile" method="post" enctype="multipart/form-data" id="form">
            <div class="upload">
                <?php if ($data['user']->profilePic != null) : ?>
                    <img src="<?php echo URLROOT . "/public/" . $data['user']->profilePic; ?>" alt="profile picture">
                <?php else : ?>
                    <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png"
                        alt="profile picture">
                <?php endif; ?>
                <div class="round">
                    <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
                    <i class="fa fa-camera" style="color: #fff;"></i>
                </div>
                <input type="hidden" name="type" value="updateprofilepic">
            </div>
            <br>
            <br>
            <script type="text/javascript">
                document.getElementById("image").onchange = function () {
                    document.getElementById("form").submit();
                };
            </script>
        </form>
        <form action="<?php echo URLROOT; ?>/students/profile" method="post">
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" value="<?php echo $data['user']->Name; ?>">
            <span style="color:red;"><?php echo $data['nameError']; ?></span>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['user']->Email; ?>">
            <span style="color:red;"><?php echo $data['emailError']; ?></span>

            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['user']->Phone; ?>">

            <label for="course"><b>Institute</b></label>
            <input type="text" placeholder="Enter Institute" name="institute"
                value="<?php echo $data['organization']->OrganizationName; ?>" disabled>

            <label for="course"><b>Course</b></label>
            <input type="text" placeholder="Enter Course" name="course" value="<?php echo $data['student']->CourseID; ?>"
                disabled>
            <span style="color:red;"><?php echo $data['phoneError']; ?></span>

            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" value="<?php echo $data['student']->Address; ?>">
            <span style="color:red;"><?php echo $data['addressError']; ?></span>

            <label for="gender"><b>Gender</b></label>
            <input type="radio" name="gender" value="M"
                <?php echo ($data['student']->Gender == 'M') ? 'checked' : ''; ?>> Male
            <input type="radio" name="gender" value="F"
                <?php echo ($data['student']->Gender == 'F') ? 'checked' : ''; ?>> Female

            <label for="date_of_birth"><b>Date of Birth</b></label>
            <input type="date" name="date_of_birth" value="<?php echo $data['student']->DateOfBirth; ?>">
            <span style="color:red;"><?php echo $data['date_of_birthError']; ?></span>

            <input type="hidden" name="type" value="updateprofile">

            <!-- Updated button with icon -->
            <button type="submit" class="btn btn-primary btn-update"><i class="fa fa-refresh fa-icon"></i>Update</button>

            <!-- Updated link with icon -->
            <a href="<?php echo URLROOT; ?>/students/changepassword" class="btn-change-password"><i
                    class="fa fa-lock fa-icon"></i>Change Password</a>
            <!--post type = updateprofile-->
        </form>
    </div>
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
