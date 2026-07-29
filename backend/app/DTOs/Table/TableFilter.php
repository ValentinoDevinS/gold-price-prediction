<?php

declare(strict_types=1);

namespace App\DTOs\Table;

final class TableFilter
{
    private function __construct(
        public readonly string $key,
        public readonly string $label = '',
        public readonly string $type = 'text',
        public readonly array $options = [],
        public readonly mixed $default = null,
        public readonly bool $multiple = false,
        public readonly bool $visible = true,
        public readonly ?string $placeholder = null,
    ) {
    }

    public static function make(string $key): self
    {
        return new self(key: $key);
    }

    public function label(string $label): self
    {
        return new self(
            key: $this->key,
            label: $label,
            type: $this->type,
            options: $this->options,
            default: $this->default,
            multiple: $this->multiple,
            visible: $this->visible,
            placeholder: $this->placeholder,
        );
    }

    public function type(string $type): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $type,
            options: $this->options,
            default: $this->default,
            multiple: $this->multiple,
            visible: $this->visible,
            placeholder: $this->placeholder,
        );
    }

    public function options(array $options): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $this->type,
            options: $options,
            default: $this->default,
            multiple: $this->multiple,
            visible: $this->visible,
            placeholder: $this->placeholder,
        );
    }

    public function default(mixed $value): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $this->type,
            options: $this->options,
            default: $value,
            multiple: $this->multiple,
            visible: $this->visible,
            placeholder: $this->placeholder,
        );
    }

    public function multiple(bool $multiple = true): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $this->type,
            options: $this->options,
            default: $this->default,
            multiple: $multiple,
            visible: $this->visible,
            placeholder: $this->placeholder,
        );
    }

    public function placeholder(string $placeholder): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $this->type,
            options: $this->options,
            default: $this->default,
            multiple: $this->multiple,
            visible: $this->visible,
            placeholder: $placeholder,
        );
    }

    public function hidden(): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            type: $this->type,
            options: $this->options,
            default: $this->default,
            multiple: $this->multiple,
            visible: false,
            placeholder: $this->placeholder,
        );
    }

    public function text(): self
    {
        return $this->type('text');
    }

    public function date(): self
    {
        return $this->type('date');
    }

    public function select(): self
    {
        return $this->type('select');
    }

    public function checkbox(): self
    {
        return $this->type('checkbox');
    }
}