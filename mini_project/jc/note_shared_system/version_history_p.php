<?php 
    include 'db_conn.php';
    include 'topnav1.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Version History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h2>File Version History</h2>
        <?php
        $note_id = $_GET['note_id'];
        $history_sql = "SELECT id, modified FROM history WHERE note_id = ? AND permission = 1 ORDER BY modified DESC";
        $history_stmt = mysqli_prepare($conn, $history_sql);
        mysqli_stmt_bind_param($history_stmt, 'i', $note_id);
        mysqli_stmt_execute($history_stmt);
        $result = mysqli_stmt_get_result($history_stmt);
        $hasVersions = mysqli_num_rows($result) > 0;
        ?>
        <!--
        <div class="text-center">
            <form action="upload_new_version.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
                <div class="form-row align-items-center justify-content-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="file">Choose a Note File</label>
                            <input type="file" class="form-control-file" name="file" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="permission">Share Permission</label>
                            <select class="form-control" name="permission">
                                <option value="0">Private</option>
                                <option value="1">Public</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">Upload New Version</button>
                    </div>
                </div>
            </form>
        </div>
        -->



        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Version Date</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['modified'] . "</td>";
                        echo '<td>';
                        echo '<a href="download_file.php?download=' . $row['id'] . '" class="btn btn-primary">Download</a>';
                        //echo '<button type="button" class="btn btn-danger delete-version-btn" data-version-id="' . $row['id'] . '"data-note-id="' . $note_id . '">Delete</button>';
                        echo '</td>';
                        /*echo '<td>';
                        $permissions = array(0 => 'private', 1 => 'public');
                        $selectedPermission = $row['permission'];
                        echo '<select name="change_permission" class="form-control" data-id="' . $row['id'] . '">';
                        foreach ($permissions as $value => $text) {
                            $selected = ($value === $selectedPermission) ? 'selected' : '';
                            echo "<option value='$value' $selected>$text</option>";
                        }
                        echo '</select>';
                        echo '</td>';*/
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            // Display a warning message and "Upload New Version" button
            if (!$hasVersions) {
                echo '<p class="text-warning">There are no file versions available for this note. You can upload a new version below.</p>';
                echo '<form action="delete_note.php?note_id='.$note_id.'" method="post" id="delete-note-form">';
                //echo '<input type="hidden" name="note_id" value="' . $note_id. '">';
                // Add the rest of your form elements
                echo '<button type="button" class="btn btn-danger" id="delete-note-btn">Delete Note</button>';
                echo '</form>';
            }
        ?>
        <br>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*
        $(document).ready(function() {
            $('select[name="change_permission"]').change(function() {
                var selectedPermission = $(this).val();
                var historyId = $(this).data("id");

                $.ajax({
                    url: 'update_permission.php',
                    method: 'POST',
                    data: {
                        permission: selectedPermission,
                        historyId: historyId
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
            document.getElementById('delete-note-btn').addEventListener('click', function() {
                var confirmation = confirm("Do you sure want to delete the note? The action is not reversible.");
                if (confirmation) {
                    document.getElementById('delete-note-form').submit();
                    //window.location.href = 'delete_note.php?note_id=' + <?php echo $note_id; ?>;
                }
            });            
        });
        const deleteButtons = document.querySelectorAll('.delete-version-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const versionId = this.getAttribute('data-version-id');
                    const noteId = this.getAttribute('data-note-id');

                    const confirmation = confirm("Do you sure want to delete this version? The action is not reversible.");

                    if (confirmation) {
                        window.location.href = 'delete_version.php?version_id=' + versionId + '&note_id=' + noteId;
                    }
                });
            });*/
    </script>
</body>
</html>
