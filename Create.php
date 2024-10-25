<?php
require('./Database.php');

if (isset($_POST['create'])) {
    // Retrieve form data
    $fullName = $_POST['FullName'];
    $childName = $_POST['ChildName'];
    $childAge = $_POST['ChildAge'];
    $address = $_POST['Address'];
    $phoneNumber = $_POST['PhoneNumber'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO registration (`Full Name`, `Child Name`, `Child Age`, `Address`, `Phone Number`) VALUES (?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssiss", $fullName, $childName, $childAge, $address, $phoneNumber);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Successfully Created!")</script>';
        echo '<script>window.location.href = "/JOAN-BSIS3A/Admin.php"</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '")</script>';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
