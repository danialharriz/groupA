<?php
include 'db_conn.php';

// Check if the 'note_id' parameter is set in the URL
if (isset($_GET['note_id'])) {
    $note_id = $_GET['note_id'];

    // Check if the note exists and belongs to the current user (you may need to implement this logic)
    $check_note_sql = "SELECT owner FROM note WHERE note_id = ?";
    $check_note_stmt = mysqli_prepare($conn, $check_note_sql);
    mysqli_stmt_bind_param($check_note_stmt, 'i', $note_id);
    mysqli_stmt_execute($check_note_stmt);
    $result = mysqli_stmt_get_result($check_note_stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Note exists and belongs to the current user
        if (isset($_POST['confirm_delete'])) {
            // User confirmed the deletion
            $selectFilesQuery = "SELECT id, dir FROM history WHERE note_id = ?";
            $stmt = mysqli_prepare($conn, $selectFilesQuery);
            mysqli_stmt_bind_param($stmt, 's', $note_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $fileId, $filePath);

            // Step 3: Loop through Owned Files
            while (mysqli_stmt_fetch($stmt)) {
                // Step 4: Delete Files in the File System
                if (unlink($filePath)) {
                    // File deleted successfully; you can log this if needed.
                } else {
                    // Handle file deletion error.
                    echo "Error deleting file: $filePath";
                }

                // Step 5: Delete Records from the Database
                /*
                $deleteFileQuery = "DELETE FROM history WHERE id = ?";
                $deleteStmt = mysqli_prepare($conn, $deleteFileQuery);
                if(!$deleteStmt) {
                    echo "Error deleting file record: $fileId";
                    echo mysqli_error($conn);
                }
                else {
                    mysqli_stmt_bind_param($deleteStmt, 'i', $fileId);
                    if (mysqli_stmt_execute($deleteStmt)) {
                        // File record deleted successfully.
                    } else {
                        // Handle database record deletion error.
                        echo "Error deleting file record: $fileId";
                    }
                }
                */
            }

            $deleteNoteVersionQuery = "DELETE FROM history WHERE note_id = ?";
            $deleteNoteVersionstmt = mysqli_prepare($conn, $deleteNoteVersionQuery);
            mysqli_stmt_bind_param($deleteNoteVersionstmt, 's', $note_id);

            if(mysqli_stmt_execute($deleteNoteVersionstmt)) {
                $delete_note_sql = "DELETE FROM note WHERE note_id = ?";
                $delete_note_stmt = mysqli_prepare($conn, $delete_note_sql);
                mysqli_stmt_bind_param($delete_note_stmt, 'i', $note_id);

                if (mysqli_stmt_execute($delete_note_stmt)) {
                    // Deletion successful
                    echo "<script>alert('Note deleted successfully.');</script>";
                    echo "<script>window.location.href='my_note.php';</script>";
                } else {
                    // Deletion failed
                    echo "<script>alert('Failed to delete the note. Please try again.');</script>";
                    echo "<script>window.location.href='my_note.php';</script>";
                }
            } 
            else {
                echo "<script>alert('Failed to delete the note. Please try again.');</script>";
                echo "<script>window.location.href='my_note.php';</script>";
            }
        }
    } else {
        // Note doesn't exist or doesn't belong to the current user
        echo "<script>alert('Note not found or you don't have permission to delete it.');</script>";
        echo "<script>window.location.href='my_note.php';</script>";
    }
} else {
    // 'note_id' parameter not set
    echo "<script>alert('Note ID not provided.');</script>";
    echo "<script>window.location.href='my_note.php';</script>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Note</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h2>Delete Note</h2>
        <p>Do you really want to delete this note? This action is irreversible.</p>
        <form method="post" action="">
            <input type="submit" class="btn btn-danger" name="confirm_delete" value="Yes, delete">
            <a href="main_page.php" class="btn btn-primary">No, cancel</a>
        </form>
    </div>
</body>
</html>
