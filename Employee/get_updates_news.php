<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dttracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM updates ORDER BY latest_update DESC LIMIT 10"; // Adjust the limit as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="news-content">';
    $classes = ['text-one', 'text-two', 'text-three', 'text-four', 'text-five', 'text-six', 'text-seven', 'text-eight', 'text-nine', 'text-ten'];
    $i = 0;

    while ($row = $result->fetch_assoc()) {
        $class = $classes[$i % count($classes)]; // Cycle through the classes

        // Check if the update was today
        $today = date("Y-m-d");
        $updateDate = date("Y-m-d", strtotime($row["latest_update"]));
        $isNew = ($today == $updateDate) ? ' <span class="new-badge">New</span>' : '';

        echo '<div class="update-item ' . $class . '">';
        echo $row["date"]. ' - ' . $row["latest_update"] . $isNew;
        echo '</div>';
        $i++;
    }

    echo '</div>';
} else {
    echo 'No updates available.';
}

$conn->close();
?>
