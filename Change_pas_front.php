<!DOCTYPE html>
<html>
<head>
    <title>Modify Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .password-change-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
        }

        input[type=text], input[type=password], input[type=number] {
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

        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="password-change-container">
        <h1>Modify Profile</h1>
        <form action="" method="post">
            <label for="emp_id">Employee ID:</label>
            <input type="number" id="emp_id" name="emp_id" placeholder="Enter employee ID" required title="Employee ID is required">
            
            <label for="old_password">Old Password:</label>
            <input type="text" id="old_password" name="old_password" placeholder="Enter old password" required title="Old password is required">
            
            <label for="new_password">New Password:</label>
            <input type="text" id="new_password" name="new_password" placeholder="Enter new password" required title="New password is required">
            
            <button type="submit">Change Password</button>
        </form>
    </div>

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

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $emp_id = sanitize_input($_POST["emp_id"]);
    $oldPassword = sanitize_input($_POST["old_password"]);
    $newPassword = sanitize_input($_POST["new_password"]);

    // Fetch current password using prepared statements
    $stmt = $conn->prepare("SELECT password FROM employees WHERE emp_id = ?");
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Check if old password is correct
        if ($oldPassword == $storedPassword) {
            // Update password using prepared statements
            $updateStmt = $conn->prepare("UPDATE employees SET password = ? WHERE emp_id = ?");
            $updateStmt->bind_param("si", $newPassword, $emp_id);

            if ($updateStmt->execute()) {
                echo "Password updated successfully.";

                // Fetch and display updated employee table using prepared statements
                $fetchStmt = $conn->prepare("SELECT name, password, salary, birthday, ssn, address, email, nickname, phone FROM employees");
                $fetchStmt->execute();
                $result = $fetchStmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Name</th><th>Password</th><th>Salary</th><th>Birthday</th><th>SSN</th><th>Address</th><th>Email</th><th>Nickname</th><th>Phone</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["password"]) . "</td><td>" . htmlspecialchars($row["salary"]) . "</td><td>" . htmlspecialchars($row["birthday"]) . "</td><td>" . htmlspecialchars($row["ssn"]) . "</td><td>" . htmlspecialchars($row["address"]) . "</td><td>" . htmlspecialchars($row["email"]) . "</td><td>" . htmlspecialchars($row["nickname"]) . "</td><td>" . htmlspecialchars($row["phone"]) . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No records found.";
                }
            } else {
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
</body>
</html>
