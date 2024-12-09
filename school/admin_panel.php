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

// Fetch student records
$sql = "SELECT id, first_name, last_name, father_name, mother_name, dob, email, phone, percentage, registration_date FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="table-container">
        <h2>Registered Students</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father's Name</th>
                <th>Mother's Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Percentage</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["first_name"] . "</td>
                            <td>" . $row["last_name"] . "</td>
                            <td>" . $row["father_name"] . "</td>
                            <td>" . $row["mother_name"] . "</td>
                            <td>" . $row["dob"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td>" . $row["percentage"] . "</td>
                            <td>" . $row["registration_date"] . "</td>
                            <td>
                                <a href='edit_student.php?id=" . $row["id"] . "'>Edit</a> |
                                <a href='delete_student.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No students registered</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <div class="admin-options">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
