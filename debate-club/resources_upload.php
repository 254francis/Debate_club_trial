<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("403 Unauthorized");

include 'db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $user_id = $_SESSION['user_id'];

    if ($type == 'link') {
        $link = $_POST['link'];
        $stmt = $conn->prepare("INSERT INTO resources (title, file_path, uploaded_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $link, $user_id);
    } else {
        $file = basename($_FILES['file']['name']);
        $path = 'uploads/' . $file;
        move_uploaded_file($_FILES['file']['tmp_name'], $path);
        $stmt = $conn->prepare("INSERT INTO resources (title, file_path, uploaded_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $file, $user_id);
    }
    $stmt->execute();
    $msg = "Resource added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Resource</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
<h3>Add Resource</h3>
<form method="POST" enctype="multipart/form-data">
    <input name="title" class="form-control mb-2" placeholder="Resource Title" required>
    <select name="type" id="type" class="form-control mb-2" onchange="toggleUpload()" required>
        <option value="">Select Type</option>
        <option value="file">Upload File</option>
        <option value="link">External Link</option>
    </select>
    <div id="file-upload" class="mb-2" style="display:none;">
        <input type="file" name="file" class="form-control">
    </div>
    <div id="link-upload" class="mb-2" style="display:none;">
        <input type="url" name="link" class="form-control" placeholder="https://example.com">
    </div>
    <button class="btn btn-primary">Add Resource</button>
</form>
<p><?= \$msg ?></p>

<script>
function toggleUpload() {
    const type = document.getElementById('type').value;
    document.getElementById('file-upload').style.display = type === 'file' ? 'block' : 'none';
    document.getElementById('link-upload').style.display = type === 'link' ? 'block' : 'none';
}
</script>
</body>
</html>
