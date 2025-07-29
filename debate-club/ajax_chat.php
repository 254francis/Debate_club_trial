<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'send') {
    $msg = trim($_POST['message']);
    if ($msg !== '') {
        $stmt = $conn->prepare("INSERT INTO chat (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $_SESSION['user_id'], $msg);
        $stmt->execute();
    }
    exit;
}

// GET request — fetch messages
$res = $conn->query("SELECT c.message, u.name, c.timestamp FROM chat c JOIN users u ON c.user_id = u.id ORDER BY c.timestamp DESC LIMIT 50");
while ($row = $res->fetch_assoc()) {
    echo "<div class='msg'><strong>{$row['name']}:</strong> {$row['message']} <small class='text-muted'>[" . date('H:i', strtotime($row['timestamp'])) . "]</small></div>";
}
