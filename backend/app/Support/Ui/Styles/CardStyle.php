<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class CardStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'rounded-xl',
                'border',
                'border-gray-200',
                'bg-white',
                'shadow-sm',
                'overflow-hidden',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function header(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'justify-between',
                'gap-4',
                'border-b',
                'border-gray-200',
                'px-6',
                'py-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'text-lg',
                'font-semibold',
                'text-gray-900',
                'dark:text-white',
            ])
            ->build();
    }

    public function subtitle(): string
    {
        return $this->builder()
            ->addMany([
                'mt-1',
                'text-sm',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function body(): string
    {
        return $this->builder()
            ->addMany([
                'p-6',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'px-6',
                'py-4',
                'dark:border-gray-700',
            ])
            ->build();
    }

    public function actions(): string
    {
        return $this->builder()
            ->addMany([
                'flex',
                'items-center',
                'gap-2',
            ])
            ->build();
    }

    public function divider(): string
    {
        return $this->builder()
            ->addMany([
                'border-t',
                'border-gray-200',
                'dark:border-gray-700',
            ])
            ->build();
    }
}