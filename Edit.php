<?php
require('./Database.php');

$editID = $editFullName = $editChildName = $editChildAge = $editAddress = $editPhoneNumber = ''; // Initialize variables

if (isset($_POST['edit'])) {
    $editID = $_POST['editID'];
    $result = mysqli_query($connection, "SELECT * FROM registration WHERE ID = $editID");
    
    if ($result && mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $editFullName = $row['Full Name'];
        $editChildName = $row['Child Name'];
        $editChildAge = $row['Child Age'];
        $editAddress = $row['Address'];
        $editPhoneNumber = $row['Phone Number'];
    } else {
        echo '<script>alert("User not found!"); window.location.href="/JOAN-BSIS3A/Admin.php";</script>';
        exit();
    }
}

if (isset($_POST['update'])) {
    $updateID = $_POST['updateID'];
    $updateFullName = mysqli_real_escape_string($connection, $_POST['updateFullName']);
    $updateChildName = mysqli_real_escape_string($connection, $_POST['updateChildName']);
    $updateChildAge = mysqli_real_escape_string($connection, $_POST['updateChildAge']);
    $updateAddress = mysqli_real_escape_string($connection, $_POST['updateAddress']);
    $updatePhoneNumber = mysqli_real_escape_string($connection, $_POST['updatePhoneNumber']);

    if (mysqli_query($connection, "UPDATE registration SET `Full Name`='$updateFullName', `Child Name`='$updateChildName', `Child Age`='$updateChildAge', `Address`='$updateAddress', `Phone Number`='$updatePhoneNumber' WHERE ID=$updateID")) {
        echo '<script>alert("Successfully Edited!"); window.location.href="/JOAN-BSIS3A/Admin.php";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($connection) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h3 {
            text-align: center;
            color: #343a40;
        }
        .form-control {
            margin-bottom: 15px; /* Space between input fields */
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Data Information</h1>
        <form method="post">
            <h3>Edit Info</h3>
            <div class="form-group">
                <input type="text" name="updateFullName" placeholder="Enter Full Name" value="<?php echo htmlspecialchars($editFullName); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updateChildName" placeholder="Enter Child Name" value="<?php echo htmlspecialchars($editChildName); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="number" name="updateChildAge" placeholder="Enter Child Age" value="<?php echo htmlspecialchars($editChildAge); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updateAddress" placeholder="Enter Address" value="<?php echo htmlspecialchars($editAddress); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <input type="text" name="updatePhoneNumber" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($editPhoneNumber); ?>" required class="form-control" />
            </div>
            <button type="submit" name="update" class="btn btn-primary">SAVE</button>
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($editID); ?>"/>
        </form>
    </div>
</body>
</html>
