<?php
session_start();
if ($_SESSION['role'] !== 'admin') die('Access denied');
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO finance (description, amount, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $_POST['description'], $_POST['amount'], $_POST['category']);
    $stmt->execute();
}

$res = $conn->query("SELECT * FROM finance ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Finance Manager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
  <h3>Finance Overview</h3>
  <form method="POST" class="row g-2 mb-4">
    <div class="col-md-4"><input name="description" class="form-control" placeholder="Expense Description" required></div>
    <div class="col-md-3"><input name="amount" type="number" class="form-control" placeholder="Amount (Ksh)" required></div>
    <div class="col-md-3">
      <select name="category" class="form-control">
        <option value="logistics">Logistics</option>
        <option value="tournaments">Tournaments</option>
        <option value="training">Training</option>
      </select>
    </div>
    <div class="col-md-2"><button class="btn btn-success w-100">Add</button></div>
  </form>

  <a href="export.php?type=csv" class="btn btn-primary btn-sm me-2">Export CSV</a>
  <a href="export.php?type=pdf" class="btn btn-danger btn-sm">Export PDF</a>

  <table class="table table-bordered mt-3">
    <thead><tr><th>Description</th><th>Amount</th><th>Category</th><th>Date</th></tr></thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()): ?>
        <tr>
          <td><?= $row['description'] ?></td>
          <td>Ksh <?= number_format($row['amount']) ?></td>
          <td><?= ucfirst($row['category']) ?></td>
          <td><?= $row['created_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="admin.php" class="btn btn-secondary mt-3">Back to Admin</a>
</body>
</html>
