<?php require APPROOT . '/views/admins/nav.php'; ?>
<html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        color: #333;
    }

    h1, h2 {
        color: #333;
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
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    button:active {
        background-color: #004080;
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

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
    }

    td {
        background-color: #f8f8f8;
    }

    /* Add more styles as needed */
    /* Add this to your existing reward.css file */

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

</style>
<head>
    <title>Reward</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admins/reward.css">
</head>
<body>
    <h2>Available Rewards</h2>
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
                    <a href="<?php echo URLROOT; ?>/admins/removeReward/<?php echo $reward->RewardID; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this reward?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
        