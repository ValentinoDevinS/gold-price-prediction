<?php

namespace App\Data\Ui;

readonly class DropdownItem
{
    public function __construct(
        public string $label,
        public string $value,
        public ?string $icon = null,
        public bool $checked = false,
        public bool $disabled = false,
        public bool $danger = false,
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
            checked: $this->checked,
            disabled: $this->disabled,
            danger: $this->danger,
        );
    }

    public function checked(bool $checked = true): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $this->icon,
            checked: $checked,
            disabled: $this->disabled,
            danger: $this->danger,
        );
    }

    public function disabled(bool $disabled = true): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $this->icon,
            checked: $this->checked,
            disabled: $disabled,
            danger: $this->danger,
        );
    }

    public function danger(bool $danger = true): self
    {
        return new self(
            label: $this->label,
            value: $this->value,
            icon: $this->icon,
            checked: $this->checked,
            disabled: $this->disabled,
            danger: $danger,
        );
    }
}