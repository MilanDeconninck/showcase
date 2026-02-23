<?php

declare(strict_types=1);

namespace App\Controllers;

class ThemeController
{
    public function switch()
    {
        $mode = $_POST['mode'] ?? 'light';

        //check if the mode is valid
        if (!in_array($mode, ['light', 'dark'])) {
            $mode = 'light';
        }

        // Set the theme cookie for 30 days
        setcookie(
            'theme',
            $mode,
            [
                'expires' => time() + (60 * 60 * 24 * 30),
                'path' => '/',
                'samesite' => 'Lax'
            ]
        );

        // Redirect back to the referring page or home if no referrer
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/';
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $redirect);
        exit;
    }
}