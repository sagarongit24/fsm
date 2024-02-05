<?php
// Database connection settings
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "film_studio";

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filmName = ""; // Initialize the variable
$filmNotFound = false; // Initialize a variable to track if the film was not found

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["filmName"])) {
        $filmName = $_POST["filmName"];
        
        // Construct the SQL query to fetch film details along with related information
        $sql = "SELECT films.title, films.genre, films.run_time, directors.director_name, actors.actor_name, 
                production.production_name, production.start_date, production.end_date, production.location, 
                crew.contact_email
                FROM films
                INNER JOIN directors ON films.director_name = directors.director_name
                INNER JOIN actors ON films.actor_name = actors.actor_name
                INNER JOIN production ON films.production_id = production.production_id
                INNER JOIN crew ON films.crew_name = crew.crew_name
                WHERE films.title = '$filmName'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Output the retrieved information
            while ($row = $result->fetch_assoc()) {
                echo "<h2>Film Information for: " . $row["title"] . "</h2>";
                echo "<p><strong>Director:</strong> " . $row["director_name"] . "</p>";
                echo "<p><strong>Genre:</strong> " . $row["genre"] . "</p>";
                echo "<p><strong>Run Time:</strong> " . $row["run_time"] . " minutes</p>";
                echo "<p><strong>Actor:</strong> " . $row["actor_name"] . "</p>";
                echo "<p><strong>Production Name:</strong> " . $row["production_name"] . "</p>";
                echo "<p><strong>Production Start Date:</strong> " . $row["start_date"] . "</p>";
                echo "<p><strong>Production End Date:</strong> " . $row["end_date"] . "</p>";
                echo "<p><strong>Production Location:</strong> " . $row["location"] . "</p>";
                echo "<p><strong>Contact Email:</strong> " . $row["contact_email"] . "</p>";
            }
        } else {
            $filmNotFound = true; // Set the flag to indicate film not found
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Film Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
        }

        form {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 300px;
            padding: 5px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 5px 15px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            background-color: #ffc107;
            font-size: 24px;
            font-weight: bold;
            padding: 10px;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
        }

        strong {
            font-weight: bold;
        }

        .film-not-found {
            color: red;
            font-weight: bold;
        }

        .back-button {
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 5px 15px;
            border: none;
            cursor: pointer;
        }

        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Find Film Information</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="filmName">Film Name:</label>
        <input type="text" name="filmName" required>
        <input type="submit" value="Search">
    </form>
    
    <?php
    if ($filmNotFound) {
        echo "<p class='film-not-found'>No film found with the name: " . $filmName . "</p>";
    }
    ?>
    
    <div class="back-button">
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
