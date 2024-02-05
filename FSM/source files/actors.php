<!DOCTYPE html>
<html>
<head>
    <title>Actors</title>
    <link rel="stylesheet" type="text/css" href="actors.css">
</head>
<body>
    <h1>List of Actors</h1>

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

    // Query to retrieve actor data
    $sql = "SELECT * FROM actors";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>
        <tr>
            <th>Actor ID</th>
            <th>Actor Name</th>
            <th>Birth Date</th>
            <th>Agent Name</th>
            <th>Current Project</th>
            <th>Actions</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["actor_id"] . "</td>
            <td>" . $row["actor_name"] . "</td>
            <td>" . $row["birth_date"] . "</td>
            <td>" . $row["agent_name"] . "</td>
            <td>" . $row["current_project"] . "</td>
            <td>
                <a href='edit_actor.php?id=" . $row["actor_id"] . "'>Edit</a>
                <a href='delete_actor.php?id=" . $row["actor_id"] . "'>Delete</a>
            </td>
        </tr>";
        }

        echo "</table>";
    } else {
        echo "No actors found.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="add_actor.php">Add Actor</a>
    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
