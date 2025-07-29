<?php
session_start();
require_once 'db.php';

// PHPMailer imports
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

// Get and sanitize input
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Basic validation
if (!$name || !$email || strlen($password) < 6) {
    $_SESSION['error'] = "All fields are required and password must be at least 6 characters.";
    header("Location: register.php");
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "Email already in use.";
    header("Location: register.php");
    exit;
}

// Create user
$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {
    // Auto-login
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['name'] = $name;
    $_SESSION['role'] = 'user';

    // Send welcome email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sadstrial@gmail.com'; // CHANGE THIS to admin email
        $mail->Password   = 'Debate123'; // CHANGE THIS to admin email password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('sadstrial@gmail.com', 'Debate Club'); // match Gmail account

        $mail->addAddress($email, $name);

        $mail->Subject = 'Welcome to the Debate Club!';
        $mail->Body    = "Hi $name,\n\nWelcome to the Debate Club! You can now log in and start exploring.\n\nBest,\nThe Committee";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
    }

    // Redirect to user dashboard
    header("Location: user/dashboard.html"); // or user/dashboard.php
    exit;
} else {
    $_SESSION['error'] = "Registration failed. Try again.";
    header("Location: register.php");
    exit;
}
