<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Our Vaccination Center</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        nav {
            background-color: #007bff;
        }
        nav .navbar-brand,
        nav .navbar-nav a {
            color: #fff !important;
        }
        .hero {
            background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1920');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .hero h1 {
            font-size: 4rem;
            margin: 0;
        }
        .hero p {
            font-size: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .card h3 {
            color: #007bff;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-info"> 
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Health Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="Page.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="hero">
    <div>
        <h1>Welcome to Our Vaccination Center</h1>
        <p>Your child's health is our priority!</p>
    </div>
</div>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-4">
                <h3><i class="fas fa-user-shield"></i> Child-Centered Care</h3>
                <p>We prioritize the comfort and well-being of your child during vaccinations.</p>
                <p>Our friendly staff ensures a positive experience every time.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h3><i class="fas fa-user-md"></i> Expert Medical Team</h3>
                <p>Our qualified professionals are dedicated to providing the highest standard of care.</p>
                <p>We stay updated with the latest health guidelines and vaccination protocols.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h3><i class="fas fa-stethoscope"></i> Comprehensive Services</h3>        
                <p>We offer a range of vaccinations to protect your child's health.</p>
                <p>From routine immunizations to travel vaccines, we are here to help.</p>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Vaccination Center. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
