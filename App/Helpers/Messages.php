<?php
// App/Helpers/Messages.php

declare(strict_types=1);

namespace App\Helpers;

class Messages
{
    private static ?array $messages = null;

    // Load Message files
    public static function load(string $locale = "nl"): void
    {
        self::$messages = require(__DIR__ . "/../../languages/$locale/messages.php");
    }


    public static function get(string $keyPath, mixed $replace = null, $default = null): mixed
    {
        // Auto-load Messages
        if (self::$messages === null) {
            self::load();
        }

        // Convert to array
        $keys = explode('.', $keyPath);
        $message = self::$messages;

        foreach ($keys as $key) {
            if (is_array($message) && array_key_exists($key, $message)) {
                $message = $message[$key];
            } else {
                return $default;
            }
        }

        // Replace placeholder
        if (is_string($message) && is_array($replace)) {
            foreach ($replace as $search => $value) {
                $message = str_replace("{{$search}}", (string)$value, $message);
            }
        }

        return $message;
    }
}