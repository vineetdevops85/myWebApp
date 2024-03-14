<?php
// Include the database configuration file
include 'dbconfig.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get engineer name from the form
    $engg_name = $_POST['engg_name'];

    // Insert data into the "engg" table
    $query = "INSERT INTO engg (engg) VALUES ('$engg_name')";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Engineer added successfully!";
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
    <title>Add Engineer</title>
</head>
<body>

<h2>Add Engineer</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Engineer Name: <input type="text" name="engg_name" required><br>
    <input type="submit" value="Add Engineer">
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
