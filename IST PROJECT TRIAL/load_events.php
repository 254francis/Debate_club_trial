<?php
include '../db.php';

$result = $conn->query("SELECT title, date FROM events ORDER BY date ASC");

$events = [];
while ($row = $result->fetch_assoc()) {
  $events[] = $row;
}

header('Content-Type: application/json');
echo json_encode($events);
