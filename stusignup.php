<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";

// Create a connection to the database
$mysqli = new mysqli($servername, $username, $password, $dbname, 4306);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conf_password = $_POST["conf_password"];

    // Check if the email or username already exists in the database
    $checkQuery = "SELECT * FROM singup WHERE email = '$username'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
      echo '<script type ="text/JavaScript">';  
        echo  'alert("THIS ID NUMBER IS ALREDY USED.")';
        echo '</script>';  
    } else {
        // Hash the password (you should use a secure password hashing method)
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert data into the 'signup' table
        $insertQuery = "INSERT INTO singup (username, email, pass, confpass) VALUES ('$username', '$email', '$password', '$conf_password')";
        $insertResult = $mysqli->query($insertQuery);

        if ($insertResult) {
            // Redirect to the login page upon successful registration
            header("Location: signin.php");
            exit; // Terminate the script to ensure redirection
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}

// Close the database connection
$mysqli->close();
?>


<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="stustyle.css">
  <script src="https://kit.fontawesome.com/ef5ece1789.js" crossorigin="anonymous"></script>
  <script>
    function validateForm() {
    var username=document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("conf_password").value;

      var exp=/^[Oo]\d.*$/;
      // if(username!= exp)
      // {
      //   alert ("ENTER VALID ID NUMBER");
      //   return false;
      //}

      if (password !== confirmPassword) {
        alert("Password and Confirm Password must match.");
        return false;
      }
      
      // Email validation using a regular expression
      var email = document.getElementById("email").value;
      var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
<div class="container">
  <div class="form-box">
    <h1 id="title">Sign Up</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateForm()">
      <div class="input-group">
        <div class="input-field" id="nameField">
          <i class="fa-solid fa-user"></i>
          <input type="text" placeholder="Id Number" id="username" name="username" required>
        </div>
        <div class="input-field">
          <i class="fa-regular fa-envelope"></i>
          <input type="email" placeholder="Email" id="email" name="email" required>
        </div>
        <div class="input-field">
          <i class="fa-solid fa-lock"></i>
          <input type="password" placeholder="Password" id="password" name="password" required>
        </div>
        <div class="input-field">
          <i class="fa-solid fa-lock"></i>
          <input type="password" placeholder="Confirm Password" name="conf_password" id="conf_password" required>
        </div>
        
        <div class="btn-field">
          <button type="submit">Sign Up</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
