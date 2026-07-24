<?php

namespace App\Data\Ui;

readonly class BreadcrumbItem
{
    public function __construct(
        public string $label,
        public ?string $url = null,
    ) {}

    public static function make(
        string $label,
        ?string $url = null,
    ): self {
        return new self(
            label: $label,
            url: $url,
        );
    }

    public function url(?string $url): self
    {
        return new self(
            label: $this->label,
            url: $url,
        );
    }

    public function isCurrent(): bool
    {
        return $this->url === null;
    }
}