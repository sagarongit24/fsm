<!DOCTYPE html>
<html>
<head>
    <title>Crew Members</title>
    <link rel="stylesheet" type="text/css" href="crew.css">

</head>
<body>
    <h1>List of Crew Members</h1>

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

    // Query to retrieve crew data
    $sql = "SELECT * FROM crew";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>
        <tr>
            <th>Crew ID</th>
            <th>Crew Name</th>
            <th>Contact Email</th>
            <th>Agent Name</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["crew_id"] . "</td>
            <td>" . $row["crew_name"] . "</td>
            <td>" . $row["contact_email"] . "</td>
            <td>" . $row["agent_name"] . "</td>
            <td>" . $row["salary"] . "</td>
            <td>
                <a href='edit_crew.php?id=" . $row["crew_id"] . "'>Edit</a> |
                <a href='delete_crew.php?id=" . $row["crew_id"] . "'>Delete</a>
            </td>
        </tr>";
        }

        echo "</table>";
    } else {
        echo "No crew members found.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="add_crew.php">Add Crew Member</a>
    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
