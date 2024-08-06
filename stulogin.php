<?php
session_start(); // Start a session (if not already started)

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";

// Create a connection to the database
$mysqli = new mysqli($servername, $username, $password, $dbname,3307);

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
    $checkQuery = "SELECT * FROM student WHERE username = '$enteredUsername' AND pass = '$enteredPassword'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Login is successful
        $_SESSION["username"] = $enteredUsername; // Store username in a session variable
        header("Location: 2ndpage2.html"); // Redirect to the welcome page (update the path as needed)
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
  <link rel="stylesheet" href="stustyle.css">
  <script src="https://kit.fontawesome.com/ef5ece1789.js" crossorigin="anonymous"></script>
  <style>
.icon{
      color:black;
      text-decoration : none;
}
.back-button {
  margin-right:1000px;
}
.top-icons{
list-style:none;
margin:0;
padding:0;
text-align:right;
}
.top-icons li{
display:inline-block;
margin-left:10px;
}
.top-icons i{
font-size:24px;
color:#333;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>



<div class="container">
  <div class="form-box form">
  <nav>
        <ul class="top-icons">
          <li class="back-button"><a href="firsts.html" class="icon-link icon"><i class="fas fa-arrow-left"></i> </a></li>
          </ul>
      </nav>
    <center>
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
      Not a member? <a href="studentsignup.php">REGISTER NOW</a>
    </div>
    </center>
  </div>
</div>
</body>
</html>
