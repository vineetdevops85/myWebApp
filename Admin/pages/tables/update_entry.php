<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dttracker";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $id = $_POST['id']; // Assuming you have an 'id' field in your form

        $market = $_POST['market'];
        $fa = $_POST['fa'];
        $siteid = $_POST['siteid'];
        $date = $_POST['date'];
        $script_type = $_POST['script_type'];
        $engg_sup = $_POST['engg_sup'];
        $veri_engg = $_POST['veri_engg'];
        $radio_type = $_POST['radio_type'];
        $description = $_POST['description'];
        $comments = $_POST['comments'];
        $status = $_POST['status'];

        // Update query
        $update_query = "UPDATE entry SET
                        market = '$market',
                        fa = '$fa',
                        siteid = '$siteid',
                        date = '$date',
                        script_type = '$script_type',
                        engg_sup = '$engg_sup',
                        veri_engg = '$veri_engg',
                        radio_type = '$radio_type',
                        description = '$description',
                        comments = '$comments',
                        status = '$status'
                        WHERE ID = $id";

        if ($connection->query($update_query) === TRUE) {
            // Redirect to data.php after successful update
            header("Location: data.php");
            exit();
        } else {
            echo "Error updating record: " . $connection->error;
        }
    } else {
        echo "Invalid request!";
    }

    $connection->close();
?>
