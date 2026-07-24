<?php

declare(strict_types=1);

namespace App\Enums\Ui;

enum ButtonVariant: string
{
    case Primary = 'primary';
    case Secondary = 'secondary';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
    case Ghost = 'ghost';

    public static function defaultVariant(): self
    {
        return self::Primary;
    }
}