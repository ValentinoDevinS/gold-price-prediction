<?php

namespace App\Helpers;

class HashHelper
{
    /**
     * Generate the project's standard hash.
     */
    public static function generate(string $value): string
    {
        return hash('sha256', $value);
    }

    public static function verify(
        string $value,
        string $hash
    ): bool {
        return self::generate($value) === $hash;
    }
}