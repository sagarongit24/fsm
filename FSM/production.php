<!DOCTYPE html>
<html>
<head>
    <title>Production</title>
    <link rel="stylesheet" type="text/css" href="production.css">
</head>
<body>
    <h1>List of Productions</h1>
    <a href="add_production.php">Add Production</a>

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

    // Query to retrieve production data
    $sql = "SELECT * FROM production";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>
        <tr>
            <th>Production ID</th>
            <th>Production Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Location</th>
            <th>Budget</th>
            <th>Action</th> <!-- Add a new column for Edit and Delete buttons -->
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["production_id"] . "</td>
            <td>" . $row["production_name"] . "</td>
            <td>" . $row["start_date"] . "</td>
            <td>" . $row["end_date"] . "</td>
            <td>" . $row["location"] . "</td>
            <td>" . $row["budget"] . "</td>
            <td>
                <a href='edit_production.php?production_id=" . $row["production_id"] . "'>Edit</a>
                <a href='delete_production.php?production_id=" . $row["production_id"] . "'>Delete</a>
            </td>
        </tr>";
        }

        echo "</table>";
    } else {
        echo "No productions found.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
