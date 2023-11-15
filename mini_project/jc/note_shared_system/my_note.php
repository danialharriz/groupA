<?php
include 'db_conn.php';

include 'topnav1.php';

// Handle search form submission
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $user_email = $_SESSION['email'];
    $sql = "SELECT note_id, title, category FROM note WHERE owner = ? AND (title LIKE ? OR category LIKE ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $searchTerm = "%$search%"; // Adding % for partial matching
    mysqli_stmt_bind_param($stmt, 'sss', $user_email, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // If no search is performed, fetch all notes
    $user_email = $_SESSION['email'];
    $sql = "SELECT note_id, title, category FROM note WHERE owner = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $user_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html>
<body>
    <div class="container">
        <h1>My Notes</h1>
        <!-- Search form -->
        <form method="post" class="form-inline mb-3">
            <div class="col-6">
                <input type="text" class="form-control w-100" name="search" placeholder="Search Notes">
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Note ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='4' style='text-align: center;'>No notes found.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['note_id']}</td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo '<td><a href="version_history.php?note_id=' . $row['note_id'] . '" class="btn btn-primary">Browse</a>
                              <a href="delete_note.php?note_id=' . $row['note_id'] . '" class="btn btn-danger">Delete</a></td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
