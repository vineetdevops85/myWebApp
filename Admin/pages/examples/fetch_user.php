<?php
// Assuming you're using PHP to interact with your database
// Connect to your database
$conn = new mysqli('localhost', 'root', '', 'dttracker');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the GET request
$userId = $_GET['id'];

// Perform SQL query to fetch user details
$sql = "SELECT Name, email, role FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, return details as JSON
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    // User not found
    echo json_encode(array('error' => 'User not found'));
}

// Close the connection
$conn->close();
?>
