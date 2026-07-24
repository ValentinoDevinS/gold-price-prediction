<?php

namespace App\Data\Layout;

readonly class NavigationGroup
{
    /**
     * @param NavigationItem[] $items
     */
    public function __construct(
        public string $title,
        public array $items,
    ) {}

    /**
     * @param NavigationItem[] $items
     */
    public static function make(
        string $title,
        array $items,
    ): self {
        return new self(
            title: $title,
            items: $items,
        );
    }
}