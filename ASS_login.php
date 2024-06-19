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
    $inputUsername = $_POST["UName"];
    $inputPassword = $_POST["password"];

    // Prepare and execute the SQL query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedUsername = $row['username'];
        $storedPassword = $row['password'];

        if ($inputUsername === $storedUsername && $inputPassword === $storedPassword) {
            // Registration successful, you can display a success message or redirect to another page
            echo "Registration successful!";
        } else {
            echo "Wrong username or password.";
        }
    } else {
        echo "Wrong username or password.";
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 18px;
        }
        .login-container button {
            background-color: green;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .login-container button.forgot-password {
            background-color: red;
        }
        .login-container button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Student Registration</h1>
        <form action="ASS_login.php" method="post">
            <input type="text" placeholder="Enter username" name="UName" required="true" title="Username is required">
            <input type="password" placeholder="Enter password" name="password" required="true" title="Password is required">
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
