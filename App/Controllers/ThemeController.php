<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;

class ThemeController
{
    public function switch(Request $request): RedirectResponse
    {
        $mode = $request->attributes->get('mode');
        if (!in_array($mode, ['light','dark'])) {
            $mode = 'light';
        }

        // Redirect back to the previous page
        $referer = $request->headers->get('referer') ?? '/';
        $response = new RedirectResponse($referer);

        // Set a cookie that lasts 1 year
        $cookie = new Cookie('theme', $mode, strtotime('+1 year'), '/');
        $response->headers->setCookie($cookie);

        return $response;
    }
}
