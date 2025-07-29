<?php
session_start();
if ($_SESSION['role'] !== 'admin') die('Access denied');
include 'db.php';
$res = $conn->query("SELECT f.message, f.created_at, u.name FROM feedback f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Feedback</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
  <h3>Feedback Received</h3>
  <a href="admin.php" class="btn btn-secondary mb-3">Back</a>
  <ul class="list-group">
    <?php while ($row = $res->fetch_assoc()): ?>
      <li class="list-group-item">
        <strong><?= $row['name'] ?></strong> (<?= $row['created_at'] ?>):<br>
        <?= nl2br(htmlspecialchars($row['message'])) ?>
      </li>
    <?php endwhile; ?>
  </ul>
</body>
</html>
