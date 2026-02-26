<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\MailService;
use App\Services\MessageService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        // Get language
        $locale = $request->attributes->get("_locale");
        // Get theme
        $theme = $request->cookies->get("theme", "light");

        return [
            "language" => $locale,
            "theme" => $theme,
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

            // Send mail with data to my personal email
            $mailService = new MailService();

            $sent = $mailService->sendContactMail($contact);

            // Return to site
            return new RedirectResponse('/contact?success=1');
        }

        return [
            "errors" => $errors,
            "old" => $_POST,
            "theme" => $_COOKIE["theme"] ?? "light",
        ];
    }
}
