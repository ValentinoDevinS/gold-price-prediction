<?php

declare(strict_types=1);

namespace App\Support\Ui;

use Illuminate\Support\Collection;

final class ClassBuilder
{
    /**
     * CSS classes being collected.
     *
     * @var array<int, string>
     */
    private array $classes = [];

    /**
     * Add one or more CSS classes.
     */
    public function add(?string $class, bool $condition = true): self
    {
        if ($condition && filled($class)) {
            $this->classes[] = trim($class);
        }

        return $this;
    }

    /**
     * Add multiple CSS classes.
     *
     * @param array<int, string> $classes
     */
    public function addMany(array $classes): self
    {
        foreach ($classes as $class) {
            $this->add($class);
        }

        return $this;
    }

    /**
     * Build the final CSS class string.
     */
    public function build(): string
    {
        return collect($this->classes)
            ->flatMap(fn (string $class): array => preg_split('/\s+/', trim($class)) ?: [])
            ->filter()
            ->unique()
            ->implode(' ');
    }
}