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
        // Get language
        $locale = $request->attributes->get("_locale");
        // Get theme
        $theme = $request->cookies->get("theme", "light");

        return [
            "language" => $locale,
            "theme" => $theme,
        ];
    }
}
