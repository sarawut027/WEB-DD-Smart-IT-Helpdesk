<?php
namespace App\Notifications;

use PHPMailer\PHPMailer\PHPMailer;

class GmailService
{
    public function send(string $toEmail, string $subject, string $body): bool
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your.email@gmail.com'; // **เปลี่ยนเป็นอีเมลคุณ**
            $mail->Password = 'your_app_password';    // **เปลี่ยนเป็น App Password 16 หลัก**
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';

            $mail->setFrom('your.email@gmail.com', 'Smart IT Helpdesk');
            $mail->addAddress($toEmail);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (\Exception $e) {
            error_log("Mail Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}