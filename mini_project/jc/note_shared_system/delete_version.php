<?php
    // Include necessary files and connect to the database (if needed).
    include 'db_conn.php';

    if (isset($_GET['version_id'])) {
        // Get the ID of the file version from the query parameter.
        $fileVersionId = $_GET['version_id'];
        $noteId = $_GET['note_id'];

        $filePathQuery = "SELECT dir FROM history WHERE id = ?";
        $stmt = mysqli_prepare($conn, $filePathQuery);
        mysqli_stmt_bind_param($stmt, 'i', $fileVersionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $filePath);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (!empty($filePath)) {
            // Delete the file from the directory.
            if (unlink($filePath)) {
                // File deleted from the directory.
            } else {
                // Handle the case where the file deletion from the directory failed.
                echo '<script>alert("File version deletion failed.");</script>';
                echo '<script>window.location.href = "version_history.php?note_id=' . $_GET['note_id'] . '";</script>';
            }
        }


        // Query the database to delete the file version based on the version ID.
        $deleteQuery = "DELETE FROM history WHERE id = ?"; // Adjust your table and column names.
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $fileVersionId);

        if (mysqli_stmt_execute($stmt)) {
            // Deletion was successful.
            echo '<script>alert("File version deleted successfully.");</script>';
            echo '<script>window.location.href = "version_history.php?note_id=' . $_GET['note_id'] . '";</script>';
        } else {
            // Handle the case where the deletion failed.
            echo '<script>alert("File version deletion failed.");</script>';
            echo '<script>window.location.href = "version_history.php?note_id=' . $_GET['note_id'] . '";</script>';
        }

        // Close any database connections or perform other cleanup.
        mysqli_close($conn);
    }
?>
