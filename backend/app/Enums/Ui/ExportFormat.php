<?php

namespace App\Enums\Ui;

enum ExportFormat: string
{
    case Csv = 'csv';

    case Excel = 'excel';

    case Pdf = 'pdf';

    public function label(): string
    {
        return match ($this) {
            self::Csv => 'CSV',
            self::Excel => 'Excel',
            self::Pdf => 'PDF',
        };
    }
}