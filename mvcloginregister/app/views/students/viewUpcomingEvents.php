<?php
/*
public function viewUpcomingEvents() {
        $data = [
            'title' => 'Upcoming Events',
            'events' => '',
            'Error' => '',
        ];
        $event_participated = $this->participateModel->get_eventid($_SESSION['user_id']);
        $events = $this->studentModel->getUpcomingEvents();
        //get event organization name
        foreach ($events as $event) {
            $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        }
        $data['events'] = $events;

        $this->view('students/ViewUpcomingEvents', $data);
    }
//controller
    */
?>
<html>
<head>
    <title>Upcoming Events</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Upcoming Events</h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Type</th>
                    <th>Event Start</th>
                    <th>Event End</th>
                    <th>Organizer</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data['events'] as $event) : ?>
                    <tr>
                        <td><?php echo $event->EventName; ?></td>
                        <td><?php 
                            if ($event->EventType == 1) {
                                echo 'Workshop';
                            } elseif ($event->EventType == 2) {
                                echo 'Seminar';
                            } elseif ($event->EventType == 3) {
                                echo 'Conference';
                            } elseif ($event->EventType == 4) {
                                echo 'Competition';
                            } elseif ($event->EventType == 5) {
                                echo 'Other';
                            } else {
                                echo 'Unknown';
                            }
                        ?></td>
                        <td><?php echo $event->StartDateAndTime; ?></td>
                        <td><?php echo $event->EndDateAndTime; ?></td>
                        <td><?php echo $event->OrganizationName; ?></td>
                        <?php foreach($data['events'] as $event) : ?>
                            <tr>
                                <td><?php echo $event->EventName; ?></td>
                                <td><?php 
                                    if ($event->EventType == 1) {
                                        echo 'Workshop';
                                    } elseif ($event->EventType == 2) {
                                        echo 'Seminar';
                                    } elseif ($event->EventType == 3) {
                                        echo 'Conference';
                                    } elseif ($event->EventType == 4) {
                                        echo 'Competition';
                                    } elseif ($event->EventType == 5) {
                                        echo 'Other';
                                    } else {
                                        echo 'Unknown';
                                    }
                                ?></td>
                                <td><?php echo $event->StartDateAndTime; ?></td>
                                <td><?php echo $event->EndDateAndTime; ?></td>
                                <td><?php echo $event->OrganizationName; ?></td>
                                <td>
                                    <?php if ($event->isParticipated) : ?>
                                        <button class="button" onclick="location.href='<?php echo URLROOT; ?>/students/cancel_participation/<?php echo $event->EventID; ?>'">Cancel</button>
                                    <?php else : ?>
                                        <button class="button" onclick="location.href='<?php echo URLROOT; ?>/students/participate_event/<?php echo $event->EventID; ?>'">Participate</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

