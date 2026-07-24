<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\CardPadding;
use App\Enums\Ui\CardVariant;
use App\Support\Ui\Styles\CardStyle;
use App\View\Components\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Card extends BaseComponent
{
    /**
     * Card visual style.
     */
    public CardVariant $variant;

    /**
     * Card padding size.
     */
    public CardPadding $padding;

    public function __construct(
        string $variant = 'default',
        string $padding = 'md',
    ) {
        $this->variant = CardVariant::tryFrom($variant)
            ?? CardVariant::Default;

        $this->padding = CardPadding::tryFrom($padding)
            ?? CardPadding::Md;
    }

    /**
     * Build Tailwind classes.
     */
    public function classes(): string
    {
        return CardStyle::make(
            $this->variant,
        );
    }

    /**
     * Build body padding classes.
     */
    public function bodyClasses(): string
    {
        return match ($this->padding) {

            CardPadding::None => 'p-0',

            CardPadding::Sm => 'p-4',

            CardPadding::Md => 'p-6',

            CardPadding::Lg => 'p-8',
        };
    }

    /**
     * Render component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.card');
    }
}