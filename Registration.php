<?php  
require('./Database.php');

$errorMessage = '';
$successMessage = ''; // Variable to store success message

if (isset($_POST['register'])) {
    $fullName = $_POST['fullName'];
    $childName = $_POST['childName'];
    $childAge = $_POST['childAge'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];

    // Validate that the full name does not contain numbers
    if (preg_match('/[0-9]/', $fullName)) {
        $errorMessage = "Error: Full Name must not contain numbers.";
    }
    // Validate that the child name does not contain numbers
    elseif (preg_match('/[0-9]/', $childName)) {
        $errorMessage = "Error: Child Name must not contain numbers.";
    }
    // Validate that the child age is a positive integer
    elseif (!filter_var($childAge, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
        $errorMessage = "Error: Child Age must be a positive integer.";
    }
    // Validate that the address is not empty
    elseif (empty($address)) {
        $errorMessage = "Error: Address cannot be empty.";
    }
    // Validate that the phone number is numeric and exactly 11 digits
    elseif (!preg_match('/^\d{11}$/', $phoneNumber)) {
        $errorMessage = "Error: Phone Number must be exactly 11 digits.";
    } 
    // Insert the data into the database
    else {
        $queryCreate = "INSERT INTO registration (`Full Name`, `Child Name`, `Child Age`, `Address`, `Phone Number`) VALUES ('$fullName', '$childName', '$childAge', '$address', '$phoneNumber')";
        $sqlCreate = mysqli_query($connection, $queryCreate);

        if ($sqlCreate) {
            $successMessage = "Registration successful!"; // Set success message
            echo '<script>setTimeout(function() { window.location.href = "/JOAN-BSIS3A/Page.php"; }, 3000);</script>'; // Redirect after 3 seconds
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
        input:focus, button:focus {
            border-color: #00796b;
            outline: none;
        }
        button {
            background-color: #00796b;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #004d40;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
        }
        a {
            color: #00796b;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Child Registration</h1>
    <form method="POST" action="">
        <input type="text" name="fullName" placeholder="Full Name" required pattern="[A-Za-z\s]+" title="Full Name must not contain numbers.">
        <input type="text" name="childName" placeholder="Child Name" required pattern="[A-Za-z\s]+" title="Child Name must not contain numbers.">
        <input type="number" name="childAge" placeholder="Child Age" required min="0" title="Child Age must be a positive integer.">
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="phoneNumber" placeholder="Phone Number" required pattern="^\d{11}$" title="Phone Number must be exactly 11 digits.">
        <button type="submit" name="register">Register</button>
       
        <?php if ($errorMessage): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
        <?php if ($successMessage): ?>
            <div class="success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        
    </form>
</div>
</body>
</html>
