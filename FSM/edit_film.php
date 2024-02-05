<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <!-- Add your CSS and styling here if needed -->
</head>
<body>
    <h2>Edit Film</h2>

    <?php
    // Include your database connection code
    include_once "conn.php"; // Replace with your actual connection code

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve updated film data from the form
        $film_id = $_POST['film_id'];
        $title = $_POST['title'];
        $release_date = $_POST['release_date'];
        $genre = $_POST['genre'];
        $director_name = $_POST['director_name'];
        $run_time = $_POST['run_time'];
        $budget = $_POST['budget'];
        $box_office = $_POST['box_office'];

        // You should add validation code here to ensure data integrity.

        // Update the film data in the database
        $sql = "UPDATE films SET title=?, release_date=?, genre=?, director_name=?, run_time=?, budget=?, box_office=? WHERE film_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiiii", $title, $release_date, $genre, $director_name, $run_time, $budget, $box_office, $film_id);

        if ($stmt->execute()) {
            // Film updated successfully
            echo "Film updated successfully. <a href='films.php'>Back to Films</a>";
        } else {
            // Error updating film
            echo "Error updating film: " . $stmt->error;
        }
    } else {
        // Retrieve the film_id from the URL
        $film_id = $_GET['film_id'];

        // Fetch film details from the database
        $sql = "SELECT * FROM films WHERE film_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $film_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Fetch and display the film details in the edit form
            $row = $result->fetch_assoc();
            ?>

            <form action="edit_film.php" method="post">
                <input type="hidden" name="film_id" value="<?php echo $film_id; ?>">
                
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required><br>

                <label for="release_date">Release Date:</label>
                <input type="date" id="release_date" name="release_date" value="<?php echo $row['release_date']; ?>"><br>

                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" value="<?php echo $row['genre']; ?>"><br>

                <label for="director_name">Director Name:</label>
                <input type="text" id="director_name" name="director_name" value="<?php echo $row['director_name']; ?>"><br>

                <label for="run_time">Run Time (minutes):</label>
                <input type="text" id="run_time" name="run_time" value="<?php echo $row['run_time']; ?>"><br>

                <label for="budget">Budget:</label>
                <input type="number" id="budget" name="budget" value="<?php echo $row['budget']; ?>"><br>

                <label for="box_office">Box Office:</label>
                <input type="number" id="box_office" name="box_office" value="<?php echo $row['box_office']; ?>"><br>

                <input type="submit" value="Update Film">
            </form>

            <?php
        } else {
            echo "Film not found.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
