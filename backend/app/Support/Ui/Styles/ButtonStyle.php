<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class ButtonStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'inline-flex',
                'items-center',
                'justify-center',
                'gap-2',
                'rounded-lg',
                'px-4',
                'py-2',
                'text-sm',
                'font-medium',
                'transition-colors',
                'duration-200',
                'focus:outline-none',
                'focus:ring-2',
                'focus:ring-offset-2',
                'disabled:cursor-not-allowed',
                'disabled:opacity-50',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-4',
                'shrink-0',
            ])
            ->build();
    }

    public function label(): string
    {
        return $this->builder()
            ->addMany([
                'truncate',
            ])
            ->build();
    }

    public function loadingIcon(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-4',
                'animate-spin',
            ])
            ->build();
    }
}