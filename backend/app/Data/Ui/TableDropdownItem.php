<?php

namespace App\Data\Ui;

readonly class TableDropdownItem
{
    public function __construct(
        public string $label,
        public string $value,
        public ?string $icon = null,
    ) {}

    public static function make(
        string $label,
        string $value,
    ): self {
        return new self(
            label: $label,
            value: $value,
        );
    }

    public function icon(string $icon): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $icon,
        );
    }
}