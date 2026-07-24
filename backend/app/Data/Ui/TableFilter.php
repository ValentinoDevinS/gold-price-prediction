<?php

namespace App\Data\Ui;

class TableFilter
{
    public function __construct(
        public readonly string $key,

        public readonly string $label,

        public readonly array $options = [],

        public readonly ?string $value = null,
    ) {
    }

    /**
     * Create a new filter.
     */
    public static function make(
        string $key,
        string $label,
    ): self {
        return new self(
            key: $key,
            label: $label,
        );
    }

    /**
     * Set filter options.
     */
    public function options(array $options): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            options: $options,
            value: $this->value,
        );
    }

    /**
     * Set selected value.
     */
    public function value(?string $value): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            options: $this->options,
            value: $value,
        );
    }
}