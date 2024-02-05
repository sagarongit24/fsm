<?php
// Include your database connection code
include_once "conn.php"; // Replace with your actual connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve film data from the form
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];
    $director_name = $_POST['director_name'];
    $run_time = $_POST['run_time'];
    $budget = $_POST['budget'];
    $box_office = $_POST['box_office'];

    // You should add validation code here to ensure data integrity.

    // Insert the film data into the database
    $sql = "INSERT INTO films (title, release_date, genre, director_name, run_time, budget, box_office) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiii", $title, $release_date, $genre, $director_name, $run_time, $budget, $box_office);

    if ($stmt->execute()) {
        // Film added successfully
        echo "Film added successfully. <a href='films.php'>Back to Films</a>";
    } else {
        // Error adding film
        echo "Error adding film: " . $stmt->error;
    }
} else {
    // Redirect to the form page if accessed directly without POST data
    header("Location: add_film.php");
}

// Close the database connection
$conn->close();
?>
