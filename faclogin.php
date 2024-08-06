<?php
session_start(); // Start a session (if not already started)

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";

// Create a connection to the database
$mysqli = new mysqli($servername, $username, $password, $dbname,4306);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query to check if the username and password match
    $checkQuery = "SELECT * FROM singup WHERE username = '$enteredUsername' AND pass = '$enteredPassword'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Login is successful
        $_SESSION["username"] = $enteredUsername; // Store username in a session variable
        header("Location: welcome.php"); // Redirect to the welcome page (update the path as needed)
        exit(); // Stop further execution of the script
    } else {
        // Login is not successful
        $loginError = "Invalid username or password. Please try again.";
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/ef5ece1789.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <div class="form-box">
    <h1 id="title">Login</h1>
    <?php if (isset($loginError)): ?>
    <p><?php echo $loginError; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="input-group">
        <div class="input-field" id="nameField">
          <i class="fa-solid fa-user"></i>
          <input type="text" placeholder="Username" name="username" required>
        </div>
        <div class="input-field">
          <i class="fa-solid fa-lock"></i>
          <input type="password" placeholder="Password" name="password" required>
        </div>
        <div class="btn-field">
          <button type="submit">Login</button>
        </div>
      </div>
    </form>
    <div class="recover">
      <a href="forgetpassword.php">Forgot Password</a>
    </div>
    <div class="member">
      Not a member? <a href="register.html">REGISTER NOW</a>
    </div>
  </div>
</div>
</body>
</html>
