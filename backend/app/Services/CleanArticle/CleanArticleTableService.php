<?php

declare(strict_types=1);

namespace App\Services\CleanArticle;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableState;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CleanArticleTableService
{
    /**
     * Build clean article table.
     */
    public function build(
        LengthAwarePaginator $rows,
    ): TableData {

        return TableData::make($rows)

            ->columns([

                TableColumn::make(
                    'articleTitle',
                    'Article',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'articleSource',
                    'Source',
                )
                    ->sortable()
                    ->searchable(),

                TableColumn::make(
                    'originalWordCount',
                    'Original Words',
                )
                    ->sortable(),

                TableColumn::make(
                    'cleanWordCount',
                    'Clean Words',
                )
                    ->sortable(),

                TableColumn::make(
                    'cleanerVersion',
                    'Cleaner Version',
                )
                    ->sortable(),

                TableColumn::make(
                    'cleanedAt',
                    'Cleaned At',
                )
                    ->sortable(),

            ])

            ->actions([

                TableAction::make(
                    'view',
                    'View',
                )
                    ->icon('eye')
                    ->route('clean-articles.show'),

            ])

            ->state(

                TableState::make()

            );
    }
}