<?php
include 'dbconfig.php';

if (isset($_POST['id'])) {
    $taskId = $_POST['id'];

    // Fetch task details based on task ID
    $sql = "SELECT * FROM entry WHERE id = $taskId";
    $result = mysqli_query($connection, $sql);

    // Display task details and form for updating status
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div style='border: 1px solid #ccc; border-radius: 5px; padding: 20px; background-color: #f9f9f9;'>";
        echo "<h2 style='margin-bottom: 20px; font-size: 24px; color: #333;'>Task Details</h2>";
        echo "<p><strong>Task ID:</strong> " . $row['id'] . "</p>";
        echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
        echo "<p><strong>Market:</strong> " . $row['market'] . "</p>";
        echo "<p><strong>Comments:</strong> " . $row['comments'] . "</p>";
        $file_paths = $row['file_paths'];

// Check if there are multiple file paths
if (strpos($file_paths, ',') !== false) {
    // If there are multiple file paths, explode the string to get an array of file paths
    $file_paths_array = explode(',', $file_paths);

    // Output a list of attachments
    echo '<p><strong>Attachments:</strong></p>';
    echo '<ul>';
    foreach ($file_paths_array as $file_path) {
        echo '<li><a href="/amdocs/Employee/pages/forms/media/' . trim($file_path) . '" target="_blank">' . trim($file_path) . '</a></li>';
    }
    echo '</ul>';
} else {
    // If there's only one file path, display it as before
    echo '<p><strong>Attachment:</strong> <a href="/amdocs/Employee/pages/forms/media/' . $file_paths . '" target="_blank">' . $file_paths . '</a></p>';
}
echo "<p><strong>Verification Status:</strong> ";
echo "<td>";
switch ($row['status']) {
    case 'Pending':
        echo '<span class="badge bg-warning">' . $row['status'] . '</span>';
        break;
    case 'Approved':
        echo '<span class="badge bg-success">' . $row['status'] . '</span>';
        break;
    case 'Rejected':
        echo '<span class="badge bg-danger">' . $row['status'] . '</span>';
        break;
    case 'Assigned':
        echo '<span class="badge bg-info">' . $row['status'] . '</span>';
        break; 
    case 'In-Progress':
        echo '<span class="badge bg-orange">' . $row['status'] . '</span>';
        break;   
    default:
        echo $row['status'];
        break;
}
echo "</td></p>";
        // Add other task fields here

        // Form for updating status
        echo "<form action='update_status.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<label for='status' style='display: block; margin-top: 20px; font-size: 16px; color: #333;'>Select Action:</label>";
        echo "<div style='display: inline-block; margin-bottom: 20px;'>";
echo "<select name='status' id='status' style='padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;'>";
echo "<option value='Approved'>Approved</option>";
echo "<option value='Rejected'>Rejected</option>";
echo "<option value='In-Progress'>In-Progress</option>";
echo "</select>";
echo "<button type='submit' style='padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 5px; font-size: 16px; margin-left: 10px;'>Submit</button>";
echo "</div>";

        echo "</form>";
        echo "</div>";
    } else {
        echo "Task not found.";
    }
} else {
    echo "Invalid request.";
}
?>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Include Font Awesome library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-oC7/xNHoUd/KuZ1X6Qn5FTtPLSBDLkDfNTEdSaAM8Ck1EYLShOj0D2P0eMq6B2ZV" crossorigin="anonymous">