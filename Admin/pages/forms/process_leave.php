<?php
session_start();

// Check if the user is not logged in or not authorized, redirect to the login page
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Include the database configuration file
include 'dbconfig.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the action parameter is set and valid
    if (isset($_POST['action']) && ($_POST['action'] == 'approve' || $_POST['action'] == 'reject')) {
        // Get the leave request ID from the form
        $leave_id = $_POST['leave_id'];

        // Update the leave request status based on the action
        $status = ($_POST['action'] == 'approve') ? 'Approved' : 'Rejected';
        $update_query = "UPDATE leave_request SET status = '$status' WHERE id = $leave_id";
        $update_result = mysqli_query($connection, $update_query);

        if ($update_result) {
            // Redirect back to the leave approval page after processing
            header("Location: leave_approval.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}
?>
