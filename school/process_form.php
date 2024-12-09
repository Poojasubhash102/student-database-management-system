<?php
// Retrieve form data
$student_name = $_POST['student_name'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$percentage = $_POST['percentage'];

// Database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert data into database
$sql = "INSERT INTO students (student_name, father_name, mother_name, dob, mobile, email, percentage)
        VALUES ('$student_name', '$father_name', '$mother_name', '$dob', '$mobile', '$email', '$percentage')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
