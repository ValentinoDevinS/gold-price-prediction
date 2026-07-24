<?php

declare(strict_types=1);

namespace App\Support\Ui\Styles;

use App\Support\Ui\BaseStyle;

final class SkeletonStyle extends BaseStyle
{
    public function wrapper(): string
    {
        return $this->builder()
            ->addMany([
                'animate-pulse',
            ])
            ->build();
    }

    public function line(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'w-full',
                'rounded',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function title(): string
    {
        return $this->builder()
            ->addMany([
                'h-6',
                'w-1/3',
                'rounded',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function text(): string
    {
        return $this->builder()
            ->addMany([
                'h-4',
                'rounded',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function circle(): string
    {
        return $this->builder()
            ->addMany([
                'h-10',
                'w-10',
                'rounded-full',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function avatar(): string
    {
        return $this->builder()
            ->addMany([
                'h-12',
                'w-12',
                'rounded-full',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function button(): string
    {
        return $this->builder()
            ->addMany([
                'h-10',
                'w-24',
                'rounded-lg',
                'bg-gray-200',
                'dark:bg-gray-700',
            ])
            ->build();
    }

    public function card(): string
    {
        return $this->builder()
            ->addMany([
                'rounded-xl',
                'border',
                'border-gray-200',
                'bg-white',
                'p-6',
                'shadow-sm',
                'dark:border-gray-700',
                'dark:bg-gray-800',
            ])
            ->build();
    }
}