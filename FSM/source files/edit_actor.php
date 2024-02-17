<!DOCTYPE html>
<html>
<head>
    <title>Edit Actor</title>
</head>
<body>
    <h1>Edit Actor</h1>

    <?php

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "film_studio";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $actor_id = $_GET["id"];

        $sql = "SELECT * FROM actors WHERE actor_id = $actor_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<form method='POST' action='update_actor.php'>
                <input type='hidden' name='actor_id' value='" . $row["actor_id"] . "'>
                <label for='actor_name'>Actor Name:</label>
                <input type='text' id='actor_name' name='actor_name' value='" . $row["actor_name"] . "' required><br>
                <label for='birth_date'>Birth Date:</label>
                <input type='date' id='birth_date' name='birth_date' value='" . $row["birth_date"] . "' required><br>
                <label for='agent_name'>Agent Name:</label>
                <input type='text' id='agent_name' name='agent_name' value='" . $row["agent_name"] . "' required><br>
                <label for='current_project'>Current Project:</label>
                <input type='text' id='current_project' name='current_project' value='" . $row["current_project"] . "'><br>
                <input type='submit' value='Update Actor'>
            </form>";
        } else {
            echo "Actor not found.";
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
    ?>

    <br>
    <a href="actors.php">Back to Actors</a>
</body>
</html>
