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

// Employee data to insert
$employees = [
    ['name' => 'Admin', 'password' => password_hash('seedadmin', PASSWORD_DEFAULT), 'salary' => 400000, 'birthday' => '1943-05-03', 'ssn' => '43254314', 'address' => 'Admin Address', 'email' => 'admin@example.com', 'nickname' => 'AdminNick', 'phone' => '1234567890'],
    ['name' => 'Alice', 'password' => password_hash('seedalice', PASSWORD_DEFAULT), 'salary' => 20000, 'birthday' => '1989-09-20', 'ssn' => '10211002', 'address' => 'Alice Address', 'email' => 'alice@example.com', 'nickname' => 'AliceNick', 'phone' => '0987654321'],
    ['name' => 'Boby', 'password' => password_hash('seedboby', PASSWORD_DEFAULT), 'salary' => 50000, 'birthday' => '1982-04-20', 'ssn' => '10213352', 'address' => 'Boby Address', 'email' => 'boby@example.com', 'nickname' => 'BobyNick', 'phone' => '1122334455'],
    ['name' => 'Ryan', 'password' => password_hash('seedryan', PASSWORD_DEFAULT), 'salary' => 90000, 'birthday' => '1980-04-10', 'ssn' => '32193525', 'address' => 'Ryan Address', 'email' => 'ryan@example.com', 'nickname' => 'RyanNick', 'phone' => '2233445566'],
    ['name' => 'Samy', 'password' => password_hash('seedsamy', PASSWORD_DEFAULT), 'salary' => 40000, 'birthday' => '1991-01-11', 'ssn' => '32111111', 'address' => 'Samy Address', 'email' => 'samy@example.com', 'nickname' => 'SamyNick', 'phone' => '3344556677'],
    ['name' => 'Ted', 'password' => password_hash('seedted', PASSWORD_DEFAULT), 'salary' => 110000, 'birthday' => '1963-11-03', 'ssn' => '24343244', 'address' => 'Ted Address', 'email' => 'ted@example.com', 'nickname' => 'TedNick', 'phone' => '4455667788']
];

// Insert data into the database
foreach ($employees as $employee) {
    $stmt = $conn->prepare("INSERT INTO employees (name, password, salary, birthday, ssn, address, email, nickname, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssssss", $employee['name'], $employee['password'], $employee['salary'], $employee['birthday'], $employee['ssn'], $employee['address'], $employee['email'], $employee['nickname'], $employee['phone']);
    $stmt->execute();
}

echo "Data inserted successfully";

$stmt->close();
$conn->close();
?>
