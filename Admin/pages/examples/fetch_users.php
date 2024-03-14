<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "dttracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch Name, email, and role from users table
$sql = "SELECT id, Name, email, role FROM users";
$result = $conn->query($sql);

// Store the fetched data in an associative array
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Close connection
$conn->close();

// Return the fetched data
echo json_encode($users);
?>
