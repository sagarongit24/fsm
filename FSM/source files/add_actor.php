<!DOCTYPE html>
<html>
<head>
    <title>Add Actor</title>
    <link rel="stylesheet" type="text/css" href="add_actor.css"></head>
</head>
<body>
    <h1>Add Actor</h1>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $actor_name = $_POST["actor_name"];
        $birth_date = $_POST["birth_date"];
        $agent_name = $_POST["agent_name"];
        $current_project = $_POST["current_project"];

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "film_studio";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO actors (actor_name, birth_date, agent_name, current_project) VALUES ('$actor_name', '$birth_date', '$agent_name', '$current_project')";

        if ($conn->query($sql) === TRUE) {
            echo "Actor added successfully.";

            header("refresh:2;url=actors.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="actor_name">Actor Name:</label>
        <input type="text" id="actor_name" name="actor_name" required><br>
        <label for="birth_date">Birth Date:</label>
        <input type="date" id="birth_date" name="birth_date" required><br>
        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" required><br>
        <label for="current_project">Current Project:</label>
        <input type="text" id="current_project" name="current_project"><br>
        <input type="submit" value="Add Actor">
    </form>

    <br>
    <a href="actors.php">Back to Actors</a>
</body>
</html>
