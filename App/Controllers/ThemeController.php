<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ThemeController
{
    public function switch(Request $request)
    {
        // Get mode from POST form
        $mode = $request->request->get("mode", "light");

        // Check if the mode is valid
        if (!in_array($mode, ["light", "dark"])) {
            $mode = "light";
        }        

        // Redirect back to the referring page or home if no referrer
        $redirect = $request->headers->get("referer", "/");
        $response =  new RedirectResponse($redirect, 303);

        //Set cookie for 30 days
        $response->headers->setCookie(
            Cookie::create("theme", $mode, time() + 60*60*24*30, "/", null, false, false, false, "Lax")
        );

        return $response;
    }
}