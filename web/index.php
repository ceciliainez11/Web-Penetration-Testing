<?php
session_start(); // Start a new session

// Database configuration
$db_host = 'localhost'; // Database host
$db_user = 'username'; // Database username
$db_pass = 'password'; // Database password
$db_name = 'database_name'; // Database name

// Create database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password against hash in the database
        if (password_verify($password, $row['password'])) {
            // Password is correct, create a session
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            header("location: welcome.php"); // Redirect to a welcome page
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
