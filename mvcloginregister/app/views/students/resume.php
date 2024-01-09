<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<style>
    /* styles.css (or include it in your HTML file) */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container2 {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box
}

.header {
    background-color: #0e77ca;
    color: #ffffff;
    padding: 10px 15px;
    margin-bottom: 10px;
    border-radius: 8px 8px 0 0;
}

.input-group {
    margin: 10px 0px 10px 0px;
}

.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}

.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}

.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #0e77ca;
    border: none;
    border-radius: 5px;
}


</style>
<head>
    <title>Resume</title>
</head>
<body>
    <div class = "container2">
    <div class="header">
            <h2>Basic Information</h2>
        </div>
        <div class="profilePic">
            <?php if($data['user']->profilePic != null): ?>
                <img src="<?php echo URLROOT; ?>/public/<?php echo $data['user']->profilePic; ?>" alt="Profile Picture" width="200" height="200">
            <?php else: ?>
                <img src="https://i.pinimg.com/originals/a8/57/00/a85700f3c614f6313750b9d8196c08f5.png" alt="Profile Picture" width="200" height="200">
            <?php endif; ?>
        </div>
        <div class="profileInfo">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><?php echo $data['user']->Name; ?></td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td><?php //calculate age from date of birth
                        $dob = new DateTime($data['student']->DateOfBirth);
                        $now = new DateTime();
                        $difference = $now->diff($dob);
                        echo $difference->y;
                    ?></td>
                </tr>
                <tr>
                    <td>Institute:</td>
                    <td><?php echo $data['organization']->OrganizationName; ?></td>
                </tr>
                <tr>
                    <td>Course:</td>
                    <td><?php echo $data['student']->CourseID; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $data['user']->Email; ?></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><?php echo $data['user']->Phone; ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo $data['student']->Address; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class = "container2">
        <div class="header">
            <h2>Event Participated</h2>
        </div>
        <div class="event">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Event Type</th>
                    <th>Event Description</th>
                </tr>
                <?php if (!empty($data['events'])): ?>
                    <?php foreach($data['events'] as $event): ?>
                        <tr>
                            <td><?php echo $event->event_details->EventName; ?></td>
                            <td><?php echo $event->event_details->EventType; ?></td>
                            <td><?php echo $event->event_details->Description; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No events participated</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <div class = "container2">
        <div class="header">
            <h2>Additional Events</h2>
        </div>
        <div class="event">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Event Type</th>
                    <th>Event Description</th>
                </tr>
                <?php if (!empty($data['outside_events'])): ?>
                    <?php foreach($data['outside_events'] as $event): ?>
                        <tr>
                            <td><?php echo $event->OEventName; ?></td>
                            <td><?php if($event->OEventType == 1) echo "Workshop";
                                        else if($event->OEventType == 2) echo "Seminar";
                                        else if($event->OEventType == 3) echo "Conference";
                                        else if($event->OEventType == 4) echo "Competition";
                                        else if($event->OEventType == 5) echo "Others"; ?></td>
                            <td><?php echo $event->ODescription; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No events participated</td>
                    </tr>
                <?php endif; ?>
            </table>
                </div>
    </div>
    <div class = "container2">
        <div class="header">
            <h2>Resume Additional details</h2>
        </div>
        <form action="<?php echo URLROOT; ?>/students/resume" method="post">
            <div class="input-group">
                <label>Education</label>
                <textarea name="education" rows="5" cols="40"><?php echo $data['resume']->education; ?></textarea>
            </div>
            <div class="input-group">
                <label>Experience</label>
                <textarea name="experience" rows="5" cols="40"><?php echo $data['resume']->experience; ?></textarea>
            </div>
            <div class="input-group">
                <label>Skills</label>
                <textarea name="skills" rows="5" cols="40"><?php echo $data['resume']->skills; ?></textarea>
            </div>
            <div class="input-group">
                <label>Additional</label>
                <textarea name="additional" rows="5" cols="40"><?php echo $data['resume']->additional; ?></textarea>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="resume_btn">Update</button>
            </div>
        </form>
        <div class="input-group">
            <button type="button" class="btn" id="exportPdfBtn">Export as PDF</button>
        </div>
    </div>
</body>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    document.getElementById('exportPdfBtn').addEventListener('click', function () {
        // Use html2pdf library to export the current page
        var element = document.body; // You can replace this with the specific element you want to export
        html2pdf(element);
    });
</script>
</html>