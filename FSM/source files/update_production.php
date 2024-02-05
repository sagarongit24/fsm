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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["production_id"])) {
    // Retrieve form data
    $production_id = $_POST["production_id"];
    $production_name = $_POST["production_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $location = $_POST["location"];
    $budget = $_POST["budget"];

    // SQL query to update production information
    $sql = "UPDATE production
            SET production_name = '$production_name',
                start_date = '$start_date',
                end_date = '$end_date',
                location = '$location',
                budget = '$budget'
            WHERE production_id = $production_id";

    if ($conn->query($sql) === TRUE) {
        echo "Production information updated successfully.";

        // Add JavaScript code to redirect after a delay
        echo '<script>
            setTimeout(function() {
                window.location.href = "production.php";
            }, 2000); // Redirect after 2 seconds (2000 milliseconds)
        </script>';
    } else {
        echo "Error updating production information: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
