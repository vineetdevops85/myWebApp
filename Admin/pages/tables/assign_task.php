<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each task
    foreach ($_POST['task_ids'] as $index => $taskId) {
        // Update assign_to column for the task
        $taskId = intval($taskId); // Convert task ID to integer
        $employeeId = intval($_POST['assign_to'][$index]); // Get corresponding employee ID
        $sql = "UPDATE entry SET assign_to = $employeeId, veri_engg = 'Assigned', status = 'Assigned' WHERE id = $taskId";
        if (!mysqli_query($connection, $sql)) {
            // Error handling
            echo "Error updating task $taskId.";
        }
    }
    echo "Tasks assigned successfully.";
} else {
    echo "No tasks to assign.";
}
?>
