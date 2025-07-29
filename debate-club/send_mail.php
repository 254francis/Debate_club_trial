<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';      // Replace if using different SMTP like SendGrid etc
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';    //Enter your Gmail if you have one. If not cry.
        $mail->Password = 'your-app-password';       // Gmail App Password please, not your Gmail password a beg.
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'USIU Debate Club');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
    }
}
