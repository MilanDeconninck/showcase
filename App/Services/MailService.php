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

            $mail->isSMTP();
            $mail->Host = $_ENV["MAIL_HOST"];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV["MAIL_USERNAME"];
            $mail->Password = $_ENV["MAIL_PASSWORD"];
            $mail->Port = (int) $_ENV["MAIL_PORT"];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                "milan.deconninck@gmail.com",
                "Contact Portfolio"
            );

            $mail->addAddress("milan.deconninck@gmail.com", "Milan Deconninck");

            $mail->isHTML(true);
            $mail->Subject = "Contact " . $contact["name"] . (!empty($contact["company"]) ? " - " . $contact["company"] : "");

            $mail->Body = $contact["message"] . " from " . $contact["email"];

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("MAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }
}