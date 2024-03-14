<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .close-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .close-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'dbconfig.php';

        if (isset($_POST['id']) && isset($_POST['status'])) {
            $taskId = $_POST['id'];
            $status = $_POST['status'];

            session_start();
            $userId = $_SESSION['user_id'];

            // Fetch the name of the user who is submitting the action
            $userSql = "SELECT name FROM users WHERE id = $userId";
            $userResult = mysqli_query($connection, $userSql);
            $userName = mysqli_fetch_assoc($userResult)['name'];

            // Update status and veri_engg columns in the entry table
            $sql = "UPDATE entry SET status = '$status', veri_engg = '$userName' WHERE id = $taskId";
            if (mysqli_query($connection, $sql)) {
                echo "<p>Your <strong>$status</strong> status updated successfully.</p>";
            } else {
                echo "<p>Error updating status and veri_engg: " . mysqli_error($connection) . "</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }
        ?>
        <div class="button-container">
            <button class="close-button" onclick="window.close()">Close Window</button>
        </div>
    </div>
</body>
</html>
