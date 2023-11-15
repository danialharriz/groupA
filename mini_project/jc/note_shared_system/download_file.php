<?php
// Include necessary files and connect to the database (if needed).
include 'db_conn.php';

if (isset($_GET['download'])) {
    // Get the ID of the file version from the query parameter.
    $fileVersionId = $_GET['download'];

    // Query the database to get the file path based on the version ID.
    $query = "SELECT dir FROM history WHERE id = ?"; // Adjust your table and column names.
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $fileVersionId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $filePath);
    mysqli_stmt_fetch($stmt);

    if ($filePath) {
        // Set headers to force the browser to download the file.
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and send it to the browser.
        readfile($filePath);
        exit;
    } else {
        // Handle the case where the file version ID is not found.
        echo 'File not found.';
    }

    // Close any database connections or perform other cleanup.
    mysqli_close($conn);
}
?>
