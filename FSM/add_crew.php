<!DOCTYPE html>
<html>
<head>
    <title>Add Crew Member</title>
    <link rel="stylesheet" type="text/css" href="add_crew.css"></head>

</head>
<body>
    <h1>Add Crew Member</h1>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data and insert a new crew member into the database
        $crew_name = $_POST["crew_name"];
        $contact_email = $_POST["contact_email"];
        $agent_name = $_POST["agent_name"];
        $salary = $_POST["salary"];

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

        // Query to insert a new crew member into the crew table
        $sql = "INSERT INTO crew (crew_name, contact_email, agent_name, salary) VALUES ('$crew_name', '$contact_email', '$agent_name', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "Crew member added successfully.";
            // Redirect to crew.php after 2 seconds
            header("refresh:2;url=crew.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <!-- Form to add a new crew member -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="crew_name">Crew Name:</label>
        <input type="text" id="crew_name" name="crew_name" required><br>
        <label for="contact_email">Contact Email:</label>
        <input type="text" id="contact_email" name="contact_email" required><br>
        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" required><br>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" required><br><br>
        <input type="submit" value="Add Crew Member">
    </form>

    <br>
    <a href="crew.php">Back to Crew Members</a>
</body>
</html>
