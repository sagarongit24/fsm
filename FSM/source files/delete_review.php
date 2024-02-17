<!DOCTYPE html>
<html>
<head>
    <title>Delete Review</title>
</head>
<body>
    <h1>Delete Review</h1>

    <?php
    if (isset($_GET["id"])) {
        $review_id = $_GET["id"];

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "film_studio";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM reviews WHERE review_id = $review_id";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<p>Are you sure you want to delete the following review?</p>
            <p><strong>Review ID:</strong> " . $row["review_id"] . "</p>
            <p><strong>Reviewer Name:</strong> " . $row["reviewer_name"] . "</p>
            <p><strong>Rating:</strong> " . $row["rating"] . "</p>
            <a href='confirm_delete_review.php?id=" . $row["review_id"] . "'>Yes, Delete</a> |
            <a href='reviews.php'>No, Cancel</a>";
        } else {
            echo "Review not found.";
        }

        $conn->close();
    } else {
        echo "Invalid request.";
    }
    ?>

    <br>
    <a href="reviews.php">Back to Reviews</a>
</body>
</html>
