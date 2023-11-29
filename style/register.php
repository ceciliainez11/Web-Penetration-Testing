<?php
$host = 'localhost'; // or your host name
$dbUsername = 'root'; // your database username
$dbPassword = ''; // your database password
$dbName = 'your_database_name'; // your database name

// Create database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_POST['email']);

    // Insert query
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
