<?php

declare(strict_types=1);

namespace App\Controllers;

use Twig\Environment;

class MainController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): string
    {
        return $this->twig->render('index.twig');
    }
}
