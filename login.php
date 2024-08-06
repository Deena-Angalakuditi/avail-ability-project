<?php
session_start(); // Start a new or resume the existing session

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
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email and password match a record in the database
    $checkQuery = "SELECT * FROM signup WHERE email = '$email' AND pass = '$password'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Fetch the user's name from the result
        $row = $checkResult->fetch_assoc();
        $username = $row["username"];

        // Store the email in a session variable
        $_SESSION["email"] = $email;

        // Redirect to a.php after successful login
        header("Location: a.php");
        exit; // Terminate the script to ensure redirection
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Invalid email or password. Please try again.")';
        echo '</script>';
    }
}

// Close the database connection
$mysqli->close();
?>
<!-- The rest of your HTML code for the login form -->
