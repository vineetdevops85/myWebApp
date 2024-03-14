<?php
// Include the database configuration file
include 'dbconfig.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get engineer name from the form
    $radio_model = mysqli_real_escape_string($connection, $_POST['radio_model']);

    // Prepare and execute the SQL statement with a prepared statement
    $query = "INSERT INTO radio (radio_model) VALUES (?)";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $radio_model);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Radio added successfully!";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Radio</title>
</head>
<body>

<h2>Add Radio</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Radio Model: <input type="text" name="radio_model" required><br>
    <input type="submit" value="Add Radio">
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
