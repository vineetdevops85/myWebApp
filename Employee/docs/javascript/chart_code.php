<?php
$query = "SELECT status, COUNT(*) AS count FROM entry GROUP BY status";
$result = mysqli_query($connection, $query);

$dataPoints = array();

// Define colors for each status
$colorMapping = array(
    "Approved" => "green",
    "Pending" => "orange",
    "Rejected" => "red",
    "In-Progress" => "purple",
    "Assigned" => "skyblue"
);

// Format data into the required structure with colors
while($row = mysqli_fetch_assoc($result)) {
    $status = $row['status'];
    $count = $row['count'];
    // Check if the status has a predefined color, otherwise default to black
    $color = isset($colorMapping[$status]) ? $colorMapping[$status] : "black";
    $dataPoints[] = array("y" => $count, "label" => $status, "color" => $color);
}
?>