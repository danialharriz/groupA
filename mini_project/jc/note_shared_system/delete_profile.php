<?php
include 'db_conn.php';
include 'topnav1.php';

if (isset($_SESSION['email'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'DELETE') {
        // Delete the user's profile
        $email = $_SESSION['email'];

        /// Step 1: Retrieve a list of file IDs associated with the user
        $selectFilesQuery = "SELECT id, dir FROM history WHERE note_id IN (SELECT note_id FROM note WHERE owner = ?)";
        $stmt = mysqli_prepare($conn, $selectFilesQuery);
        mysqli_stmt_bind_param($stmt, 's', $email);
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
        
        $deleteUserQuery = "DELETE FROM user WHERE email = ?";

        $deleteUserNoteQuery = "DELETE FROM note WHERE owner = ?";
        $deleteNoteVersionQuery = "DELETE FROM history WHERE note_id IN (SELECT note_id FROM note WHERE owner = ?)";
        
        $deleteNoteVersionstmt = mysqli_prepare($conn, $deleteNoteVersionQuery);
        mysqli_stmt_bind_param($deleteNoteVersionstmt, 's', $email);

        if(mysqli_stmt_execute($deleteNoteVersionstmt)) {
            $deleteNoteQuery = mysqli_prepare($conn, $deleteUserNoteQuery);
            mysqli_stmt_bind_param($deleteNoteQuery, 's', $email);

            if(mysqli_stmt_execute($deleteNoteQuery)) {
                // Delete the user's profile
                $deleteUserQuery = "DELETE FROM user WHERE email = ?";

                $stmt = mysqli_prepare($conn, $deleteUserQuery);
                mysqli_stmt_bind_param($stmt, 's', $email);

                if (mysqli_stmt_execute($stmt)) {
                    // Logout and redirect to a page, e.g., logout.php
                    session_unset();
                    session_destroy();
                    echo "<script>alert('Profile deleted successfully.');</script>";
                    echo "<script>window.location.replace('logout.php');</script>";
                } else {
                    echo "<script>alert('Error deleting profile.');</script>";
                    echo "<script>window.location.replace('delete_profile.php');</script>";
                }
            } else {
                echo "<script>alert('Error deleting profile.');</script>";
                echo "<script>window.location.replace('delete_profile.php');</script>";
            }
        } else {
            echo "<script>alert('Error deleting profile.');</script>";
            echo "<script>window.location.replace('delete_profile.php');</script>";
        }
    }
} else {
    echo "<script>alert('Please log in to delete your profile.');</script>";
    echo "<script>window.location.replace('login.php');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Profile</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Delete Profile</h1>
        
        <!-- Bootstrap Alert for the Warning -->
        <div class="alert alert-warning">
            <strong>Warning:</strong> This action is irreversible and will delete every note owned by you and all file history. If you are sure you want to proceed, please type "DELETE" to confirm.
        </div>
        
        <form method="post">
            <div class="form-group">
                <label for="confirm_delete">Type "DELETE" to confirm:</label>
                <input type="text" class="form-control" name="confirm_delete" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete Profile</button>
        </form>
    </div>
</body>
</html>