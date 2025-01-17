<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Background color for the body */
        }
        .container {
            margin-top: 20px;
            background-color: #ffffff; /* Background color for the container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for the container */
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-input {
            width: 300px;
            padding: 10px;
            border: 2px solid #007BFF; /* Border color for the input */
            border-radius: 20px; /* Rounded corners for the input */
        }
        .search-input:focus {
            outline: none;
            box-shadow: 0 0 10px #007BFF; /* Box shadow when input is focused */
        }
        .btn-search {
            background-color: #007BFF; /* Background color for the search button */
            color: #fff; /* Text color for the search button */
            border: none;
            border-radius: 20px; /* Rounded corners for the button */
            transition: background-color 0.2s; /* Smooth hover effect */
        }
        .btn-search:hover {
            background-color: #0056b3; /* Background color on hover */
        }
        .table {
            background-color: #fff; /* Background color for the table */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Box shadow for the table */
        }
        .table th,
        .table td {
            vertical-align: middle; /* Center the content vertically */
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5; /* Background color on hover */
            cursor: pointer;
        }
        .text-highlight {
            background-color: yellow; /* Background color for highlighted text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-4 text-center">Faculty Information</h1>
        <div class="search-container">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control search-input" placeholder="Search by username">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-search"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
    <tbody>
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "faculty";
                
                // Create a connection to the database
                $conn = new mysqli($servername, $username, $password, $dbname, 3307);
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Initialize variables for search functionality
                $searchQuery = "";
                if (isset($_POST["search"])) {
                    $searchQuery = $_POST["search"];
                }
                
                // Fetch user details based on the search query
                $selectQuery = "SELECT username, dept, role, status, description FROM signup WHERE role='lab_assistant'";
                
                $result = $conn->query($selectQuery);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $username = $row["username"];
                        $highlightedUsername = preg_replace("/$searchQuery/i", "<span class='text-highlight'>$0</span>", $username);
                        echo "<tr>";
                        echo "<td>" . $highlightedUsername . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "<td>" . $row["dept"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
