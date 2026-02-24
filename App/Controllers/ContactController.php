<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\MailService;
use App\Services\MessageService;

class ContactController
{
    public function __construct()
    {
    }

    public function index()
    {
        $theme = $_COOKIE['theme'] ?? 'light';

        return [
            'language' => 'nl',
            'theme' => $theme,
        ];
    }

    public function submit()
    {
        $errors = [];

        // Get data from form
        $name = $_POST["name"] ?? "";
        $company = $_POST["company"] ?? "";
        $email = $_POST["email"] ?? "";
        $message = $_POST["message"] ?? "";

        // Check if data is complete
        if(empty($name)) {$errors["name"] = "Naam is verplicht";}
        if(empty($email)) {$errors["email"] = "Email is verplicht";}
        if(empty($message)) {$errors["message"] = "Gelieve een bericht in te geven.";}

        if(empty($errors)) {
            
            // Send data to database
            $messageService = new MessageService();
            $messageService->createMessage($name, $company, $email, $message);

            $contact = [
                "name" => $name,
                "company" => $company,
                "email" => $email,
                "message" => $message,
            ];

            $mailService = new MailService();

            $sent = $mailService->sendContactMail($contact);

            header("Location: /contact?success=1");
            exit;
        }

        return [
            "errors" => $errors,
            "old" => $_POST,
            "theme" => $_COOKIE["theme"] ?? "light",
        ];
    }
}
