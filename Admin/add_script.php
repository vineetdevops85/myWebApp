<?php
// Include the database configuration file
include 'dbconfig.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get script type from the form
    $script_type = mysqli_real_escape_string($connection, $_POST['script_type']);

    // Check if the script type already exists
    $check_query = "SELECT * FROM script WHERE script_type = '$script_type'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Error: Script Type already exists!";
    } else {
        // Prepare and execute the SQL statement with a prepared statement
        $query = "INSERT INTO script (script_type) VALUES (?)";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $script_type);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Script Type added successfully!";
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Script Type</title>
</head>
<body>

<h2>Script Type</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Script Type: <input type="text" name="script_type" required><br>
    <input type="submit" value="Add Script">
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
