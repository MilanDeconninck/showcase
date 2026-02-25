<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $locale = $request->attributes->get("_locale");
        $theme = $request->cookies->get("theme", "light");

        return [
            'language' => $locale,
            'theme' => $theme,
        ];
    }
}
