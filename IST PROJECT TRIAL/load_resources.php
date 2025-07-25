<?php
include 'db.php';

$q = $_GET['q'] ?? '';
$stmt = $conn->prepare("SELECT * FROM resources WHERE title LIKE ? ORDER BY id DESC LIMIT 20");
$search = "%$q%";
$stmt->bind_param("s", $search);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $title = htmlspecialchars($row['title']);
    $filePath = $row['file_path'];
    $link = filter_var($filePath, FILTER_VALIDATE_URL) ? $filePath : 'uploads/' . $filePath;
    $badge = filter_var($filePath, FILTER_VALIDATE_URL) ? " <span class='badge bg-info'>External</span>" : "";
    echo "<div class='mb-2'><a href='$link' target='_blank'>$title</a>$badge</div>";
}
?>
