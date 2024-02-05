<?php
// Include your database connection code
require_once "conn.php"; // Replace with your actual connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated data from the form
    $review_id = $_POST['review_id'];
    $film_id = $_POST['film_id'];
    $reviewer_name = $_POST['reviewer_name'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $helpful_votes = $_POST['helpful_votes'];

    // Update the review data in the database
    $sql = "UPDATE reviews SET reviewer_name = ?, rating = ?, review_text = ?, helpful_votes = ? WHERE review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisii", $reviewer_name, $rating, $review_text, $helpful_votes, $review_id);

    if ($stmt->execute()) {
        // Review updated successfully
        echo "Review updated successfully"; 

        // Redirect to the reviews page after a short delay (optional)
        header("refresh:1;url=reviews.php"); // Redirect to reviews.php after 5 seconds (you can adjust the delay)

    } else {
        // Error updating review
        echo "Error updating review: " . $conn->error;
    }
} else {
    // Redirect to the form page if accessed directly without POST data
    header("Location: edit_review.php?id=" . $_POST['review_id']);
}

// Close the database connection
$conn->close();
?>
