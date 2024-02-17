<!DOCTYPE html>
<html>
<head>
    <title>Delete Actor</title>
</head>
<body>
    <h1>Delete Actor</h1>

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
            echo "<p>Are you sure you want to delete the actor?</p>";
            echo "<p><strong>Actor ID:</strong> " . $row["actor_id"] . "</p>";
            echo "<p><strong>Actor Name:</strong> " . $row["actor_name"] . "</p>";
            echo "<p><strong>Birth Date:</strong> " . $row["birth_date"] . "</p>";
            echo "<p><strong>Agent Name:</strong> " . $row["agent_name"] . "</p>";
            echo "<p><strong>Current Project:</strong> " . $row["current_project"] . "</p>";
            echo "<form method='post' action='delete_actor.php'>";
            echo "<input type='hidden' name='actor_id' value='$actor_id'>";
            echo "<input type='submit' value='Confirm Delete'>";
            echo "</form>";
        } else {
            echo "Actor not found.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actor_id"])) {
        $actor_id = $_POST["actor_id"];

        $delete_sql = "DELETE FROM actors WHERE actor_id = $actor_id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Actor deleted successfully.";
        } else {
            echo "Error deleting actor: " . $conn->error;
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
