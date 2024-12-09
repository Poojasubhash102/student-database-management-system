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
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$percentage = $_POST['percentage'];

// Validate phone number length
if (strlen($phone) > 10) {
    die("Phone number should not exceed 10 digits.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO students (first_name, last_name, father_name, mother_name, dob, email, phone, percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssd", $first_name, $last_name, $father_name, $mother_name, $dob, $email, $phone, $percentage);

// Execute the query
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
