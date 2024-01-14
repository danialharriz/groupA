<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>

<head>
    <title>Reward</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/reward.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        /* Custom CSS styles */

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .container7 {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #FCBD32;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: #333;
        }

        button {
            padding: 10px 20px;
            background-color: #239B56;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1C8148;
        }

        button:active {
            background-color: #156438;
        }

        button:focus {
            outline: none;
            box-shadow: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #183D64;
            color: #ffffff;
        }

        td {
            background-color: #f8f8f8;
        }

        .delete-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .delete-button:active {
            background-color: #bd2130;
        }

        .delete-button:focus {
            outline: none;
            box-shadow: none;
        }

        .back-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container7">
        <h1>Available Rewards</h1>
        <table>
            <tr>
                <th>Reward Name</th>
                <th>Reward Points</th>
                <th>Action</th>
            </tr>
            <form action="<?php echo URLROOT; ?>/admins/reward" method="post">
                <tr>
                    <td><input type="text" name="rewardName" id="rewardName" required></td>
                    <td><input type="number" name="rewardPoints" id="rewardPoints" required></td>
                    <td><button type="submit">Add</button></td>
                </tr>
            </form>
            <?php foreach ($data['rewards'] as $reward) : ?>
                <tr>
                    <td><?php echo $reward->RewardName; ?></td>
                    <td><?php echo $reward->RewardPoints; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/admins/removeReward/<?php echo $reward->RewardID; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this reward?')">
                            <i class="uil uil-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

<script>
    function goBack() {
        history.back();
    }
</script>

</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>
