<?php

namespace App\Data\Ui;

readonly class BulkAction
{
    public function __construct(
        public string $label,
        public string $value,
        public ?string $icon = null,
        public bool $danger = false,
        public bool $disabled = false,
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
            danger: $this->danger,
            disabled: $this->disabled,
        );
    }

    public function danger(bool $danger = true): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $this->icon,
            danger: $danger,
            disabled: $this->disabled,
        );
    }

    public function disabled(bool $disabled = true): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $this->icon,
            danger: $this->danger,
            disabled: $disabled,
        );
    }
}