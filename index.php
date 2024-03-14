<?php
session_start();

// Assuming you have a database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "dttracker";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alert_message = ""; // Initialize alert message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the user
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, set session variables and redirect
        $row = $result->fetch_assoc();
        $_SESSION["user_email"] = $row["email"];
        $_SESSION["user_role"] = $row["role"];
        $_SESSION["user_id"] = $row["id"];

        // Redirect based on user role
        if ($_SESSION["user_role"] == "admin") {
            header("Location: Admin/");
            exit(); // Make sure to exit after redirection
        } elseif ($_SESSION["user_role"] == "employee") {
            header("Location: Employee/");
            exit(); // Make sure to exit after redirection
        } else {
            // Handle other roles or scenarios if needed
        }
    } else {
        // Invalid login, set alert message
        $alert_message = "Invalid email or password. Please try again.";
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <title>Login || Alarm Management System (ASM)</title>
    <style>
          .alert {
          background-color: #c70b0b;
          border-radius: 5px;
          color: white; /* Adding white text color for better visibility */
          padding: 10px; /* Adding padding for better spacing */
      }
    </style>
  </head>
  <body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p>Alarm Management System (ASM) V 2.0.1</p>
            </div>
            <form action="index.php" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="email" class="form-control" id="username" name="email" required>

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
            </div>
            <?php if (!empty($alert_message)) { ?>
                <div class="alert" role="alert">
                    <?php echo $alert_message; ?>
                </div>
            <?php } ?>
            <input type="submit" value="Log In" class="btn btn-block btn-primary">
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>