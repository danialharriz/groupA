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
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #495057;
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
            background-color: #007bff;
            color: #ffffff;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 5px;
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
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
