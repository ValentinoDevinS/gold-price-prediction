<?php

declare(strict_types=1);

namespace App\Services\Training;

use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableState;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class TrainingTableService
{
    /**
     * Build training model table.
     */
    public function build(
        LengthAwarePaginator $rows,
    ): TableData {

        return TableData::make($rows)

            ->columns([

                TableColumn::make(
                    'modelName',
                    'Model',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'modelVersion',
                    'Version',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'modelType',
                    'Type',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'status',
                    'Status',
                )
                    ->sortable(),

                TableColumn::make(
                    'datasetSize',
                    'Dataset Size',
                )
                    ->sortable(),

                TableColumn::make(
                    'trainingTime',
                    'Training Time (s)',
                )
                    ->sortable(),

                TableColumn::make(
                    'trainedUntil',
                    'Trained Until',
                )
                    ->sortable(),

            ])

            ->state(

                TableState::make()

            );
    }
}