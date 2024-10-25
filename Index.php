<?php 
require('./Database.php');

$errorMessage = '';

if (isset($_POST['register'])) {
    $fullName = $_POST['fullName']; // Match the form field name
    $email = $_POST['email']; // Match the form field name
    $password = $_POST['password']; // Match the form field name
    $phoneNumber = $_POST['phoneNumber']; // Match the form field name

    // Validate that the full name does not contain numbers
    if (preg_match('/[0-9]/', $fullName)) {
        $errorMessage = "Error: Full Name must not contain numbers.";
    }
    // Validate that the email is in a valid format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Error: Invalid email format.";
    }
    // Insert the data into the database
    else {
        $queryCreate = "INSERT INTO tbl3aaa (`Full Name`, `EmailAddress`, `Password`, `Phone Number`) VALUES ('$fullName', '$email', '$password', '$phoneNumber')";
        $sqlCreate = mysqli_query($connection, $queryCreate);

        if ($sqlCreate) {
            echo '<script>window.location.href = "/JOAN-BSIS3A/Login.php"</script>';
        } else {
            $errorMessage = "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Vaccination Registration</title>
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
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Vaccination Registration</h1>
    <form method="POST" action="">
        <input type="text" name="fullName" placeholder="Full Name" required pattern="[A-Za-z\s]+" title="Full Name must not contain numbers.">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phoneNumber" placeholder="Phone Number" required pattern="\d{11}" title="Phone Number must be 11 digits.">
        <button type="submit" name="register">Register</button>
        <p>Already have an account? <a href="Login.php">Log in</a></p>
        
        <?php if ($errorMessage): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
    </form>
</div>
</body>
</html>
