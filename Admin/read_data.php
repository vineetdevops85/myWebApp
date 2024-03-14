<?php
// Include the database configuration file
include 'dbconfig.php';

// Fetch data from the "entry" table
$query = "SELECT * FROM entry";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data</title>
    <style>
        .badge {
            font-size: 14px;
            font-weight: normal;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #000;
            radius: 3px;
        }

        .bg-success {
            background-color: #28a745;
            color: #fff;
            radius: 3px;
        }

        .bg-danger {
            background-color: #dc3545;
            color: #fff;
            radius: 3px;
        }
    </style>
</head>
<body>

<h2>Read Data</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Market</th>
        <th>FA</th>
        <th>Site ID</th>
        <th>Script Type</th>
        <th>Radio Type</th>
        <th>Engg Sup</th>
        <th>Description</th>
        <th>Comments</th>
        <th>Status</th>
        <th>Veri Engg</th>
    </tr>

    <?php
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['market'] . "</td>";
        echo "<td>" . $row['fa'] . "</td>";
        echo "<td>" . $row['siteid'] . "</td>";
        echo "<td>" . $row['script_type'] . "</td>";
        echo "<td>" . $row['radio_type'] . "</td>";
        echo "<td>" . $row['engg_sup'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['comments'] . "</td>";
        // Display status with colored badges
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
            default:
                echo $row['status'];
                break;
        }
        echo "</td>";
        echo "<td>" . $row['veri_engg'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
