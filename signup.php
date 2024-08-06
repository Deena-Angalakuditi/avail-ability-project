<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}

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
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo '<script type="text/JavaScript">';
        echo 'alert("This email is already in use. Please choose a different one.")';
        echo '</script>';
    } else {
        // Prepare and execute the SQL query to insert data into the 'signup' table
        $insertQuery = "INSERT INTO signup (username, email, pass, conpass, dept, role) 
                        VALUES ('$username', '$email', '$password', '$conf_password', '$dept', '$role')";
        $insertResult = $mysqli->query($insertQuery);

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
