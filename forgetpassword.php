<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";


$conn = new mysqli($servername, $username, $password, $dbname,3307);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
     $email = $_POST['email'];
     $check_email = "SELECT email FROM student WHERE email = '$email' LIMIT 1";
     $check_email_run = $conn->query($check_email);
     
     
//     echo $check_email_run;

    if($check_email_run->num_rows > 0){
        header("Location: resetpassword.php");
            exit(0);
    }
    else{
        $_SESSION['status'] = " No Email Found ";
        header("Location:forgetpassword.php");
        exit(0);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    
    input {
        background-color: transparent; 
        border: 1px solid black; 
        padding: 5px; 
        border-radius:10px;
    }
    body {
            display: flex;
            min-height: 100vh; /* Set minimum height of the viewport */
            margin: 0; /* Remove default body margin */
            align-items: center; /* Center items vertically */
            justify-content: center; /* Center items horizontally */
        }
.card{
    padding:50px;
    width:40vw;
    border:solid 1px rgb(90, 84, 84);
    border-radius:10px;
}
.submit{
    margin-top:12px;
}
</style>
</head>
<body >
    <center>
        <h1>Forgot Password</h1>
        <br>
        <div class=" alert alert-info mt-4 card">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="email" margin-right="5px">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit" class="submit btn btn-primary" name="submit">Submit</button>
    </form>
        </div>
    </center>
</body>