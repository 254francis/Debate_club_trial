<?php
session_start();
include 'db.php';

$action = $_POST['action'] ?? '';

if ($action == 'login') {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res && password_verify($pass, $res['password'])) {
        $_SESSION['user_id'] = $res['id'];
        $_SESSION['name'] = $res['name'];
        $_SESSION['role'] = $res['role'];
        header("Location: " . ($res['role'] == 'admin' ? 'admin.php' : 'dashboard.php'));
    } else {
        header("Location: login.php?msg=Invalid credentials");
    }

} elseif ($action == 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $name, $email, $pass);
    $stmt->execute();

    // Send confirmation email
    include 'send_mail.php';
    sendMail($email, "Welcome to the Debate Club", "Hello $name, you're now registered!");

    header("Location: login.php?msg=Registration successful");
}
?>
