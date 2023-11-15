<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['historyId']) && isset($_POST['permission'])) {
    $historyId = $_POST['historyId'];
    $permission = $_POST['permission'];

    // Update the permission in the database
    $update_sql = "UPDATE history SET permission = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, 'ii', $permission, $historyId);

    if (mysqli_stmt_execute($update_stmt)) {
        echo "Permission updated successfully.";
    } else {
        echo "Permission update failed.";
    }
} else {
    echo "Invalid request.";
}
