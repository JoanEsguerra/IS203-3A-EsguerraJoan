<?php 
session_start();
require('./Read.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = '';
$all_feedback = [];

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
$profile_file = "user_profile_{$user_id}.txt";

$profile_pic = 'default-profile.png'; 
if ($user_id) {
    if (!file_exists($profile_file)) {
        file_put_contents($profile_file, "");
    }
    $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : (file_exists($profile_file) ? file_get_contents($profile_file) : 'default-profile.png');
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $target_dir = "uploads/";

    if ($_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        $message = "File upload error: " . $_FILES['profile_pic']['error'];
    } else {
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $file_name = basename($_FILES["profile_pic"]["name"]);
        $file_name = preg_replace('/[^A-Za-z0-9\._-]/', '', $file_name);
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $new_file_name = uniqid($user_id . '_', true) . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;

        $uploadOk = 1;
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            $message = "File is not an image.";
            $uploadOk = 0;
        } elseif ($_FILES["profile_pic"]["size"] > 500000) {
            $message = "File is too large.";
            $uploadOk = 0;
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                file_put_contents($profile_file, $target_file);
                $_SESSION['profile_pic'] = $target_file;
                $profile_pic = $target_file;
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// Handle feedback submission
if (isset($_POST['feedback'])) {
    $feedback = htmlspecialchars(trim($_POST['feedback']));
    if (!empty($feedback)) {
        $feedback_entry = "$user_name: $feedback\n"; 
        file_put_contents('feedback.txt', $feedback_entry, FILE_APPEND);
    } else {
        $message = "Feedback cannot be empty.";
    }
}

if (file_exists('feedback.txt')) {
    $all_feedback = file('feedback.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Vaccination Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #e0f7fa; /* Light blue background similar to login */
    }
    .row.content {height: auto;}
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    .well {
      background-color: #ffffff; /* White background for the content */
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .vaccination-info {
      background-color: #d9edf7; /* Light blue background for vaccination info */
      border: 1px solid #bce8f1;
      padding: 15px;
      margin-top: 20px;
      border-radius: 5px;
    }
    .feedback-form {
      margin-top: 20px;
    }
    .profile-section {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    .profile-section img {
      width: 80px; /* Adjusted size */
      height: 80px;
      border-radius: 50%;
      margin-right: 15px;
      border: 2px solid #00796b; /* Match color with login */
    }
    .upload-button {
      margin-left: 10px;
      margin-top: 10px; /* Align with the file input */
    }
    .file-input {
      margin-right: 10px; /* Space between input and button */
    }
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
      .profile-section {
        flex-direction: column;
        align-items: flex-start;
      }
      .profile-section img {
        margin: 10px 0 0 0;
      }
    }
  </style>
</head>
<body>



<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Vaccination Center</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="Page.php">Dashboard</a></li>
        <li><a href="Registration.php">Child registration</a></li>
        <li><a href="About.php">About us</a></li>
        <li><a href="Ad.php">ADMIN</a></li>
      </ul><br>
    </div>
    
    <div class="col-sm-9">
      <div class="well">
        <div class="profile-section">
          <img src="<?php echo $profile_pic; ?>" alt="Profile Picture">
          <div>
            <h4>Welcome, <?php echo $user_name; ?>!</h4>
            <?php if ($message): ?>
              <div class="alert alert-warning"><?php echo $message; ?></div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data" class="form-inline">
              <input type="file" class="form-control file-input" name="profile_pic" id="profile_pic" accept="image/*" required>
              <button type="submit" class="btn btn-primary upload-button">Upload</button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>What?</h4>
            <p>About vaccination for every Children</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Where?</h4>
            <p>At San Basilio Santa Rita Pampnga</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>How?</h4>
            <p>Website page Registration is now open</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>For?</h4>
            <p>Children monitor vaccination</p> 
          </div>
        </div>
      </div>
      
      <div class="vaccination-info">
        <h4>Vaccination Information for Children</h4>
        <p>Vaccination is vital for protecting children from various diseases. Ensure your child receives the recommended vaccinations on schedule.</p>
        <ul>
          <li><strong>0 to 6 Years:</strong> Vaccinations include Hepatitis B, DTaP, Hib, IPV, MMR, and Varicella.</li>
          <li><strong>7 to 18 Years:</strong> Recommended immunizations are Tdap, Meningococcal, and HPV.</li>
        </ul>
        <p>Consult your pediatrician for the complete vaccination schedule and any questions you may have.</p>
      </div>

      <div class="feedback-form">
        <h4>Submit Feedback</h4>
        <form method="POST">
          <div class="form-group">
            <textarea class="form-control" name="feedback" rows="3" placeholder="Your feedback..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <h4>Recent Feedback</h4>
          <ul class="list-group">
            <?php foreach ($all_feedback as $feedback): ?>
              <li class="list-group-item"><?php echo $feedback; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
