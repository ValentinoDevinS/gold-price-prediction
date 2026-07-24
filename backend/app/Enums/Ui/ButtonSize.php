<?php

declare(strict_types=1);

namespace App\Enums\Ui;

enum ButtonSize: string
{
    case Small = 'sm';
    case Medium = 'md';
    case Large = 'lg';

    public static function defaultSize(): self
    {
        return self::Medium;
    }
}