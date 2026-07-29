<?php

declare(strict_types=1);

namespace App\Services\SentimentAnalysis;

use App\Data\Table\TableAction;
use App\Data\Table\TableColumn;
use App\Data\Table\TableData;
use App\Data\Table\TableState;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class SentimentAnalysisTableService
{
    /**
     * Build sentiment analysis table.
     */
    public function build(
        LengthAwarePaginator $rows,
    ): TableData {

        return TableData::make(

            columns: [

                TableColumn::make(
                    key: 'articleTitle',
                    label: 'Article',
                ),

                TableColumn::make(
                    key: 'label',
                    label: 'Sentiment',
                ),

                TableColumn::make(
                    key: 'confidence',
                    label: 'Confidence',
                ),

                TableColumn::make(
                    key: 'modelName',
                    label: 'Model',
                ),

                TableColumn::make(
                    key: 'modelVersion',
                    label: 'Version',
                ),

                TableColumn::make(
                    key: 'analyzedAt',
                    label: 'Analyzed At',
                ),

            ],

            rows: $rows,

            actions: [

                TableAction::make(
                    label: 'View',
                    route: 'sentiment.index',
                    routeParameter: 'uuid',
                ),

            ],

            emptyState: TableState::make(

                title: 'No sentiment analyses found',

                description: 'Run the sentiment analysis pipeline to generate results.',

            ),

        );
    }
}