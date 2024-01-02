<?php
/*
//controller
    public function view_event(){
        $eventid = $this->getUrl()[2];
        $data = [
            'title' => 'View Event',
            'event' => '',
            'Error' => '',
        ];
        $event = $this->eventModel->getEventById($eventid);
        $event->organization_name = $this->organizationModel->getOrganizationName($event->organization_id);
        $data['event'] = $event;
        $this->view('students/view_event', $data);
    }
*/
?>
<html>
<head>
    <!--event name-->
    <title><?php echo $data['event']->EventName; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $data['event']->EventName; ?></h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Event Name</th>
                    <td><?php echo $data['event']->EventName; ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $data['event']->Description; ?></td>
                </tr>
                <tr>
                    <th>Start Date and Time</th>
                    <td><?php echo $data['event']->StartDateAndTime; ?></td>
                </tr>
                <tr>
                    <th>End Date and Time</th>
                    <td><?php echo $data['event']->EndDateAndTime; ?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?php echo $data['event']->Location; ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?php 
                        if ($data['event']->EventType == 1) {
                            echo 'Workshop';
                        } elseif ($data['event']->EventType == 2) {
                            echo 'Seminar';
                        } elseif ($data['event']->EventType == 3) {
                            echo 'Conference';
                        } elseif ($data['event']->EventType == 4) {
                            echo 'Competition';
                        } elseif ($data['event']->EventType == 5) {
                            echo 'Other';
                        } else {
                            echo 'Unknown';
                        }
                    ?></td>
                </tr>
                <tr>
                    <th>Organizer</th>
                    <td><?php echo $data['event']->organization_name; ?></td>
                </tr>
                <!-- pariticipate button -->
                <tr>
                    <td colspan="2">
                        <button class="button" onclick="location.href='<?php echo URLROOT; ?>/students/participate/<?php echo $data['event']->EventID; ?>'">Participate</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>