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
    <div class="container">
        <br>
        <h1 class="mt-4 heading">CareTakers in Duty - Boys</h1>
        <br>
        <?php

        //Data base conneting details
        $servername = "localhost";
        $username="root";
        $password="";
        $dbname="caretakers";

        //Create a connection to the data base
        $conn = new mysqli($servername , $username , $password , $dbname, 3307);

        // Check the data base connection
        if ($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }

        date_default_timezone_set("Asia/Kolkata");

        $currentHour = date("H");

        $shift = 0;
        if($currentHour>=6 && $currentHour <14){
            $shift = 1;
        }elseif($currentHour>=14 && $curentHour < 22){
            $shift=2;
        }elseif($currentHour>=22 && $currentHour<6){
            $shift = 3;
        }


        $daysOfWeek = ["MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY","SUNDAY"];
        $currentDayIndex= date("w")-1;

        //get the day name
        $day=$daysOfWeek[$currentDayIndex];

        // get the name of staff
        $sql = "SELECT $day FROM BOYS WHERE SHIFT = $shift";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $ctname = $row[$day];

        //DISPLAY
        
        if($ctname==14){
            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-1 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';

            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-4 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';
        }elseif($ctname==25){
            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-2 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';

            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-5 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';
        }elseif($ctname==31){
            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-3 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';

            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-1 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';
        }elseif($ctname==42){
            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-4 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';

            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-2 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';
        }elseif($ctname==53){
            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-5 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';

            echo'<div class = "alert alert-info mt-4 message">';
            echo "CareTaker-3 is in the duty  <br> <br>Details : <br><br>";
            echo'</div>';
        }
        //close the database connection
        $conn->close();
    ?>
</body>
</html>
