<?php
session_start();
include 'db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Default role is 'user'
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    $_SESSION['success'] = "Account created! Please login.";
    header("Location: login.php");
    exit;
} else {
    $_SESSION['error'] = "Registration failed. Email may already exist.";
    header("Location: register.php");
    exit;
}
?>
