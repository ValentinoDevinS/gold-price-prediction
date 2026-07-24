<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class AlertStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-start',
                'gap-4',
                'rounded-lg',
                'border',
                'p-4',
                'shadow-sm',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'mt-0.5',
                'h-5',
                'w-5',
                'shrink-0',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'flex-1',
                'min-w-0',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-sm',
                'font-semibold',
            ])
            ->build();
    }

    public function description(): string
    {
        return $this->builder()
            ->addMany([
                'mt-1',
                'text-sm',
                'leading-6',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'mt-3',
                'flex',
                'items-center',
                'gap-2',
            ])
            ->build();
    }

    public function closeButton(): string
    {
        return $this->builder()
            ->addMany([
                'ml-auto',
                'inline-flex',
                'h-8',
                'w-8',
                'items-center',
                'justify-center',
                'rounded-md',
                'transition-colors',
                'hover:bg-black/5',
                'focus:outline-none',
                'focus:ring-2',
                'focus:ring-offset-2',
            ])
            ->build();
    }
}