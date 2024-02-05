<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Films Page</title>
    <link rel="stylesheet" type="text/css" href="reviews.css"> <!-- Add this line -->
</head>
<body>
<?php
// Include your database connection code
include_once "conn.php"; // Replace with your actual connection code

// Fetch reviews from the database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

// Display reviews in a table
echo "<h2>Reviews</h2>";
echo "<a href='add_review.php'>Add New Review</a>"; // Link to the add review page

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Review ID</th><th>Reviewer Name</th><th>Rating</th><th>Review Text</th><th>Helpful Votes</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["review_id"] . "</td>";
        echo "<td>" . $row["reviewer_name"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "<td>" . $row["review_text"] . "</td>";
        echo "<td>" . $row["helpful_votes"] . "</td>";
        echo "<td><a href='edit_review.php?id=" . $row["review_id"] . "'>Edit</a> | ";
        echo "<a href='delete_review.php?id=" . $row["review_id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No reviews found.";
}

$conn->close();
?>
</body>
</html>