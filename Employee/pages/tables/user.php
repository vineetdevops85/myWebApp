<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_email'])) {
    header("Location: ../index.php");
    exit();
}

// Include the database configuration file
include 'dbconfig.php';

// Now, fetch the name of the logged-in user
$loggedInUserName = ""; // Initialize the variable
if (isset($_SESSION['user_email'])) {
    $loggedInUserEmail = $_SESSION['user_email'];
    // Assuming you have a table named 'users' with a column 'email' and 'name'
    $user_query = "SELECT name FROM users WHERE email = '$loggedInUserEmail'";
    $user_result = mysqli_query($connection, $user_query);
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $loggedInUserName = $user_row['name'];
    }
}
?>

