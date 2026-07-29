<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

final class StatGridStyle
{
    public function wrapper(int $columns): string
    {
        $grid = match ($columns) {
            2 => 'md:grid-cols-2',
            3 => 'md:grid-cols-3',
            4 => 'md:grid-cols-4',
            default => 'md:grid-cols-4',
        };

        return implode(' ', [
            'grid',
            'grid-cols-1',
            $grid,
            'gap-6',
        ]);
    }
}