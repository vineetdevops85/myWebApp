<?php
// Include the database configuration file
include 'dbconfig.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get market type from the form
    $market_name = mysqli_real_escape_string($connection, $_POST['market_name']);

    // Check if the market type already exists
    $check_query = "SELECT * FROM market WHERE market_name = '$market_name'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Error: market Type already exists!";
    } else {
        // Prepare and execute the SQL statement with a prepared statement
        $query = "INSERT INTO market (market_name) VALUES (?)";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $market_name);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Market added successfully!";
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
    <title>Add Market</title>
</head>
<body>

<h2>Market</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Market: <input type="text" name="market_name" required><br>
    <input type="submit" value="Add Market">
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
