<?php
$email = $_POST['email'];
$password = $_POST['password'];

// DB connection
$con = new mysqli("localhost", "root", "", "film_studio");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            // Redirect to the main page (index.php) upon successful login
            header("Location: index.php");
            exit(); // Terminate the script to ensure the redirect takes effect
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}
?>
