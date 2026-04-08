<?php

namespace App\Helpers;

class Container
{

    private static array $container = [];

    public static function set(string $key, mixed $value): void
    {
        self::$container[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$container[$key] ?? $default;
    }

}
