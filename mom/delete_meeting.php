<?php
// Database connection details
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

// Check if meeting ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to delete meeting
    $sql = "DELETE FROM meetings WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Meeting deleted successfully
        echo "Meeting deleted successfully";
    } else {
        // Error deleting meeting
        echo "Error deleting meeting: " . $conn->error;
    }
} else {
    // No meeting ID provided
    echo "No meeting ID provided";
}

// Close database connection
$conn->close();
?>
