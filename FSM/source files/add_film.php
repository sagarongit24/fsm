<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Film</title>
    <link rel="stylesheet" type="text/css" href="add_films.css">
</head>
<body>
    <h2>Add New Film</h2>
    <form action="insert_film.php" method="post">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date"><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre"><br>

        <label for="director_name">Director Name:</label>
        <input type="text" id="director_name" name="director_name"><br>

        <label for="run_time">Run Time (minutes):</label>
        <input type="text" id="run_time" name="run_time"><br>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget"><br>

        <label for="box_office">Box Office:</label>
        <input type="number" id="box_office" name="box_office"><br>
        
        <input type="submit" value="Add Film">
    </form>
    <br>
    <a href="films.php" class="button">Back to Films</a>

</body>
</html>
