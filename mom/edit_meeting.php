<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'mom';

// Connect to MySQL database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $agenda = $_POST['agenda'];
    $title = $_POST['title'];

    // Update meeting status in the database
    $sql = "UPDATE meetings SET status='$status', agenda='$agenda', title='$title' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>