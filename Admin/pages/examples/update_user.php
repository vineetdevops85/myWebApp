<?php
// Assuming you're using PHP to interact with your database
// Connect to your database
$conn = new mysqli('localhost', 'root', '', 'dttracker');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$userId = $_POST['userId'];
$editName = $_POST['editName'];
$editEmail = $_POST['editEmail'];
$editRole = $_POST['editRole'];

// Update user details in the database
$sql = "UPDATE users SET Name = '$editName', email = '$editEmail', role = '$editRole' WHERE id = $userId";

if ($conn->query($sql) === TRUE) {
    // If update successful, return success response
    echo json_encode(array('success' => 'User details updated successfully'));
} else {
    // If update failed, return error response
    echo json_encode(array('error' => 'Error updating user details: ' . $conn->error));
}

// Close the connection
$conn->close();
?>
