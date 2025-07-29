<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $_SESSION['user_id'], $_POST['message']);
    $stmt->execute();
    $success = true;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Submit Feedback</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
  <h3>Submit Feedback</h3>
  <?php if (!empty($success)): ?>
    <div class="alert alert-success">Feedback submitted successfully.</div>
  <?php endif; ?>
  <form method="POST">
    <textarea name="message" rows="5" class="form-control mb-3" placeholder="Write your feedback here..." required></textarea>
    <button class="btn btn-primary">Submit</button>
    <a href="dashboard.php" class="btn btn-secondary">Back</a>
  </form>
</body>
</html>
