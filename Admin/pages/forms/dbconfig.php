<?php
// Database configuration settings
$db_host = "localhost";  // Your database host (usually "localhost" or an IP address)
$db_user = "root";   // Your database username
$db_password = ""; // Your database password
$db_name = "dttracker"; // Your database name

// Establish a connection to the database
$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the character set for the connection
mysqli_set_charset($connection, "utf8");

// Optionally, you can define other constants or settings related to your application here

?>
