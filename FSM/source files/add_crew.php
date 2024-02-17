<!DOCTYPE html>
<html>
<head>
    <title>Add Crew Member</title>
    <link rel="stylesheet" type="text/css" href="add_crew.css"></head>

</head>
<body>
    <h1>Add Crew Member</h1>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $crew_name = $_POST["crew_name"];
        $contact_email = $_POST["contact_email"];
        $agent_name = $_POST["agent_name"];
        $salary = $_POST["salary"];

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "film_studio";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO crew (crew_name, contact_email, agent_name, salary) VALUES ('$crew_name', '$contact_email', '$agent_name', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "Crew member added successfully.";

            header("refresh:2;url=crew.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

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
