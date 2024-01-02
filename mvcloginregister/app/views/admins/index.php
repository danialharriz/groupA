<?php
// FILEPATH: /c:/xampp/htdocs/mvcloginregister/app/views/admins/index.php

echo "<h1>This is admin page</h1>";
echo "<p>This is admin page in HTML</p>";
?>

<html>
    <head>
        <title>Admin Page</title>
    </head>
    <body>
        <a href="<?php echo URLROOT; ?>/admins/all_events">All Events</a>
        <a href="<?php echo URLROOT; ?>/admins/register_organization">Register Organization</a>
    </body>
</html>