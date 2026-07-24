<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class ConfirmationDialogStyle extends BaseStyle
{
    public function overlay(): string
    {
        return $this->builder()
            ->addMany([
                'fixed',
                'inset-0',
                'z-50',
                'flex',
                'items-center',
                'justify-center',
                'bg-black/50',
                'backdrop-blur-sm',
                'p-4',
            ])
            ->build();
    }

    public function container(): string
    {
        return $this->builder()
            ->addMany([
                'w-full',
                'max-w-md',
                'rounded-xl',
                'bg-white',
                'shadow-2xl',
                'dark:bg-gray-800',
            ])
            ->build();
    }

    public function icon(): string
    {
        return $this->builder()
            ->addMany([
                'mx-auto',
                'flex',
                'h-12',
                'w-12',
                'items-center',
                'justify-center',
                'rounded-full',
            ])
            ->build();
    }

    public function content(): string
    {
        return $this->builder()
            ->addMany([
                'px-6',
                'pt-6',
                'text-center',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'mt-4',
                'text-lg',
                'font-semibold',
                'text-gray-900',
                'dark:text-white',
            ])
            ->build();
    }

    public function description(): string
    {
        return $this->builder()
            ->addMany([
                'mt-2',
                'text-sm',
                'leading-6',
                'text-gray-500',
                'dark:text-gray-400',
            ])
            ->build();
    }

    public function footer(): string
    {
        return $this->builder()
            ->addMany([
                'mt-6',
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
                'justify-end',
                'gap-3',
            ])
            ->build();
    }
}