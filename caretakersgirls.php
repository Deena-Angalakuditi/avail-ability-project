<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.message{
    font-size:30px;
    padding:20px;
    margin:50px;
}
.heading{
    text-align:center;
    font-size:50px;
}
</style>
</head>
<body>
    <div class = "container">
        <br>
        <h1 class = "mt-4 heading">CareTakers in duty - Girls</h1>
        <br><br>
        <?php
        //Database connectio details
        $servername = "localhost";
        $username="root";
        $password = "";
        $dbname = "caretakers";

        // Create a connection to the database
        $conn = new mysqli($servername , $username,$password,$dbname,3307);

        //Check the database connection
        if ($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }
    
        

        date_default_timezone_set("Asia/Kolkata");

        $currentHour = date('H');
        
        $shift=0;
        if (($currentHour >=6 && $currentHour <14)){
            $shift = 1;
        }elseif(($currentHour >=14 && $currentHour <22)){
            $shift = 2;
        }elseif(($currentHour >=22 && $currentHour<6)){
            $shift = 3;
        }
        
        //Calculate the day based on the current system day
        $daysOfWeek = ["MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY","SUNDAY"];
        $currentDayIndex = date("w")-1;

        

        
        //Get the day name
        $day = $daysOfWeek[$currentDayIndex];
        


        //SQL query
        $sql = "SELECT $day FROM GIRLS WHERE SHIFT = $shift";

        
        $result = $conn->query($sql);      
        $row = $result->fetch_assoc();
        $ctname = $row[$day];
        //Display
        echo'<div class="alert alert-info mt-4 message">';
        if(isset($ctname)){
            echo "Care Taker - $ctname is in the duty<br><br>Details:<br><br><br><br>";
        }
        echo '</div>';

        //Close the database connection
        $conn->close();
    ?>
</body>
</html>