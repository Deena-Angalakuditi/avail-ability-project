<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "faculty";

// // Create a connection to the database
// $mysqli = new mysqli($servername, $username, $password, $dbname,3307);

// // Check connection
// if ($mysqli->connect_error) {
//     die("Connection failed: " . $mysqli->connect_error);
// }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new mysqli("localhost","root","","faculty",3307);
var_dump($con);
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conf_password = $_POST["conf_password"];
    $dept = $_POST["dept"];
    $role = $_POST["role"];
    // Check if the email already exists in the database
    $checkQuery = "SELECT * FROM signup WHERE email = '$email'";
    $checkResult = $con->query($checkQuery);
    var_dump($checkResult);
    if ($checkResult->num_rows > 0) {
        echo '<script type="text/JavaScript">';
        echo 'alert("This email is already in use. Please choose a different one.")';
        echo '</script>';
    } else {
        // Prepare and execute the SQL query to insert data into the 'signup' table
        $insertQuery = "INSERT INTO signup (username, email, pass, conpass, dept, role) 
                        VALUES ('$username', '$email', '$password', '$conf_password', '$dept', '$role')";
                        var_dump($insertQuery);
                        $insertResult = $con->query($insertQuery);
        var_dump($insertResult);
        if ($insertResult) {
            // Redirect to the login page upon successful registration
            header("Location: facultylogin.html");
            exit; // Terminate the script to ensure redirection
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}

// Close the database connection
$mysqli->close();
?>
