<?php
// Check if the id parameter is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the id parameter to prevent SQL injection
    $id = intval($_GET['id']);

    // Connect to your database
    $conn = new mysqli('localhost', 'root', '', 'dttracker');
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to delete the user with the given id
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind the id parameter to the SQL statement
    $stmt->bind_param("i", $id);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // User deleted successfully
        // Redirect back to users.php
        header("Location: users.php");
        exit(); // Make sure to exit after redirection
    } else {
        // Error occurred while deleting the user
        echo "Error deleting user: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect or display an error message if the id parameter is missing
    echo "User id is missing.";
}
?>
