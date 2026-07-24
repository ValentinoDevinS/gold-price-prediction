<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\BadgeVariant;
use App\Support\Ui\Styles\BadgeStyle;
use App\View\Components\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Badge extends BaseComponent
{
    /**
     * Badge visual style.
     */
    public BadgeVariant $variant;

    public function __construct(
        string $variant = 'primary',
    ) {
        $this->variant = BadgeVariant::tryFrom($variant)
            ?? BadgeVariant::Primary;
    }

    /**
     * Build Tailwind classes.
     */
    public function classes(): string
    {
        return BadgeStyle::make(
            $this->variant,
        );
    }

    /**
     * Render component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.badge');
    }
}