<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Note Sharing System</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Add this CSS in your <style> or CSS file */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="main_page.php">Note Sharing System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="main_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_note.php">My Notes</a>
                </li>
                <li class= "nav-item">
                    <a class="nav-link" href="upload.php">Upload Note</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="browse_public_notes.php">Browse Public Note</a>
                </li>
                <li class="nav-item dropdown" id="userDropdownLi">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi, <?php include 'session.php'; echo $_SESSION['name']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="update_profile.php">Update Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <script>
    $(document).ready(function() {
        let dropdownVisible = false;

        $("#userDropdownLi").on("click", function(e) {
            e.stopPropagation(); // Prevent click on the li from closing the dropdown
            if (dropdownVisible) {
                $(".dropdown-menu").hide();
            } else {
                $(".dropdown-menu").show();
            }
            dropdownVisible = !dropdownVisible;
        });

        // Close dropdown when clicking outside of the dropdown menu
        $(document).on("click", function(e) {
            if (dropdownVisible) {
                if (!$(e.target).closest(".dropdown-menu").length) {
                    $(".dropdown-menu").hide();
                    dropdownVisible = false;
                }
            }
        });
    });
</script>
</body>
</html>
