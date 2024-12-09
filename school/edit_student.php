<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $percentage = $_POST['percentage'];

    // Update student record
    $stmt = $conn->prepare("UPDATE students SET first_name=?, last_name=?, father_name=?, mother_name=?, dob=?, email=?, phone=?, percentage=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $first_name, $last_name, $father_name, $mother_name, $dob, $email, $phone, $percentage, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        die("Student not found.");
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>
        <form action="edit_student.php" method="post">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
            
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" value="<?php echo $student['father_name']; ?>" required>
            
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" value="<?php echo $student['mother_name']; ?>" required>
            
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $student['dob']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" maxlength="10" value="<?php echo $student['phone']; ?>" required>
            
            <label for="percentage">Percentage:</label>
            <input type="number" step="0.01" id="percentage" name="percentage" value="<?php echo $student['percentage']; ?>" required>
            
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
