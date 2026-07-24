<?php

namespace App\Data\Ui;

class TableAction
{
    public function __construct(
        public readonly string $key,

        public readonly string $label,

        public readonly ?string $icon = null,

        public readonly ?string $route = null,

        public readonly bool $bulk = false,

        public readonly bool $confirm = false,

        public readonly ?string $confirmTitle = null,

        public readonly ?string $confirmMessage = null,
    ) {
    }

    /**
     * Create a new action.
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

    public function icon(string $icon): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            icon: $icon,
            route: $this->route,
            bulk: $this->bulk,
            confirm: $this->confirm,
            confirmTitle: $this->confirmTitle,
            confirmMessage: $this->confirmMessage,
        );
    }

    public function route(string $route): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            icon: $this->icon,
            route: $route,
            bulk: $this->bulk,
            confirm: $this->confirm,
            confirmTitle: $this->confirmTitle,
            confirmMessage: $this->confirmMessage,
        );
    }

    public function bulk(): self
    {
        return new self(
            key: $this->key,
            label: $this->label,
            icon: $this->icon,
            route: $this->route,
            bulk: true,
            confirm: $this->confirm,
            confirmTitle: $this->confirmTitle,
            confirmMessage: $this->confirmMessage,
        );
    }

    public function confirm(
        string $title = 'Confirmation',
        string $message = 'Are you sure?'
    ): self {
        return new self(
            key: $this->key,
            label: $this->label,
            icon: $this->icon,
            route: $this->route,
            bulk: $this->bulk,
            confirm: true,
            confirmTitle: $title,
            confirmMessage: $message,
        );
    }
}