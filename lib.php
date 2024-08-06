<!DOCTYPE html>
<html>
<head>
    <title>Class Lookup</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Class Lookup</h1>

        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "o19";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname, 3307);

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		
        // User inputs from the form
        $branch = $_POST['branch'];
        $section = $_POST['section'];
        date_default_timezone_set("Asia/Kolkata");

        // Calculate the period based on the current system time
        $currentHour = date("H");
        $currentMinute = date("i");
        
        $period = 0;

        if (($currentHour == 9 && $currentMinute >= 30) || ($currentHour == 10 && $currentMinute < 30)) {
            $period = 1;
        } elseif (($currentHour == 10 && $currentMinute >= 30) || ($currentHour == 11 && $currentMinute < 30)) {
            $period = 2;
        } elseif (($currentHour == 11 && $currentMinute >= 30) || ($currentHour == 12 && $currentMinute < 30)) {
            $period = 3;
        } elseif (($currentHour == 13 && $currentMinute >= 30) || ($currentHour == 14 && $currentMinute < 30)) {
            $period = 4;
        } elseif (($currentHour == 14 && $currentMinute >= 30) || ($currentHour == 15 && $currentMinute < 30)) {
            $period = 5;
        } elseif (($currentHour == 15 && $currentMinute >= 30) || ($currentHour == 16 && $currentMinute < 55)) {
            $period = 6;
        } elseif ($currentHour == 16 && $currentMinute >= 55 ) {
            $period = 7;
        }
        
        // Calculate the day based on the current system day
        $daysOfWeek = ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
        $currentDayIndex = date("w"); // Returns 0 for Sunday, 1 for Monday, etc.
        
        // Get the day name
        $day = $daysOfWeek[$currentDayIndex];
        
        // Check if the current day is Sunday
        if ($currentDayIndex == 0) {
            echo '<div class="alert alert-warning mt-4">No classes today (Sunday).</div>';
        } else {
            // SQL query to retrieve the class based on user inputs, calculated period, and day
            $sql = "SELECT $day FROM timetable WHERE BRANCH = '$branch' AND SECTION = '$section' AND PERIOD = $period ";
          
            
            // Execute the query


            $result = $conn->query($sql);
            
            
            

            if ($result->num_rows > 0) {
                // Class found, retrieve and store it
                $row = $result->fetch_assoc();
                
                $className = $row[$day];
                
            } else {
                // Class not found, set className to a message indicating no class
                $className = "No class found";
            }

            // Display the result using Bootstrap styles
            echo '<div class="alert alert-info mt-4">';
            if (isset($className)) {
                echo "Class for Period $period on $day in Branch $branch, Section $section: $className";
            } else {
                echo "No class found for Period $period on $day in Branch $branch, Section $section";
            }
            echo '</div>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Add Bootstrap JavaScript and jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
