<?php
    include 'db_conn.php';
    session_start();
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_email = $_SESSION['email'];
        $note_title = $_POST['title'];
        $note_category = $_POST['category'];
        
        // Check if a file was uploaded
        if (isset($_FILES['note_file'])) {
            $file_name = $_FILES['note_file']['name'];
            $file_tmp = $_FILES['note_file']['tmp_name'];
    
            // Define a directory where you want to save the uploaded files
            $upload_dir = "note/";

            $original_file_name = $file_name;
            $counter = 1;
            while (file_exists($upload_dir . $file_name)) {
                $file_info = pathinfo($original_file_name);
                $file_name = $file_info['filename'] . "_" . $counter . "." . $file_info['extension'];
                $counter++;
            }
    
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                // Insert note information into the database
                $sql = "INSERT INTO note (title, category, owner) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sss', $note_title, $note_category, $user_email);
                
                if (mysqli_stmt_execute($stmt)) {
                    // Get the auto-generated note_id for the inserted note
                    $note_id = mysqli_insert_id($conn);
    
                    // Get the selected permission value (0 for private, 1 for public)
                    $permission = $_POST['permission'];
    
                    // Insert a history record for the note creation
                    $history_sql = "INSERT INTO history (dir, modified, note_id, permission) VALUES (?, NOW(), ?, ?)";
                    $history_stmt = mysqli_prepare($conn, $history_sql);
                    $dir = "note/" . $file_name;
                    mysqli_stmt_bind_param($history_stmt, 'sii', $dir, $note_id, $permission);
                    
                    if (mysqli_stmt_execute($history_stmt)) {
                        echo "<script>alert('Note uploaded successfully.');</script>";
                        echo "<script>window.location.replace('my_note.php');</script>";
                    } else {
                        echo "<script>alert('Error uploading note.');</script>";
                        echo "<script>window.location.replace('upload.php');</script>";
                    }
                } else {
                    echo "<script>alert('Error uploading note.');</script>";
                    echo "<script>window.location.replace('upload.php');</script>";
                }
            } else {
                echo "<script>alert('Error uploading note.');</script>";
                echo "<script>window.location.replace('upload.php');</script>";
            }
        }
    }
    ?>