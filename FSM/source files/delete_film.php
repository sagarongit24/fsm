<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Film</title>
    <link rel="stylesheet" type="text/css" href="delete_film.css">
    <!-- Add your CSS and styling here if needed -->
</head>
<body>
    <h2>Delete Film</h2>

    <?php
    // Include your database connection code
    include_once "conn.php"; // Replace with your actual connection code

    // Check if film_id is provided in the URL
    if (isset($_GET['film_id'])) {
        $film_id = $_GET['film_id'];

        // Check if the film exists in the database
        $check_sql = "SELECT * FROM films WHERE film_id=?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $film_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows === 1) {
            // Film exists, confirm deletion
            $row = $check_result->fetch_assoc();
            ?>

            <p>Are you sure you want to delete the film "<?php echo $row['title']; ?>"?</p>
            <form action="delete_film.php" method="post">
                <input type="hidden" name="film_id" value="<?php echo $film_id; ?>">
                <input type="submit" value="Yes, Delete">
                <a href="films.php">No, Cancel</a>
            </form>

            <?php
        } else {
            echo "Film not found.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle the POST request to delete the film
        $film_id = $_POST['film_id'];

        // Delete the film from the database
        $delete_sql = "DELETE FROM films WHERE film_id=?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $film_id);

        if ($delete_stmt->execute()) {
            // Film deleted successfully
            echo "Film deleted successfully. <a href='films.php'>Back to Films</a>";
        } else {
            // Error deleting film
            echo "Error deleting film: " . $delete_stmt->error;
        }
    } else {
        echo "Invalid request.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
