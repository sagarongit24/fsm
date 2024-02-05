<!DOCTYPE html>
<html>
<head>
    <title>Edit Production</title>
    <link rel="stylesheet" type="text/css" href="production.css">
</head>
<body>
    <h1>Edit Production</h1>

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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["production_id"])) {
        $production_id = $_GET["production_id"];

        // Query to retrieve the production's information based on production_id
        $sql = "SELECT * FROM production WHERE production_id = $production_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Display a form with pre-filled data for editing
            echo "<form action='update_production.php' method='post'>
                <input type='hidden' name='production_id' value='$production_id'>
                <label for='production_name'>Production Name:</label>
                <input type='text' id='production_name' name='production_name' value='" . $row["production_name"] . "' required><br>

                <label for='start_date'>Start Date:</label>
                <input type='date' id='start_date' name='start_date' value='" . $row["start_date"] . "'><br>

                <label for='end_date'>End Date:</label>
                <input type='date' id='end_date' name='end_date' value='" . $row["end_date"] . "'><br>

                <label for='location'>Location:</label>
                <input type='text' id='location' name='location' value='" . $row["location"] . "'><br>

                <label for='budget'>Budget:</label>
                <input type='number' id='budget' name='budget' value='" . $row["budget"] . "'><br>

                <input type='submit' value='Update Production'>
            </form>";
        } else {
            echo "Production not found.";
        }
    } else {
        echo "Invalid request.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="production.php">Back to Productions</a>
</body>
</html>
