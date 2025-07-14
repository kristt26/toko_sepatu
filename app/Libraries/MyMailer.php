<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MyMailer
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Konfigurasi SMTP Gmail
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'emailfortesting1011@gmail.com';
        $this->mail->Password   = 'lycv kbhb nemx wgmn'; // App Password Gmail
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;

        $this->mail->setFrom('emailfortesting1011@gmail.com', 'Sneakers Jayapura');
        $this->mail->isHTML(true);
    }

    public function send($to, $subject, $body)
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return $this->mail->ErrorInfo;
        }
    }
}
