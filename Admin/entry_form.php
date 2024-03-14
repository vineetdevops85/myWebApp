<?php
// Include the database configuration file
include 'dbconfig.php';

// Fetch engineers from the "engg" table
$engg_sup_query = "SELECT * FROM engg";
$engg_sup_result = mysqli_query($connection, $engg_sup_query);

// Fetch Verifying Engineer from the "engg" table
$veri_engg_query = "SELECT * FROM engg";
$veri_engg_result = mysqli_query($connection, $veri_engg_query);

// Fetch radio models from the "radio" table
$radio_type_query = "SELECT * FROM radio";
$radio_type_result = mysqli_query($connection, $radio_type_query);

// Fetch script type from the "script" table
$script_type_query = "SELECT * FROM script";
$script_type_result = mysqli_query($connection, $script_type_query);

// Fetch market name from the "market" table
$market_name_query = "SELECT * FROM market";
$market_name_result = mysqli_query($connection, $market_name_query);

// Define arrays for other dropdown options
$status_options = ["Pending", "Approved", "Rejected"]; // Replace with your actual options

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $date = $_POST['date'];
    $market = $_POST['market'];
    $fa = $_POST['fa'];
    $siteid = $_POST['siteid'];
    $script_type = $_POST['script_type'];
    $radio_type = $_POST['radio_type'];
    $engg_sup = $_POST['engg_sup'];
    $description = $_POST['description'];
    $comments = $_POST['comments'];
    $status = $_POST['status'];
    $veri_engg = $_POST['veri_engg'];

    // Insert data into the "entry" table
    $query = "INSERT INTO entry (date, market, fa, siteid, script_type, radio_type, engg_sup, description, comments, status, veri_engg) VALUES ('$date', '$market', '$fa', '$siteid', '$script_type', '$radio_type', '$engg_sup', '$description', '$comments', '$status', '$veri_engg')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Data inserted successfully!";
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
    <title>Data Entry Form</title>
</head>
<body>

<h2>Data Entry Form</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Add your form fields here -->
    Data: <input type="date" name="date" required><br>
    Market: <select name="market">
    <?php while ($market_name_row = mysqli_fetch_assoc($market_name_result)): ?>
            <option value="<?php echo $market_name_row['market_name']; ?>"><?php echo $market_name_row['market_name']; ?></option>
        <?php endwhile; ?>
    </select><br>
    FA: <input type="text" name="fa" required><br>
    Site ID: <input type="text" name="siteid" required><br>
    Script Type: <select name="script_type">
    <?php while ($script_type_row = mysqli_fetch_assoc($script_type_result)): ?>
            <option value="<?php echo $script_type_row['script_type']; ?>"><?php echo $script_type_row['script_type']; ?></option>
        <?php endwhile; ?>
    </select><br>
    Radio Type: <select name="radio_type">
        <?php while ($radio_type_row = mysqli_fetch_assoc($radio_type_result)): ?>
            <option value="<?php echo $radio_type_row['radio_model']; ?>"><?php echo $radio_type_row['radio_model']; ?></option>
        <?php endwhile; ?>
    </select><br>
    Engg Sup: <select name="engg_sup">
        <?php while ($engg_sup_row = mysqli_fetch_assoc($engg_sup_result)): ?>
            <option value="<?php echo $engg_sup_row['engg']; ?>"><?php echo $engg_sup_row['engg']; ?></option>
        <?php endwhile; ?>
    </select><br>
    Description: <textarea name="description" rows="4" cols="50"></textarea><br>
    Comments: <textarea name="comments" rows="4" cols="50"></textarea><br>
    Status: <select name="status">
        <?php foreach ($status_options as $option): ?>
            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php endforeach; ?>
    </select><br>
    Veri Engg: <select name="veri_engg">
    <?php while ($veri_engg_row = mysqli_fetch_assoc($veri_engg_result)): ?>
            <option value="<?php echo $veri_engg_row['engg']; ?>"><?php echo $veri_engg_row['engg']; ?></option>
        <?php endwhile; ?>
    </select><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
