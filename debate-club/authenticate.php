<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $name, $hashedPassword, $role);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;

        if ($role === 'admin') {
            header("Location: admin-panel.html");
        } else {
            header("Location: user/dashboard.html");
        }
        exit;
    }
}

$_SESSION['error'] = "Invalid credentials.";
header("Location: login.php");
exit;
?>
