<?php
session_start(); // Start the session
require('./Read.php');

// Handle search functionality
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($connection, $_POST['searchTerm']);
}

// Update query based on actual column names
$queryAccount = "SELECT * FROM registration WHERE `Full Name` LIKE '%$searchTerm%' OR `Child Name` LIKE '%$searchTerm%'";
$sqlAccount = mysqli_query($connection, $queryAccount);

if (!$sqlAccount) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
        }
        .navbar {
            background-color: #343a40; /* Dark gray navbar */
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; /* White text */
        }
        .container {
            margin-top: 20px;
        }
        h1, h3 {
            color: #343a40; /* Dark gray headings */
        }
        .btn-info, .btn-success, .btn-danger, .btn-primary {
            border: none;
        }
        table {
            background-color: #ffffff; /* White table background */
            border-radius: 5px;
            overflow: hidden; /* Rounded corners */
        }
        th {
            background-color: #6c757d; /* Darker gray for header */
            color: white;
        }
        .form-control {
            border-radius: 0.25rem; /* Rounded input fields */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="Page.php">Page</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">SMS Notification</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="AdLog.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- Search Form -->
            <form action="Admin.php" method="post" class="form-inline" style="margin-top: 20px;">
                <input type="text" name="searchTerm" placeholder="Search by Name or Email" class="form-control" required />
                <input type="submit" name="search" value="SEARCH" class="btn btn-info ml-2" />
            </form>
        </div>
    </div>

    <br>

    <form action="Create.php" method="post">
        <h3>Create User Info</h3>
        <input type="text" name="FullName" placeholder="Enter Full Name" required class="form-control mb-2" />
        <input type="text" name="ChildName" placeholder="Enter Child Name" required class="form-control mb-2" />
        <input type="number" name="ChildAge" placeholder="Enter Child Age" required class="form-control mb-2" />
        <input type="text" name="Address" placeholder="Enter Address" required class="form-control mb-2" />
        <input type="text" name="PhoneNumber" placeholder="Enter Phone Number" required class="form-control mb-2" />
        <input type="submit" name="create" value="CREATE" class="btn btn-success" />
    </form>

    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Child Name</th>
            <th>Child Age</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        <?php while ($results = mysqli_fetch_array($sqlAccount)) { ?>
            <tr>
                <td><?php echo $results['ID']; ?></td>
                <td><?php echo htmlspecialchars($results['Full Name']); ?></td>
                <td><?php echo htmlspecialchars($results['Child Name']); ?></td>
                <td><?php echo htmlspecialchars($results['Child Age']); ?></td>
                <td><?php echo htmlspecialchars($results['Address']); ?></td>
                <td><?php echo htmlspecialchars($results['Phone Number']); ?></td>
                <td>
                    <form action="Edit.php" method="post" style="display:inline;">
                        <input type="submit" name="edit" value="EDIT" class="btn btn-primary" style="width: 80px;">
                        <input type="hidden" name="editID" value="<?php echo $results['ID']; ?>">
                        <input type="hidden" name="editN" value="<?php echo htmlspecialchars($results['Full Name']); ?>">
                        <input type="hidden" name="editChildName" value="<?php echo htmlspecialchars($results['Child Name']); ?>">
                        <input type="hidden" name="editChildAge" value="<?php echo htmlspecialchars($results['Child Age']); ?>">
                        <input type="hidden" name="editAddress" value="<?php echo htmlspecialchars($results['Address']); ?>">
                        <input type="hidden" name="editP" value="<?php echo htmlspecialchars($results['Phone Number']); ?>">
                    </form>
                    <form action="Delete.php" method="post" style="display:inline;">
                        <input type="submit" name="delete" value="DELETE" class="btn btn-danger">
                        <input type="hidden" name="deleteID" value="<?php echo $results['ID']; ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
