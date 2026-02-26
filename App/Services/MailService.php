<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function sendContactMail(array $contact): bool
    {
        $mail = new PHPMailer(true);
        try {
            // Input email information via .env
            $mail->isSMTP();
            $mail->Host = $_ENV["MAIL_HOST"];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV["MAIL_USERNAME"];
            $mail->Password = $_ENV["MAIL_PASSWORD"];
            $mail->Port = (int) $_ENV["MAIL_PORT"];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->CharSet = 'UTF-8';

            // Send mail to myself
            $mail->setFrom(
                "milan.deconninck@gmail.com",
                "Contact Portfolio"
            );

            // Mail details
            $mail->addAddress("milan.deconninck@gmail.com", "Milan Deconninck");

            $mail->isHTML(true);
            $mail->Subject = "Contact " . $contact["name"] . (!empty($contact["company"]) ? " - " . $contact["company"] : "");

            $mail->Body = $contact["message"] . " from " . $contact["email"];

            $mail->send();
            return true;

        } catch (Exception $e) {
            // Catch problems with sending email
            error_log("MAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }
}