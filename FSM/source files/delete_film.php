<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Film</title>
    <link rel="stylesheet" type="text/css" href="delete_film.css">
</head>
<body>
    <h2>Delete Film</h2>

    <?php

    include_once "conn.php"; 

    if (isset($_GET['film_id'])) {
        $film_id = $_GET['film_id'];

        $check_sql = "SELECT * FROM films WHERE film_id=?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $film_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows === 1) {

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

        $film_id = $_POST['film_id'];

        $delete_sql = "DELETE FROM films WHERE film_id=?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $film_id);

        if ($delete_stmt->execute()) {

            echo "Film deleted successfully. <a href='films.php'>Back to Films</a>";
        } else {

            echo "Error deleting film: " . $delete_stmt->error;
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
    ?>
</body>
</html>
