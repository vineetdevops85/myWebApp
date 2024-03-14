<?php
// session_start();

// // Check if the user is not logged in or not authorized, redirect to the login page
// if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("Location: /amdocs/index.php");
//     exit();
// }

// Include the database configuration file
include 'dbconfig.php';

// Fetch leave requests from the database
$leave_query = "SELECT * FROM leave_request";
$leave_result = mysqli_query($connection, $leave_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Approval</title>
</head>
<body>

<h2>Leave Approval</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>User Email</th>
        <th>Leave Type</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($leave_result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['user_email'] . "</td>";
        echo "<td>" . $row['leave_type'] . "</td>";
        echo "<td>" . $row['leave_start_date'] . "</td>";
        echo "<td>" . $row['leave_end_date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>";
        echo "<form method='POST' action='process_leave.php'>";
        echo "<input type='hidden' name='leave_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='action' value='approve'>Approve</button>";
        echo "<button type='submit' name='action' value='reject'>Reject</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
