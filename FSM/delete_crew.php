<!DOCTYPE html>
<html>
<head>
    <title>Delete Crew Member</title>
</head>
<body>
    <h1>Delete Crew Member</h1>

    <?php
    if (isset($_GET["id"])) {
        $crew_id = $_GET["id"];

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

        // Query to retrieve crew member data by ID
        $sql = "SELECT * FROM crew WHERE crew_id = $crew_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Display crew member details and a confirmation prompt
            echo "<p>Are you sure you want to delete the following crew member?</p>
            <p><strong>Crew Name:</strong> " . $row["crew_name"] . "</p>
            <p><strong>Contact Email:</strong> " . $row["contact_email"] . "</p>
            <p><strong>Agent Name:</strong> " . $row["agent_name"] . "</p>
            <p><strong>Salary:</strong> " . $row["salary"] . "</p>
            <a href='confirm_delete_crew.php?id=" . $row["crew_id"] . "'>Yes, Delete</a> |
            <a href='crew.php'>No, Cancel</a>";
        } else {
            echo "Crew member not found.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Invalid request.";
    }
    ?>

    <br>
    <a href="crew.php">Back to Crew Members</a>
</body>
</html>
