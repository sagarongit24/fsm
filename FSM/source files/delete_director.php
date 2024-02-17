<!DOCTYPE html>
<html>
<head>
    <title>Delete Director</title>
    <link rel="stylesheet" type="text/css" href="directors.css">
</head>
<body>
    <h1>Delete Director</h1>

    <?php

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "film_studio";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $director_id = $_GET["id"];

        if (isset($_GET["confirm"]) && $_GET["confirm"] == "yes") {

            $sql = "DELETE FROM directors WHERE director_id = $director_id";

            if ($conn->query($sql) === TRUE) {
                echo "Director deleted successfully.";

                echo '<script>
                    setTimeout(function() {
                        window.location.href = "directors.php";
                    }, 2000); 
                </script>';
            } else {
                echo "Error deleting director: " . $conn->error;
            }
        } else {

            echo "<p>Are you sure you want to delete this director?</p>";
            echo "<a href='delete_director.php?id=$director_id&confirm=yes'>Yes</a> ";
            echo "<a href='directors.php'>No</a>";
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
    ?>

    <br>
    <a href="directors.php">Back to Directors</a>
</body>
</html>
