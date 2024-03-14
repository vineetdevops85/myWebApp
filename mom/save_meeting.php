<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'mom';

// Connect to MySQL database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind parameters
$stmt = $conn->prepare("INSERT INTO meetings (title, responsible, status, agenda) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $responsible, $status, $agenda);

// Set parameters and execute for each row
for ($i = 0; $i < count($_POST['title']); $i++) {
    $title = $_POST['title'][$i];
    $responsible = $_POST['responsible'][$i];
    $status = $_POST['status'][$i];
    $agenda = $_POST['agenda'][$i];
    $stmt->execute();
}

// Close connection
$stmt->close();
$conn->close();

// Redirect back to the homepage after saving the meeting
header('Location: index.php');
exit;
?>