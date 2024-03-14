<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these variables with your actual database credentials
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'dttracker';

    try {
        // Establish a connection to the database
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve data from the form
        $tag = $_POST['tag'];
        $details = $_POST['details'];
        
        // Upload the image to a directory on your server
        $uploadDirectory = 'uploads/';
        $uploadedFileName = $uploadDirectory . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFileName);

        // Prepare the SQL query
        $sql = "INSERT INTO topic (tag, image, details) VALUES (:tag, :imagePath, :details)";
        
        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':tag', $tag);
        $stmt->bindParam(':imagePath', $uploadedFileName);
        $stmt->bindParam(':details', $details);

        // Execute the query
        $stmt->execute();

        // echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}
?>
