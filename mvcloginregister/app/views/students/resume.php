<?php require APPROOT . '/views/students/nav.php' ?>
<html>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container2 {
    width: 80%;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header {
    background-color: black;
    color: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 4px 4px 0 0;
}

.profilePic img {
    border-radius: 50%;
    margin-bottom: 10px;
}

.profileInfo table {
    width: 100%;
}

.profileInfo table td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

.event table,
.resume-form textarea {
    width: 100%;
    margin-bottom: 10px;
}

.event th,
.event td,
.resume-form textarea,
.resume-form button {
    padding: 8px;
    text-align: left;
}

.event th {
    background-color: #3498db;
    color: #fff;
}

.event td {
    border-bottom: 1px solid #ddd;
}

.resume-form button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

#exportPdfBtn {
    background-color: #27ae60;
}

.resume-form button:hover,
#exportPdfBtn:hover {
    background-color: #218c53;
}
    /* Add this style to your existing styles */
    .container3 {
        width: 80%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container3 .header {
        background-color: black;
        color: #fff;
        padding: 10px;
        text-align: center;
        border-radius: 4px 4px 0 0;
    }

    .container3 .input-group {
        margin-bottom: 15px;
    }

    .container3 label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .container3 textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 4px;
        resize: vertical;
    }

    .container3 .btn {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 4px;
    }

    .container3 .btn:hover {
        background-color: #218c53;
    }

    .profilePic {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.profilePic img {
    border-radius: 50%;
    margin-bottom: 10px;
    align-self: center; /* Center the image within the flex container */
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
                            <td><?php if($event->event_details->EventType == 1) echo "Workshop";
                                        else if($event->event_details->EventType == 2) echo "Seminar";
                                        else if($event->event_details->EventType == 3) echo "Conference";
                                        else if($event->event_details->EventType == 4) echo "Competition";
                                        else if($event->event_details->EventType == 5) echo "Others"; ?></td>
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
    <div class = "container3">
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
        <!--<div class="input-group">
            <button type="button" class="btn" id="exportPdfBtn">Export as PDF</button>
        </div>-->
        <div class = "input-group">
            <button type="button" class="btn" onclick="location.href='<?php echo URLROOT; ?>/students/generateResume/'">View Resume</button>
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