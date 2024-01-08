<html>
<style>/* Common styles for profile pictures */
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

.profile-pic,
.profile-pic-preview {
    max-width: 200px;
    max-height: 200px;
    display: block;
    border-radius: 50%;
    margin: 0 auto;
    margin-bottom: 15px;
}

#imagePreview {
    width: 200px;
    height: 200px;
    overflow: hidden;
    background-color: #cccccc;
    border-radius: 50%;
    margin: 0 auto;
    margin-bottom: 15px;
}

#imagePreview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

span {
    color: red;
}

.btn-change-password {
    padding: 10px 20px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px; /* Adjust the margin as needed */
}

.btn-change-password:hover {
    background-color: #0056b3;
}

.btn-change-password:active {
    background-color: #004080;
}

.btn-change-password:focus {
    outline: none;
    box-shadow: none;
}


/* Add more styles as needed */


</style>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <script src="<?php echo URLROOT; ?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Profile</h1>
    <hr>
    <form action="<?php echo URLROOT; ?>/students/profile" method="post">
        <?php if (!empty($data['user']->ProfilePicture)) : ?>
            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['user']->ProfilePicture; ?>" class="profile-pic" id="previewImage">
        <?php else : ?>
            <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" class="profile-pic" id="previewImage">
        <?php endif; ?>
        
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" value="<?php echo $data['user']->Name; ?>">
        <span style="color:red;"><?php echo $data['nameError']; ?></span>
        
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['user']->Email; ?>">
        <span style="color:red;"><?php echo $data['emailError']; ?></span>
        
        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['user']->Phone; ?>">
        
        <label for="course"><b>Institute</b></label>
        <input type="text" placeholder="Enter Institute" name="institute" value="<?php echo $data['organization']->OrganizationName; ?>"disabled>
        
        <label for="course"><b>Course</b></label>
        <input type="text" placeholder="Enter Course" name="course" value="<?php echo $data['student']->CourseID; ?>"disabled>
        <span style="color:red;"><?php echo $data['phoneError']; ?></span>
        
        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="address" value="<?php echo $data['student']->Address; ?>">
        <span style="color:red;"><?php echo $data['addressError']; ?></span>
        
        <label for="gender"><b>Gender</b></label>
        <input type="radio" name="gender" value="M" <?php echo ($data['student']->Gender == 'M') ? 'checked' : ''; ?>> Male
        <input type="radio" name="gender" value="F" <?php echo ($data['student']->Gender == 'F') ? 'checked' : ''; ?>> Female
        
        <label for="date_of_birth"><b>Date of Birth</b></label>
        <input type="date" name="date_of_birth" value="<?php echo $data['student']->DateOfBirth; ?>">
        <span style="color:red;"><?php echo $data['date_of_birthError']; ?></span>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo URLROOT; ?>/students/changepassword" class="btn btn-change-password">Change Password</a>
    </form>
</body>
<script>
    function previewImage(input) {
        var fileInput = input;
        var imagePreview = document.getElementById('imagePreview');

        // Clear previous preview
        imagePreview.innerHTML = '';

        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Create an image element
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('profile-pic-preview');

                // Append the image to the preview container
                imagePreview.appendChild(img);
            };

            // Read the uploaded file as a data URL
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>

</html>
