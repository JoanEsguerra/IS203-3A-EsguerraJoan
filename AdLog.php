<?php
session_start(); // Start the session
require('./Database.php');

$errorMessage = ""; // Initialize an error message variable

if (isset($_POST['login'])) { // Change 'select' to 'login' to match the button name
    $UserName = $_POST['email'];
    $Password = $_POST['password'];

    // Prepare and execute the statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM admin WHERE EmailAddress = ? AND Password = ?");
    $stmt->bind_param("ss", $UserName, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Store user ID in session (if needed)
        $_SESSION['user_name'] = $user['Full Name']; // Store user's name in session
        echo '<script>window.location.href = "/JOAN-BSIS3A/Admin.php";</script>';
        exit; // Ensure no further code is executed
    } else {
        $errorMessage = "Please enter correct email and password."; // Set the error message
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: left;
        }
        h1 {
            margin-bottom: 20px;
            color: #00796b;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            background-color: #00796b;
            border: none;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #004d40;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #00796b;
        }
        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log In</h1>
        <form method="POST" action="">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email Address" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Log In</button>

            <?php if ($errorMessage): ?>
                <div class="error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </form>
        <p>Don't have an account? <a href="Ad.php">Register</a></p>
    </div>
</body>
</html>
