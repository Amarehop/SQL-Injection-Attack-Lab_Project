<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["UName"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO students (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Student Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SCRIPT"]);?>" method="post">
            <input type="text" placeholder="Enter username" name="UName" required="true" title="Username is required">
            <input type="password" placeholder="Enter password" name="password" required="true" title="Password is required">
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>