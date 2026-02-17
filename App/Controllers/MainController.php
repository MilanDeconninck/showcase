<?php

declare(strict_types=1);

namespace App\Controllers;


class MainController
{
    public function __construct()
    {
    }

    public function index()
    {
        return [
                'darkModeEnabled' => false,
                'language' => 'nl',
        ];
    }
}
