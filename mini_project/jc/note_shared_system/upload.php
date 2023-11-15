<?php
include 'topnav1.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Upload Note</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .container {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Note</h1>
        <form action="upload_process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" required>
            </div>
            <div class="form-group">
            <label for="note_file">Choose a Note File</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="note_file" id="note_file" required>
                <label class="custom-file-label" for="note_file"><span id="selected-file-name" class="file-name"></span></label>
            </div>
            
            </div>
            <div class="form-group">
                <label for="permission">Share Permission</label>
                <select class="form-control" name="permission">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
<script>
    document.getElementById("selected-file-name").textContent = "Select file";

    document.getElementById('note_file').addEventListener('change', function() {
        const input = this;
        const fileNameDisplay = document.getElementById("selected-file-name");
        
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = "Select file"; // Set it back to "Select file" if no file is selected
        }
    });
    </script>
</html>
