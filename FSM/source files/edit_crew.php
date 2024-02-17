<!DOCTYPE html>
<html>
<head>
    <title>Edit Crew Member</title>
</head>
<body>
    <h1>Edit Crew Member</h1>

    <?php
    if (isset($_GET["id"])) {
        $crew_id = $_GET["id"];

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "film_studio";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM crew WHERE crew_id = $crew_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<form method='POST' action='update_crew.php'>
                <input type='hidden' name='crew_id' value='" . $row["crew_id"] . "'>
                <label for='crew_name'>Crew Name:</label>
                <input type='text' id='crew_name' name='crew_name' value='" . $row["crew_name"] . "' required><br>
                <label for='contact_email'>Contact Email:</label>
                <input type='text' id='contact_email' name='contact_email' value='" . $row["contact_email"] . "' required><br>
                <label for='agent_name'>Agent Name:</label>
                <input type='text' id='agent_name' name='agent_name' value='" . $row["agent_name"] . "' required><br>
                <label for='salary'>Salary:</label>
                <input type='number' id='salary' name='salary' value='" . $row["salary"] . "' required><br>
                <input type='submit' value='Update Crew Member'>
            </form>";
        } else {
            echo "Crew member not found.";
        }

        $conn->close();
    } else {
        echo "Invalid request.";
    }
    ?>

    <br>
    <a href="crew.php">Back to Crew Members</a>
</body>
</html>
