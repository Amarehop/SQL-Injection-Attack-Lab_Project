-- Create the database
CREATE DATABASE employee_management;
USE employee_management;

-- Create the table
CREATE TABLE employees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    password VARCHAR(255),
    salary DECIMAL(10,2),
    birthday DATE,
    ssn VARCHAR(20),
    address VARCHAR(255),
    email VARCHAR(255),
    nickname VARCHAR(50),
    phone VARCHAR(20)
);

-- Insert the data
INSERT INTO employees (name, password, salary, birthday, ssn, address, email, nickname, phone) VALUES
('Admin', '123abc', 400000, '1943-05-03', '43254314', 'Admin Address', 'admin@example.com', 'AdminNick', '1234567890'),
('Alice', '124abc', 20000, '1989-09-20', '10211002', 'Alice Address', 'alice@example.com', 'AliceNick', '0987654321'),
('Boby', '125abc', 50000, '1982-04-20', '10213352', 'Boby Address', 'boby@example.com', 'BobyNick', '1122334455'),
('Ryan', '126abc', 90000, '1980-04-10', '32193525', 'Ryan Address', 'ryan@example.com', 'RyanNick', '2233445566'),
('Samy', '1237abc', 40000, '1991-01-11', '32111111', 'Samy Address', 'samy@example.com', 'SamyNick', '3344556677'),
('Ted', '128abc', 110000, '1963-11-03', '24343244', 'Ted Address', 'ted@example.com', 'TedNick', '4455667788');






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

    // Prepare and execute the SQL query to retrieve the stored password hash
    $stmt = $conn->prepare("SELECT password FROM employees WHERE emp_id = ?");
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $stmt->store_result();

    // Check if the employee ID exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        // Verify the old password
        if (password_verify($oldPassword, $storedPassword)) {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password
            $updateStmt = $conn->prepare("UPDATE employees SET password = ? WHERE emp_id = ?");
            $updateStmt->bind_param("si", $hashedNewPassword, $emp_id);

            if ($updateStmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $conn->error;
            }

            $updateStmt->close();
        } else {
            echo "Incorrect old password.";
        }
    } else {
        echo "Employee ID not found.";
    }

    $stmt->close();
}

$conn->close();
?>
