<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check admin credentials
$sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Start session and redirect to admin panel
    session_start();
    $_SESSION['admin'] = $username;
    header("Location: admin_panel.php");
} else {
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
