<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\ToastVariant;
use App\Support\Ui\Styles\ToastStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    public function __construct(
        public ToastVariant $variant = ToastVariant::Info,
    ) {}

    public function style(): ToastStyle
    {
        return new ToastStyle();
    }

    public function render(): View
    {
        return view('components.ui.toast');
    }
}