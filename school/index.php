<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        function validateForm() {
            var phone = document.getElementById("phone").value;
            if (phone.length > 10) {
                alert("Phone number should not exceed 10 digits.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Student Registration Form</h2>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" required>
            
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" required>
            
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" maxlength="10" required>
            
            <label for="percentage">Percentage:</label>
            <input type="number" step="0.01" id="percentage" name="percentage" required>
            
            <input type="submit" value="Register">
        </form>
        <div class="admin-login">
            <a href="admin_login.html">Admin Login</a>
        </div>
    </div>
</body>
</html>
