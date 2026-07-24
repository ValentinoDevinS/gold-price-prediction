<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Enums\Ui\ButtonSize;
use App\Enums\Ui\ButtonVariant;
use App\Support\Ui\Styles\ButtonStyle;
use App\View\Components\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Button extends BaseComponent
{
    public ButtonVariant $variant;

    public ButtonSize $size;

    public function __construct(
        string $variant = '',
        string $size = '',
        public string $type = 'button',
        public bool $loading = false,
        public ?string $loadingText = null,
        public bool $disabled = false,
        
    ) {

        $allowedTypes = [
            'button',
            'submit',
            'reset',
        ];

        $this->type = in_array($type, $allowedTypes, true)
            ? $type
            : 'button';
            
        $defaultVariant = config('ui.button.default_variant');

        $this->variant = ButtonVariant::tryFrom(
            $variant ?: $defaultVariant
        ) ?? ButtonVariant::defaultVariant();

        $defaultSize = config('ui.button.default_size');

        $this->size = ButtonSize::tryFrom(
            $size ?: $defaultSize
        ) ?? ButtonSize::defaultSize();
    }

    /**
     * Return the complete CSS class string.
     */
    public function classes(): string
    {
        return ButtonStyle::make(
            variant: $this->variant,
            size: $this->size,
        );
    }

    /**
     * Return whether the button should be disabled.
     */
    public function isDisabled(): bool
    {
        return $this->disabled || $this->loading;
    }

    /**
     * Return the loading text.
     */
    public function loadingLabel(): string
    {
        return $this->loadingText
            ?: config('ui.button.default_loading_text');
    }

    /**
     * Render the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.button');
    }
}