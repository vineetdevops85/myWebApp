<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star of the Month</title>
    <style>
        /* Add your CSS styles here */
        .star-wrapper {
            text-align: center;
            margin-top: 50px;
        }
        .star-photo {
            width: 150px; /* Adjust the size as needed */
            border-radius: 50%;
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dttracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Your SQL query here
$sql = "SELECT engg_sup, COUNT(*) AS entry_count, file_paths
        FROM entry
        WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())
        GROUP BY engg_sup
        ORDER BY entry_count DESC
        LIMIT 1";

$result = $conn->query($sql);

// Assuming $result is the result of your SQL query
if ($result) {
    $row = $result->fetch_assoc();
    $engg_sup = $row['engg_sup'];
    $entry_count = $row['entry_count'];
    $file_paths = $row['file_paths'];

    echo '<div class="star-wrapper">';
    echo '<h2>Congratulations!</h2>';
    echo "<p>$engg_sup is the Star of the Month</p>";
    echo "<img src='$file_paths' alt='$engg_sup' class='star-photo'>";
    echo "<p>$engg_sup - Scripting Count: $entry_count</p>";
    echo '</div>';
} else {
    echo '<p>No results found for the Star of the Month.</p>';
}

// Close your database connection
$conn->close();
?>
</body>
</html>
