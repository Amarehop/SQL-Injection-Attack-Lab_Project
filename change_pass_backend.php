
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "employee_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $emp_id = $_POST["emp_id"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $query = "SELECT password FROM employees WHERE emp_id = $emp_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if ($oldPassword == $storedPassword) {
            echo $oldPassword;
            echo $storedPassword;
            $updateQuery = "UPDATE employees SET password = '$newPassword' 
            WHERE emp_id = $emp_id";


            if ($conn->query($updateQuery) === TRUE) {
                echo "Password updated successfully.";
            } else {
                // Detailed error disclosure
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Incorrect old password.";
        }
    } else {
        echo "Employee ID not found.";
    }
}

$conn->close();
?>
