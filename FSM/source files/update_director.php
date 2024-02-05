<!DOCTYPE html>
<html>
<head>
    <title>Update Director</title>
    <link rel="stylesheet" type="text/css" href="directors.css">
</head>
<body>
    <h1>Update Director</h1>

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["director_id"])) {
        // Retrieve form data
        $director_id = $_POST["director_id"];
        $director_name = $_POST["director_name"];
        $birth_date = $_POST["birth_date"];
        $award = $_POST["award"];
        $website = $_POST["website"];
        $social_media_id = $_POST["social_media_id"];

        // SQL query to update director information
        $sql = "UPDATE directors
                SET director_name = '$director_name',
                    birth_date = '$birth_date',
                    award = '$award',
                    website = '$website',
                    social_media_id = '$social_media_id'
                WHERE director_id = $director_id";

        if ($conn->query($sql) === TRUE) {
            echo "Director information updated successfully.";

            // Add JavaScript code to redirect after a delay
            echo '<script>
                setTimeout(function() {
                    window.location.href = "directors.php";
                }, 2000); // Redirect after 2 seconds (2000 milliseconds)
            </script>';
        } else {
            echo "Error updating director information: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <br>
    <a href="directors.php">Back to Directors</a>
</body>
</html>
