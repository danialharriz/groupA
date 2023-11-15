<?php
include 'db_conn.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note_id = $_POST['note_id'];
    $permission = $_POST['permission'];

    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $targetDir = "note/"; // Set your upload directory
        $originalFileName = $_FILES["file"]["name"];
        $targetFile = $targetDir . basename($originalFileName);
    
        // Check if the file already exists if so, rename it
        $i = 1;
        while (file_exists($targetFile)) {
            $info = pathinfo($originalFileName);
            $newFilename = $info['filename'] . "_" . $i . "." . $info['extension'];
            $targetFile = $targetDir . $newFilename;
            $i++;
        }

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // Insert the file information into the database
            $insertSql = "INSERT INTO history (note_id, modified, permission, dir) VALUES (?, NOW(), ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, 'iis', $note_id, $permission, $targetFile);

            if (mysqli_stmt_execute($insertStmt)) {
                echo "<script>alert('New version uploaded successfully.');</script>";
            } else {
                $error = mysqli_error($conn);
                //display the error message
                echo "<script>alert('Error: $error. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Error uploading the file. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please choose a file to upload.');</script>";
    }
} else {
    echo "<script>alert('Please use the upload form to upload a file.');</script>";
}
echo "<script>window.location.href='version_history.php?note_id=$note_id';</script>";
mysqli_close($conn);
?>