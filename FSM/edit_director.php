<!DOCTYPE html>
<html>
<head>
    <title>Edit Director</title>
    <link rel="stylesheet" type="text/css" href="directors.css">
</head>
<body>
    <h1>Edit Director</h1>

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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $director_id = $_GET["id"];

        // Query to retrieve the director's information based on director_id
        $sql = "SELECT * FROM directors WHERE director_id = $director_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Display a form with pre-filled data for editing
            echo "<form action='update_director.php' method='post'>
                <input type='hidden' name='director_id' value='$director_id'>
                <label for='director_name'>Director Name:</label>
                <input type='text' id='director_name' name='director_name' value='" . $row["director_name"] . "' required><br>

                <label for='birth_date'>Birth Date:</label>
                <input type='date' id='birth_date' name='birth_date' value='" . $row["birth_date"] . "'><br>

                <label for='award'>Award:</label>
                <input type='text' id='award' name='award' value='" . $row["award"] . "'><br>

                <label for='website'>Website:</label>
                <input type='text' id='website' name='website' value='" . $row["website"] . "'><br>

                <label for='social_media_id'>Social Media ID:</label>
                <input type='text' id='social_media_id' name='social_media_id' value='" . $row["social_media_id"] . "'><br>

                <input type='submit' value='Update Director'>
            </form>";
        } else {
            echo "Director not found.";
        }
    } else {
        echo "Invalid request.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="directors.php">Back to Directors</a>
</body>
</html>
