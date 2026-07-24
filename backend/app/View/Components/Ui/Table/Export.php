<?php

namespace App\View\Components\Ui\Table;

use App\Data\Ui\DropdownItem;
use App\Enums\Ui\ExportFormat;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Export extends Component
{
    /**
     * @param ExportFormat[] $formats
     */
    public function __construct(
        public array $formats = [
            ExportFormat::Csv,
            ExportFormat::Excel,
            ExportFormat::Pdf,
        ],
    ) {}

    /**
     * @return DropdownItem[]
     */
    public function items(): array
    {
        return array_map(
            fn (ExportFormat $format) => DropdownItem::make(
                label: $format->label(),
                value: $format->value,
            ),
            $this->formats,
        );
    }

    public function render(): View
    {
        return view('components.ui.table.export');
    }
}