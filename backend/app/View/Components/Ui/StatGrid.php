<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\StatGridStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class StatGrid extends Component
{
    public function __construct(
        public int $columns = 4,
    ) {
    }

    public function style(): StatGridStyle
    {
        return new StatGridStyle();
    }

    public function render(): View
    {
        return view('components.ui.stat-grid');
    }
}