<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\StatCardStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string $value,
    ) {}

    public function style(): StatCardStyle
    {
        return new StatCardStyle();
    }

    public function render(): View
    {
        return view('components.ui.stat-card');
    }
}