<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty";


$conn = new mysqli($servername, $username, $password, $dbname,3307);
var_dump($conn);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sent_password_reset($get_name,$get_email,$token){
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', $get_name);
    $mail->addAddress('joe@example.net', $get_email );     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Availability Reset Password';

    $email_template = "
        <h2> Hello</h2>
        <h3> You are recieving this email because we received a password reset reuest for your account.</h3>
        <br><br>
        <a href='http://locals
    "
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
}


if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn,$POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM student WHERE email = '$email' LIMIT 1";
    $check_email_run = mysqli_query($conn,$check_email);

    if(mysqli_num_rows($$check_email_run)>0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['username'];
        $get_email = $row['email'];

        $update_token = "UPDATE student SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn,$update_token);

        if($update_token_run){
            send_password_reset($get-name,$get_email,$token);
            $S_SESSION['status']="We e-mailed you a password reset link";
            header("Location: forgetpassword.html");
            exit(0);
        }
        else{
            $_SESSION['status']="Something went wrong .#1";
            header("Location: pa")
        }
    }
    else{
        $_SESSION['status'] = "No Email Found";
        header("Location:forgetpassword.html");
        exit(0);
    }
}

?>

























