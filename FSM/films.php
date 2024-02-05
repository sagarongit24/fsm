<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Films Page</title>
    <link rel="stylesheet" type="text/css" href="film.css"> <!-- Add this line -->
</head>
<body>
<?php
// Include your database connection code
include_once "conn.php"; // Replace with your actual connection code

// Fetch films from the database
$sql = "SELECT f.film_id, f.title, f.genre, f.director_name, f.run_time, f.production_id, f.crew_name
        FROM films f";
$result = $conn->query($sql);

// Display films in a table
echo "<h2>Films</h2>";
echo "<a href='add_film.php'>Add New Film</a>"; // Link to the add film page

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Film ID</th><th>Title</th><th>Genre</th><th>Director</th><th>Run Time (in mins)</th><th>Production ID</th><th>Crew Name</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["film_id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["genre"] . "</td>";
        echo "<td>" . $row["director_name"] . "</td>";
        echo "<td>" . $row["run_time"] . "</td>";
        echo "<td>" . $row["production_id"] . "</td>";
        echo "<td>" . $row["crew_name"] . "</td>";
        echo "<td><a href='edit_film.php?film_id=" . $row["film_id"] . "'>Edit</a>  ";
        echo "<a href='delete_film.php?film_id=" . $row["film_id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No films found.";
}

$conn->close();
?>
</body>
</html>
