<?php

declare(strict_types=1);

namespace App\Support\Navigation;

final class Navigation
{
    public static function groups(): array
    {
        return (new NavigationBuilder())->build();
    }
}