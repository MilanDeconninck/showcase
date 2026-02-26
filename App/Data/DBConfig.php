<?php

declare(strict_types=1);

namespace App\Data;

use Dotenv\Dotenv;
use Symfony\Component\Routing\Matcher\Dumper\StaticPrefixCollection;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->safeLoad();

class DBConfig
{
    public Static function getConnString(): string
    {
        return sprintf(
            "mysql:host=%s;dbname=%s;charset=utf8mb4",
            $_ENV["DB_HOST"],
            $_ENV["DB_DATABASE"]
        );
    }

    public static function getUsername(): string
    {
        return $_ENV["DB_USERNAME"];
    }

    public static function getPassword(): string
    {
        return $_ENV["DB_PASSWORD"];
    }
}