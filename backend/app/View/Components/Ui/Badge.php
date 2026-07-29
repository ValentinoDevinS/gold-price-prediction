<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Enums\Ui\BadgeVariant;
use App\Support\Ui\Styles\BadgeStyle;
use Illuminate\View\Component;
use Illuminate\View\View;

final class Badge extends Component
{
    /**
     * Badge visual style.
     */
    public function __construct(
        public BadgeVariant|string $variant = BadgeVariant::Primary,
    ) {
        if (is_string($this->variant)) {
            $this->variant = BadgeVariant::tryFrom($this->variant)
                ?? BadgeVariant::Primary;
        }
    }

    /**
     * Style object.
     */
    public function style(): BadgeStyle
    {
        return new BadgeStyle($this->variant);
    }

    public function render(): View
    {
        return view('components.ui.badge');
    }
}