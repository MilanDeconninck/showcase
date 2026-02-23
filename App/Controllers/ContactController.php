<?php

declare(strict_types=1);

namespace App\Controllers;


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
}
