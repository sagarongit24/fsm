<!DOCTYPE html>
<html>
<head>
    <title>Directors</title>
    <link rel="stylesheet" type="text/css" href="directors.css">
</head>
<body>
    <h1>List of Directors</h1>

    <?php

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "film_studio";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM directors";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<table border='1'>
        <tr>
            <th>Director ID</th>
            <th>Director Name</th>
            <th>Birth Date</th>
            <th>Award</th>
            <th>Website</th>
            <th>Social Media ID</th>
            <th>Actions</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["director_id"] . "</td>
            <td>" . $row["director_name"] . "</td>
            <td>" . $row["birth_date"] . "</td>
            <td>" . $row["award"] . "</td>
            <td>" . $row["website"] . "</td>
            <td>" . $row["social_media_id"] . "</td>
            <td>
                <a href='edit_director.php?id=" . $row["director_id"] . " '>Edit</a>
                <a href='delete_director.php?id=" . $row["director_id"] . " '>Delete</a>
            </td>
        </tr>";
        }

        echo "</table>";
    } else {
        echo "No directors found.";
    }

    $conn->close();
    ?>

    <a href="add_director.php">Add New Director</a>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
