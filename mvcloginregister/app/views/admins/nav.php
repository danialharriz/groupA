<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo URLROOT ?>/public/img/logos/YVLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        header {
            margin-bottom: 20px;
            top: 0;
            z-index: 1000;
            position: sticky;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav a {
            color: #000;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }

        nav a:hover {
            background-color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            color: #0e77ca;
        }

        /* start nav at centre */
        .navbar-nav>li {
            padding-left: 20px;
            padding-right: 20px;
        }

        .navbar-nav {
            margin: 0 auto; /* Centers the navbar items */
        }
    </style>

</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>/admins/index"><i class="bi bi-house"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/organization">Organization</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/course">Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/pending_approval_staff">Pending Approval
                        Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/all_events">All Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/viewOutsideEvents">Outside Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/reward">Reward</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admins/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class="bi bi-box-arrow-right"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </header>
</body>

</html>
