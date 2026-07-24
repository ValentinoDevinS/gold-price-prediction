<?php

declare(strict_types=1);

namespace App\Contracts\Ui;

interface StyleContract
{
    public static function make(...$arguments): string;
}