<?php

declare(strict_types=1);

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
     * Style object.
     */
    public function style(): CardStyle
    {
        return new CardStyle();
    }

    /**
     * Body padding classes.
     */
    public function bodyPadding(): string
    {
        return match ($this->padding) {
            CardPadding::None => 'p-0',
            CardPadding::Sm => 'p-4',
            CardPadding::Md => 'p-6',
            CardPadding::Lg => 'p-8',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.card');
    }
}