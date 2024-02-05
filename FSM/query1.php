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

$actorName = ""; // Initialize the variable

if (isset($_POST["actorName"])) {
    $actorName = $_POST["actorName"];
    
    // Construct the SQL query to fetch actor details along with related information
    $sql = "SELECT actors.actor_name, actors.birth_date, actors.agent_name, actors.current_project
            FROM actors
            WHERE actors.actor_name = '$actorName'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the retrieved common and personal information
        $row = $result->fetch_assoc();
        echo "<h2 style='background-color: #ffc107; font-size: 24px; font-weight: bold; padding: 10px; margin-top: 20px;'>Actor Information for: " . $row["actor_name"] . "</h2>";
        echo "<p><strong>Birth Date:</strong> " . $row["birth_date"] . "</p>";
        echo "<p><strong>Agent Name:</strong> " . $row["agent_name"] . "</p>";
        echo "<p><strong>Current Project:</strong> " . $row["current_project"] . "</p>";
        
        // Construct another SQL query to fetch films associated with the actor
        $sql = "SELECT films.title, films.genre, films.run_time, directors.director_name,
                production.production_name, production.start_date, production.end_date, production.location,
                crew.contact_email
                FROM films
                INNER JOIN directors ON films.director_name = directors.director_name
                INNER JOIN production ON films.production_id = production.production_id
                INNER JOIN crew ON films.crew_name = crew.crew_name
                WHERE films.actor_name = '$actorName'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output the list of films associated with the actor
            echo "<h3 style='background-color: #ffc107; font-size: 18px; font-weight: bold; padding: 5px;'>Films Starring " . $row["actor_name"] . "</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "<h4 style='background-color: #ffc107; font-size: 16px; font-weight: bold; padding: 5px;'>Film Title: " . $row["title"] . "</h4>";
                echo "<p><strong>Genre:</strong> " . $row["genre"] . "</p>";
                echo "<p><strong>Run Time:</strong> " . $row["run_time"] . " minutes</p>";
                echo "<p><strong>Director:</strong> " . $row["director_name"] . "</p>";
                echo "<p><strong>Production Name:</strong> " . $row["production_name"] . "</p>";
                echo "<p><strong>Production Start Date:</strong> " . $row["start_date"] . "</p>";
                echo "<p><strong>Production End Date:</strong> " . $row["end_date"] . "</p>";
                echo "<p><strong>Production Location:</strong> " . $row["location"] . "</p>";
                echo "<p><strong>Contact Email:</strong> " . $row["contact_email"] . "</p>";
            }
        } else {
            echo "<p>No films found for actor: " . $actorName . "</p>";
        }
    } else {
        echo "<p>No actor found with the name: " . $actorName . "</p>";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Actor Information</title>
</head>
<body>
    <h1 style='background-color: #007bff; color: #fff; padding: 10px;'>Find Actor Information</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="actorName">Actor Name:</label>
        <input type="text" name="actorName" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>
