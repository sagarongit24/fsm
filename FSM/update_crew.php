<!DOCTYPE html>
<html>
<head>
    <title>Update Crew Member</title>
</head>
<body>
    <h1>Update Crew Member</h1>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $crew_id = $_POST["crew_id"];
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

        // Query to update the crew member data
        $sql = "UPDATE crew SET crew_name='$crew_name', contact_email='$contact_email', agent_name='$agent_name', salary='$salary' WHERE crew_id=$crew_id";

        if ($conn->query($sql) === TRUE) {
            echo "Crew member updated successfully.";
            // Redirect to crew.php after 2 seconds
            header("refresh:2;url=crew.php");
        } else {
            echo "Error updating crew member: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <br>
    <a href="crew.php">Back to Crew Members</a>
</body>
</html>
