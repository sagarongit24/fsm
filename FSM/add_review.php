<?php
// Include your database connection code
include_once "conn.php"; // Replace with your actual connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $film_id = $_POST['film_id'];
    $reviewer_name = $_POST['reviewer_name'];
    $review_content = $_POST['review_content'];
    $rating = $_POST['rating'];

    // Insert the review into the database
    $sql = "INSERT INTO reviews (film_id, reviewer_name, review_text, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $film_id, $reviewer_name, $review_content, $rating);

    if ($stmt->execute()) {
        echo "Review added successfully.";
    } else {
        echo "Error adding review: " . $stmt->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Review</title>
    <link rel="stylesheet" type="text/css" href="add_review.css">
</head>
<body>
    <h2>Add a Review</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="film_id">Film ID:</label>
        <input type="number" name="film_id" required><br>

        <label for="reviewer_name">Reviewer Name:</label>
        <input type="text" name="reviewer_name" required><br>

        <label for="review_content">Review Content:</label>
        <textarea name="review_content" required></textarea><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" min="1" max="10" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
