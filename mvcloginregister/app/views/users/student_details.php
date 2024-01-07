<html>
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
            <select name="courseID" id="courseID" required>
                <option value="" selected disabled>Please select an institute first</option>
            </select>

        <?php endif; ?>

        <?php if (!empty($data['organizationId'])): ?>
            <label for="courseID">Course:</label>
            <select name="courseID" id="courseID" required>
                <?php foreach($data['course'] as $course): ?>
                    <option value="<?php echo $course->CourseID; ?>"><?php echo $course->CourseName; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>

        

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
                            option.value = data[i].CourseID;
                            courseID.add(option);
                        }
                    });
            }
        </script>
    <?php endif; ?>

</body>
</html>