
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require_once '../includes/db.php';
?>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../bootstrap.min.css">

<div class="container mt-5">
<h1 class="mb-4">Admin Dashboard</h1>
<a class="btn btn-danger" href="../logout.php">Logout</a>

<h2 class="mt-4">Events</h2>
<form method="POST" action="../api/events.php" class="mb-3">
  <input type="text" name="title" placeholder="Event Title" class="form-control" required>
  <input type="date" name="date" class="form-control" required>
  <textarea name="description" placeholder="Event Description" class="form-control" required></textarea>
  <button type="submit" class="btn btn-primary mt-2">Add Event</button>
</form>

<?php
$result = $conn->query("SELECT * FROM events");
while($row = $result->fetch_assoc()) {
  echo "<div class='border p-2 mb-2'><strong>{$row['title']}</strong> on {$row['date']}<br>{$row['description']}</div>";
}
?>

<h2 class="mt-4">Manage Users</h2>
<div id="userTable"></div>

<h2 class="mt-4">Finance Report</h2>
<iframe src="../api/finance.php" style="width:100%; height:300px;"></iframe>
<a href="../api/export.php?type=csv" class="btn btn-success mt-2">Export CSV</a>
<a href="../api/export.php?type=pdf" class="btn btn-secondary mt-2">Export PDF</a>
</div>

<script src="../ajax-pagination.js"></script>
