<?php
// Database connection settings (same as edit_actor.php)
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actor_id"])) {
    // Get data from the form
    $actor_id = $_POST["actor_id"];
    $actor_name = $_POST["actor_name"];
    $birth_date = $_POST["birth_date"];
    $agent_name = $_POST["agent_name"];
    $current_project = $_POST["current_project"];

    // SQL UPDATE statement to update the actor's data
    $update_sql = "UPDATE actors SET
        actor_name = '$actor_name',
        birth_date = '$birth_date',
        agent_name = '$agent_name',
        current_project = '$current_project'
        WHERE actor_id = $actor_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Actor updated successfully.";
        
        // Add JavaScript for redirection after 2 seconds
        echo "<script>
            setTimeout(function() {
                window.location.href = 'actors.php';
            }, 2000);
        </script>";
    } else {
        echo "Error updating actor: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
