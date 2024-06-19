<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
        }

        input[type=text], input[type=password] {
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

        .employee-info {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9e9e9;
            border-radius: 5px;
        }

        .employee-info h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Employee Login Page</h2>
        <form id="loginForm" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
        <div id="response"></div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get the username and password values
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Send the login request to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "login_backend.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display the response from the server
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("response").innerHTML = `
                            <div class="employee-info">
                                <h3>Employee Information</h3>
                                <p><strong>ID:</strong> ${response.emp_id}</p>
                                <p><strong>Password:</strong> ${response.password}</p>
                                <p><strong>Salary:</strong> ${response.salary}</p>
                            </div>
                        `;
                    } else {
                        document.getElementById("response").innerText = response.message;
                    }
                }
            };
            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
        });
    </script>
</body>
</html>