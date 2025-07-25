<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');
include 'db.php';

$res = $conn->query("SELECT f.message, f.created_at as timestamp, u.name FROM feedback f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC");
$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
