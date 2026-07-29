<?php

declare(strict_types=1);

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class StatisticCard extends Component
{
    public function __construct(
        public readonly string $label,
        public readonly string|int|float $value,
        public readonly ?string $description = null,
        public readonly ?string $icon = null,
    ) {
    }

    public function style(): StatisticCardStyle
    {
        return new StatisticCardStyle();
    }

    public function render(): View|Closure|string
    {
        return view('components.page.statistic-card');
    }
}