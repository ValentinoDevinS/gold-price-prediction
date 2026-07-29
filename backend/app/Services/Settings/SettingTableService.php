<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableState;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class SettingTableService
{
    /**
     * Build settings table.
     */
    public function build(
        LengthAwarePaginator $rows,
    ): TableData {

        return TableData::make($rows)

            ->columns([

                TableColumn::make(
                    'category',
                    'Category',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'label',
                    'Setting',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'value',
                    'Value',
                )
                    ->sortable(),

                TableColumn::make(
                    'type',
                    'Type',
                )
                    ->sortable(),

                TableColumn::make(
                    'isEditable',
                    'Editable',
                )
                    ->sortable(),

            ])

            ->actions([

                TableAction::make(
                    'edit',
                    'Edit',
                )
                    ->icon('pencil')
                    ->route('settings.edit'),

            ])

            ->state(

                TableState::make()

            );
    }
}