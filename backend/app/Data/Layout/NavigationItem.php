<?php

namespace App\Data\Layout;

readonly class NavigationItem
{
    public function __construct(
        public string $label,
        public string $route,
        public ?string $icon = null,
    ) {}

    public static function make(
        string $label,
        string $route,
    ): self {
        return new self(
            label: $label,
            route: $route,
        );
    }

    public function icon(string $icon): self
    {
        return new self(
            label: $this->label,
            route: $this->route,
            icon: $icon,
        );
    }
}