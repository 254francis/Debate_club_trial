<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>USIU Debate Club Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 80px; background-color: #f4f4f4; }
    .hero { text-align: center; padding: 50px 20px; }
    .btn-lg { margin: 10px; }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">USIU Debate Club</a>
      <div class="ms-auto">
        <a href="login.php" class="btn btn-outline-light">Login</a>
        <a href="register.php" class="btn btn-light">Register</a>
      </div>
    </div>
  </nav>

  <div class="container hero">
    <h1>Welcome to the Debate Club Management System</h1>
    <p class="lead">Manage events, training, finances, resources and more — all in one platform.</p>
    <a href="login.php" class="btn btn-primary btn-lg">Login</a>
    <a href="register.php" class="btn btn-secondary btn-lg">Register</a>
  </div>

</body>
</html>
