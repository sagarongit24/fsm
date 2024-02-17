<!DOCTYPE html>
<html>
<head>
    <title>Add Director</title>
    <link rel="stylesheet" type="text/css" href="add_director.css">
</head>
<body>
    <h1>Add New Director</h1>

    <?php

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "film_studio";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create a database connection
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $director_name = $_POST["new_director_name"];
        $birth_date = $_POST["new_birth_date"];
        $award = $_POST["new_award"];
        $website = $_POST["new_website"];
        $social_media_id = $_POST["new_social_media_id"];

        $sql = "INSERT INTO directors (director_name, birth_date, award, website, social_media_id)
                VALUES ('$director_name', '$birth_date', '$award', '$website', '$social_media_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Director added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="new_director_name">Director Name:</label>
        <input type="text" id="new_director_name" name="new_director_name"><br>

        <label for="new_birth_date">Birth Date:</label>
        <input type="date" id="new_birth_date" name="new_birth_date"><br>

        <label for="new_award">Award:</label>
        <input type="text" id="new_award" name="new_award"><br>

        <label for="new_website">Website:</label>
        <input type="text" id="new_website" name="new_website"><br>

        <label for="new_social_media_id">Social Media ID:</label>
        <input type="text" id="new_social_media_id" name="new_social_media_id"><br>

        <input type="submit" value="Add Director">
    </form>

    <br>
    <a href="directors.php">Back to Directors List</a>
</body>
</html>
