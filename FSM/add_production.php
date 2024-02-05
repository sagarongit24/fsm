<!DOCTYPE html>
<html>
<head>
    <title>Add Production</title>
    <link rel="stylesheet" type="text/css" href="add_production.css">
</head>
<body>
    <h1>Add New Production</h1>
    <form action="insert_production.php" method="post">

        <!-- You can add input fields for adding a new production here -->
        <label for="production_name">Production Name:</label>
        <input type="text" id="production_name" name="production_name" required><br>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date"><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location"><br>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget"><br>

        <input type="submit" value="Add Production">
    </form>
    <br>
    <a href="production.php" class="button">Back to Productions</a>

</body>
</html>
