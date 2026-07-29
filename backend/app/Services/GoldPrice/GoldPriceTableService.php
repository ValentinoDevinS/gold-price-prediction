<?php

declare(strict_types=1);

namespace App\Services\GoldPrice;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableFilter;
use App\Data\Ui\TableState;
use App\Enums\Ui\TableAlignment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class GoldPriceTableService
{
    public function build(
        LengthAwarePaginator $rows,
    ): TableData {

        return TableData::make($rows)
            ->columns($this->columns())
            ->filters($this->filters())
            ->actions($this->actions())
            ->state($this->state());

    }

    /**
     * @return TableColumn[]
     */
    private function columns(): array
    {
        return [

            TableColumn::make(
                key: 'priceDate',
                label: 'Date',
            )
                ->sortable(),

            TableColumn::make(
                key: 'openPrice',
                label: 'Open',
            )
                ->sortable()
                ->alignment(TableAlignment::Right),

            TableColumn::make(
                key: 'highPrice',
                label: 'High',
            )
                ->sortable()
                ->alignment(TableAlignment::Right),

            TableColumn::make(
                key: 'lowPrice',
                label: 'Low',
            )
                ->sortable()
                ->alignment(TableAlignment::Right),

            TableColumn::make(
                key: 'closePrice',
                label: 'Close',
            )
                ->sortable()
                ->alignment(TableAlignment::Right),

            TableColumn::make(
                key: 'volume',
                label: 'Volume',
            )
                ->sortable()
                ->alignment(TableAlignment::Right),

        ];
    }

    /**
     * @return TableFilter[]
     */
    private function filters(): array
    {
        return [

            TableFilter::make(
                key: 'priceDate',
                label: 'Trading Date',
            ),

        ];
    }

    /**
     * @return TableAction[]
     */
    private function actions(): array
    {
        return [

            TableAction::make(
                key: 'view',
                label: 'View',
            )
                ->icon('eye')
                ->route('gold-price.show'),

        ];
    }

    private function state(): TableState
    {
        return new TableState(
            sortColumn: 'priceDate',
            sortDirection: 'desc',
            perPage: 25,
        );
    }
}