<?php
session_start(); // Start or resume the session

// Check if the user is logged in by checking if the email session variable is set
if (!isset($_SESSION["email"])) {
    // Redirect to the login page or display an error message
    header("Location: login.php"); // Redirect to the login page
    exit; // Terminate the script
}

$email = $_SESSION["email"]; // Retrieve the email from the session

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

// Fetch user details
$selectQuery = "SELECT username, dept, role, description FROM signup WHERE email = '$email'";
$result = $mysqli->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $dept = $row["dept"];
    $role = $row["role"];
    $description = $row["description"];
} else {
    die("User not found."); // Handle this case appropriately
}

// Check if the form is submitted to update the status and description
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["description"])) {
    $newStatus = $_POST["status"];
    $newDescription = $_POST["description"];

    // Update the status and description in the database
    $updateQuery = "UPDATE signup SET status = '$newStatus', description = '$newDescription' WHERE email = '$email'";
    if ($mysqli->query($updateQuery) === TRUE) {
        echo '<script type="text/JavaScript">';
        echo 'alert("Status and Description updated successfully.")';
        echo '</script>';
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Error updating status and description: ' . $mysqli->error . '")';
        echo '</script>';
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-transform: uppercase;
        }
        .container-3d {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .container-3d:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }
        .user-details {
            text-align: center;
            color: #333;
        }
        .user-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .user-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        .user-card .card-body {
            padding: 20px;
        }
        .user-card .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .user-card .card-text {
            font-size: 18px;
        }
        .status-label {
            font-weight: bold;
            margin-right: 10px;
        }
        .status-radio {
            margin-right: 10px;
        }
        .submit-button {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container container-3d">
        <h1 class="display-4 user-details">User Details</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="user-card">
                    <div class="card-body">
                        <h5 class="card-title">Username:</h5>
                        <p class="card-text"><?php echo $username; ?></p>
                    </div>
                </div>
                <div class="user-card">
                    <div class="card-body">
                        <h5 class="card-title">Department:</h5>
                        <p class="card-text"><?php echo $dept; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="user-card">
                    <div class="card-body">
                        <h5 class="card-title">Role:</h5>
                        <p class="card-text"><?php echo $role; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="a.php" method="post" class="mt-3">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <div class="form-group">
    <label class="status-label" for="status">Status:</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="active" value="Active" checked>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="absent" value="Absent" <?php if ($description == 'Absent') echo 'checked'; ?>>
            <label class="form-check-label" for="absent">On Leave</label>
        </div>
    </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="4"><?php echo $description; ?></textarea>
            </div>
            <div class="submit-button">
                <button type="submit" class="btn btn-primary">Update Status and Description</button>
            </div>
        </form>
    </div>
</body>
</html>
