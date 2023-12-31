<html>
<style>
    /* Reset some default browser styles */
body, h1, form, label, input, select, button {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
}

h1 {
    text-align: center;
    margin: 20px 0;
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

select, input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

#customCourse {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Add more styles as needed for specific elements or layout adjustments */

</style>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/student_details.css">
</head>
<body>
    <h1>Student Details</h1>
    <form action="<?php echo URLROOT; ?>/users/student_details" method="POST">
        <?php if (empty($data['organizationId'])): ?>
            <label for="organizationID">Institute:</label>
            <select name="organizationID" id="organizationID" required onchange="fetchCourses()">
                <option value="" selected disabled>Select an Institute</option>
                <?php foreach($data['institution'] as $institution): ?>
                    <option value="<?php echo $institution->OrganizationID; ?>"><?php echo $institution->OrganizationName; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="courseID">Course:</label>
            <select name="courseID" id="courseID" required onchange="showCustomCourseInput()">
                <option value="" selected disabled>Please select an institute first</option>
            </select>

        <?php endif; ?>

        <?php if (!empty($data['organizationId'])): ?>
            <label for="courseID">Course:</label>
            <select name="courseID" id="courseID" required onchange="showCustomCourseInput()">
                <?php foreach($data['course'] as $course): ?>
                    <option value="<?php echo $course->CourseName; ?>"><?php echo $course->CourseName; ?></option>
                <?php endforeach; ?>
                <option value="Other">Other</option>
            </select>
        <?php endif; ?>

        <input type="text" name="customCourse" id="customCourse" style="display: none;" placeholder="Enter your own course">

        <script>
            function showCustomCourseInput() {
                let courseID = document.getElementById('courseID');
                let customCourseInput = document.getElementById('customCourse');

                if (courseID.value === 'Other') {
                    customCourseInput.style.display = 'block';
                    customCourseInput.setAttribute('required', 'required');
                } else {
                    customCourseInput.style.display = 'none';
                    customCourseInput.removeAttribute('required');
                }
            }
        </script>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="" selected disabled>Select Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>

        <label for="dateOfBirth">Date of Birth:</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth" required>

        <button type="submit">Submit</button>
    </form>

    <?php if (empty($data['organizationId'])): ?>
        <script>
            function fetchCourses() {
                let organizationID = document.getElementById('organizationID').value;
                let courseID = document.getElementById('courseID');

                // Empty the courseID select
                courseID.innerHTML = '';

                // Create default option
                let defaultOption = document.createElement('option');
                defaultOption.text = 'Please select a course';
                courseID.add(defaultOption);

                // Fetch courses
                fetch('<?php echo URLROOT; ?>/users/get_courses_by_organization_id/' + organizationID)
                    .then(response => response.json())
                    .then(data => {
                        let option;
                        for (let i = 0; i < data.length; i++) {
                            option = document.createElement('option');
                            option.text = data[i].CourseName;
                            option.value = data[i].CourseName;
                            courseID.add(option);
                        }
                        option = document.createElement('option');
                        option.text = 'Other';
                        option.value = 'Other';
                        courseID.add(option);

                        // Append the input field to the form
                        document.querySelector('form').appendChild(customCourseInput);
                    });
            }
        </script>
    <?php endif; ?>

</body>
</html>