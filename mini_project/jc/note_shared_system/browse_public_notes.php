<?php
    include 'db_conn.php';

    include 'topnav1.php';

    // Fetch public notes
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    /*
    // Fetch public notes
    $sql = "SELECT n.note_id, n.title, n.category, n.owner
            FROM note AS n
            JOIN history AS v ON n.note_id = v.note_id
            WHERE v.permission = 1";
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
    */

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $user_email = $_SESSION['email'];
        $sql = "SELECT n.note_id, n.title, n.category, n.owner
        FROM note AS n
        JOIN history AS v ON n.note_id = v.note_id
        WHERE v.permission = 1 AND (n.title LIKE ? OR n.category LIKE ? OR n.owner LIKE ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $searchTerm = "%$search%"; // Adding % for partial matching
        mysqli_stmt_bind_param($stmt, 'sss', $searchTerm, $searchTerm, $searchTerm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $sql = "SELECT n.note_id, n.title, n.category, n.owner
        FROM note AS n
        JOIN history AS v ON n.note_id = v.note_id
        WHERE v.permission = 1";
        $stmt = mysqli_prepare($conn, $sql);

        // Check if the statement was prepared successfully
        if ($stmt) {
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }
        } else {
            echo "Error preparing the statement: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html>
<body>
    <div class="container">
        <h1>Browse Public Notes</h1>
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
                    <th>Owner</th> <!-- Added owner column -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='5' style='text-align: center;'>No public notes found.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['note_id']}</td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo "<td>{$row['owner']}</td> <!-- Display owner -->";
                        echo '<td><a href="version_history_p.php?note_id=' . $row['note_id'] . '" class="btn btn-primary">Browse</a></td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>