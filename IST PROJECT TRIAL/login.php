<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Debate Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d);
      color: #fff;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      width: 100%;
      max-width: 400px;
      background-color: #f8f9fa;
      color: #212529;
      border: none;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      padding: 2rem;
    }
    .form-control:focus {
      border-color: #457b9d;
      box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
    }
    .btn-primary {
      background-color: #457b9d;
      border-color: #457b9d;
    }
    .btn-primary:hover {
      background-color: #1d3557;
      border-color: #1d3557;
    }
    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="card">
    <h4 class="mb-4 text-center">🔐 Debate Club Login</h4>

    <!-- Session Alerts -->
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form action="authenticate.php" method="POST" novalidate>
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="e.g. name@domain.com" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="********" required>
      </div>
      <button class="btn btn-primary w-100 mt-2" type="submit">Login</button>
    </form>

    <div class="text-center mt-3">
      <small>Don't have an account? <a href="register.php">Register Here</a></small>
    </div>
  </div>

</body>
</html>
