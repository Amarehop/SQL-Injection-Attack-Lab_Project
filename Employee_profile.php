<!DOCTYPE html>
<html>
<head>
    <title>Employee Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .profile-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
        }

        input[type=text], input[type=password], input[type=number], input[type=email] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Employee Profile</h1>
        <form action="Employee_profile.php" method="post">
            <label for="emp_id">Employee ID:</label>
            <input type="number" id="emp_id" name="emp_id" placeholder="Enter your employee ID" required title="Employee ID is required">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required title="Name is required">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required title="Email is required">
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" placeholder="Enter your address" required title="Address is required"></textarea>
            
            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" placeholder="Enter your phone number" required title="Phone number is required">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required title="Password is required">
            
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "employee_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['emp_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update employee data in the database
    $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, address=?, phone=?, password=? WHERE emp_id=?");
    $stmt->bind_param("sssssi", $name, $email, $address, $phone, $password, $emp_id);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
ss