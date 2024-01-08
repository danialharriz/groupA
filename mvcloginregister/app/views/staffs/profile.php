<html>
<style>/* Common styles for profile pictures */
    /* Common styles for profile pictures */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        margin: 20px;
        color: #333;
    }

    h1 {
        color: #333;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    hr {
        border: 1px solid #ccc;
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
    }

    /* Styles for editable input fields */
    input[type="text"]:not([disabled]),
    input[type="date"]:not([disabled]),
    input[type="radio"]:not([disabled]) {
        border-color: #007bff;
    }

    /* Styles for disabled input fields */
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

    .upload{
        width: 125px;
        position: relative;
        margin: auto;
        align-items: center;
        }

        .upload img{
        border-radius: 50%;
        border: 1px solid #DCDCDC;
        width: 140px;
        height: 140px;
        align-items: center;
        }

        .upload .round{
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00B4FF;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        }

        .upload .round input[type = "file"]{
        position: absolute;
        transform: scale(2);
        opacity: 0;
        }

        input[type=file]::-webkit-file-upload-button{
            cursor: pointer;
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
    <h1>Profile</h1>
    <hr>
    <!-- profile picture -->
    <form action = "<?php echo URLROOT; ?>/staffs/profile" method = "post" enctype = "multipart/form-data" id = "form">
        <div class="upload">
            <?php if($data['user']->profilePic != null) : ?>
                <img src="<?php echo URLROOT."/public/".$data['user']->profilePic; ?>" alt="profile picture">
            <?php else : ?>
                <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" alt="profile picture">
            <?php endif; ?>
            <div class="round">
                <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
                <i class = "fa fa-camera" style = "color: #fff;"></i>
            </div>
            <input type="hidden" name="type" value="updateprofilepic">
        </div>
        <br>
        <br>
        <script type="text/javascript">
            document.getElementById("image").onchange = function(){
                document.getElementById("form").submit();
            };
        </script>
    </form>
    <form action="<?php echo URLROOT; ?>/staffs/profile" method="post">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" value="<?php echo $data['user']->Name; ?>">
        <span style="color:red;"><?php echo $data['nameError']; ?></span>
        
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['user']->Email; ?>">
        <span style="color:red;"><?php echo $data['emailError']; ?></span>
        
        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['user']->Phone; ?>">
        
        <label for="Organization"><b>Organization</b></label>
        <input type="text" placeholder="Enter OPrganization" name="Organization" value="<?php echo $data['organization']->OrganizationName; ?>"disabled>
        
        <label for="course"><b>Job Title</b></label>
        <input type="text" placeholder="Enter Job Title" name="jobtitle" value="<?php echo $data['staff']->JobTitle; ?>" disabled>
        
        <input type="hidden" name="type" value="updateprofile">

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo URLROOT; ?>/staffs/changepassword" class="btn-change-password">Change Password</a>
    </form>
</body>
</html>
