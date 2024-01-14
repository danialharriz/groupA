<?php require APPROOT . '/views/students/nav.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #FCBD32; /* Updated color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        h1 {
            color: #183D64; /* Updated color */
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #7C1C2B; /* Updated color */
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #183D64; /* Updated color */
            color: #ffffff;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 5px;
        }

        .button-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $data['title']; ?></h1>
        <form action="" method="POST">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" rows="5" placeholder="Enter your feedback" required></textarea>
            <?php if (!empty($data['feedbackError'])) : ?>
                <p class="error-message"><?php echo $data['feedbackError']; ?></p>
            <?php endif; ?>
            <div class = "button-container">
            <button type="submit"><span class="icon">🚀</span>Submit Feedback</button>
            </div>
        </form>

        <br>
        <div style = "text-align: center;">
            <button onclick="window.history.back()" style = "background-color: #630E25;"><i class="bi bi-arrow-left-circle"></i> Back</button>
        </div>
    </div>
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
