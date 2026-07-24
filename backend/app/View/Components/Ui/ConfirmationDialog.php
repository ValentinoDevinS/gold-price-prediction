<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\ConfirmationVariant;
use App\Support\Ui\Styles\ConfirmationDialogStyle;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationDialog extends Component
{
    public function __construct(
        public string $title,

        public string $message,

        public ConfirmationVariant $variant = ConfirmationVariant::Default,
    ) {}

    public function style(): ConfirmationDialogStyle
    {
        return new ConfirmationDialogStyle();
    }

    public function render(): View
    {
        return view('components.ui.confirmation-dialog');
    }
}