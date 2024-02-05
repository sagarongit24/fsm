<?php
// Include your database connection code
include_once "conn.php"; // Replace with your actual connection code

// Check if the review ID is provided in the URL
if (isset($_GET['id'])) {
    $review_id = $_GET['id'];

    // Fetch the review details from the database
    $sql = "SELECT r.*, f.film_id
            FROM reviews r
            LEFT JOIN films f ON r.film_id = f.film_id
            WHERE r.review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $review_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Retrieve review data
        $row = $result->fetch_assoc();
        $reviewer_name = $row['reviewer_name'];
        $rating = $row['rating'];
        $review_text = $row['review_text'];
        $helpful_votes = $row['helpful_votes'];
        $film_id = $row['film_id'];

        // Display a form to edit the review
        echo "<h2>Edit Review</h2>";
        echo "<form action='update_review.php' method='post'>";
        echo "<input type='hidden' name='review_id' value='$review_id'>";
        echo "<input type='hidden' name='film_id' value='$film_id'>";
        echo "Reviewer Name: <input type='text' name='reviewer_name' value='$reviewer_name'><br>";
        echo "Rating: <input type='text' name='rating' value='$rating'><br>";
        echo "Review Text: <textarea name='review_text'>$review_text</textarea><br>";
        echo "Helpful Votes: <input type='text' name='helpful_votes' value='$helpful_votes'><br>";
        echo "<input type='submit' value='Update Review'>";
        echo "</form>";
    } else {
        echo "Review not found.";
    }
} else {
    echo "Review ID not provided.";
}

// Close the database connection
$conn->close();
?>
