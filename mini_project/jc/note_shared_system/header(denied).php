<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Note Sharing System</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS to hide header on scroll */
        .fixed-header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #ff6f61; /* Customize the background color */
            padding: 15px 0;
            text-align: center;
            display: block;
            transition: top 0.3s;
            z-index: 1000;
        }

        .hidden-header {
            top: -75px; /* Adjust as needed to completely hide the header */
        }

        .header-text {
            color: #fff; /* Customize the text color */
            font-size: 36px; /* Customize the font size */
            font-family: 'Comic Sans MS', cursive; /* Customize the font style */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to handle hiding/showing the header on scroll
        let prevScrollPos = window.pageYOffset;
        window.onscroll = function () {
            const currentScrollPos = window.pageYOffset;
            const header = document.querySelector(".fixed-header");
            if (prevScrollPos > currentScrollPos) {
                header.style.top = "0";
            } else {
                header.style.top = "-75px"; // Hides the header
            }
            prevScrollPos = currentScrollPos;
        }
    </script>
</head>
<body>
    <div class="fixed-header">
        <h1 class="header-text">My Note Sharing System</h1>
    </div>
</body>
</html>

