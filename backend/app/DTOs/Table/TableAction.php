<?php

declare(strict_types=1);

namespace App\DTOs\Table;

final class TableAction
{
    private function __construct(
        public readonly string $name,
        public readonly string $label = '',
        public readonly ?string $icon = null,
        public readonly ?string $route = null,
        public readonly array $parameters = [],
        public readonly string $color = 'primary',
        public readonly bool $visible = true,
        public readonly bool $requiresConfirmation = false,
        public readonly ?string $confirmationTitle = null,
        public readonly ?string $confirmationMessage = null,
    ) {
    }

    public static function make(string $name): self
    {
        return new self(name: $name);
    }

    public function label(string $label): self
    {
        return new self(
            name: $this->name,
            label: $label,
            icon: $this->icon,
            route: $this->route,
            parameters: $this->parameters,
            color: $this->color,
            visible: $this->visible,
            requiresConfirmation: $this->requiresConfirmation,
            confirmationTitle: $this->confirmationTitle,
            confirmationMessage: $this->confirmationMessage,
        );
    }

    public function icon(string $icon): self
    {
        return new self(
            name: $this->name,
            label: $this->label,
            icon: $icon,
            route: $this->route,
            parameters: $this->parameters,
            color: $this->color,
            visible: $this->visible,
            requiresConfirmation: $this->requiresConfirmation,
            confirmationTitle: $this->confirmationTitle,
            confirmationMessage: $this->confirmationMessage,
        );
    }

    public function route(string $route, array $parameters = []): self
    {
        return new self(
            name: $this->name,
            label: $this->label,
            icon: $this->icon,
            route: $route,
            parameters: $parameters,
            color: $this->color,
            visible: $this->visible,
            requiresConfirmation: $this->requiresConfirmation,
            confirmationTitle: $this->confirmationTitle,
            confirmationMessage: $this->confirmationMessage,
        );
    }

    public function color(string $color): self
    {
        return new self(
            name: $this->name,
            label: $this->label,
            icon: $this->icon,
            route: $this->route,
            parameters: $this->parameters,
            color: $color,
            visible: $this->visible,
            requiresConfirmation: $this->requiresConfirmation,
            confirmationTitle: $this->confirmationTitle,
            confirmationMessage: $this->confirmationMessage,
        );
    }

    public function hidden(): self
    {
        return new self(
            name: $this->name,
            label: $this->label,
            icon: $this->icon,
            route: $this->route,
            parameters: $this->parameters,
            color: $this->color,
            visible: false,
            requiresConfirmation: $this->requiresConfirmation,
            confirmationTitle: $this->confirmationTitle,
            confirmationMessage: $this->confirmationMessage,
        );
    }

    public function confirm(
        string $title = 'Are you sure?',
        string $message = 'This action cannot be undone.',
    ): self {
        return new self(
            name: $this->name,
            label: $this->label,
            icon: $this->icon,
            route: $this->route,
            parameters: $this->parameters,
            color: $this->color,
            visible: $this->visible,
            requiresConfirmation: true,
            confirmationTitle: $title,
            confirmationMessage: $message,
        );
    }
}