<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\StatCardStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string|int $value,
        public ?string $description = null,
    ) {
    }

    public function style(): StatCardStyle
    {
        return new StatCardStyle();
    }

    public function render(): View
    {
        return view('components.ui.stat-card');
    }
}