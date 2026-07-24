<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\AlertVariant;
use App\Support\Ui\Styles\AlertStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public AlertVariant $variant = AlertVariant::Info,
    ) {}

    public function style(): AlertStyle
    {
        return new AlertStyle();
    }

    public function render(): View
    {
        return view('components.ui.alert');
    }
}