<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\ModalStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $title = '',
    ) {}

    public function style(): ModalStyle
    {
        return new ModalStyle();
    }

    public function render(): View
    {
        return view('components.ui.modal');
    }
}