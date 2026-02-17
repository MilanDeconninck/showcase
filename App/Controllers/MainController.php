<?php

declare(strict_types=1);

namespace App\Controllers;


class MainController
{
    public function __construct()
    {}

    public function index()
    {
        return [
            'title' => 'Welcome to the Showcase',
            'description' => 'This is a simple PHP application using Symfony components and Twig.',
        ];
    }
}
