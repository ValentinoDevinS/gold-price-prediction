<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

use App\Support\Table\TableColumn;
use App\Support\Table\TableData;
use App\Support\Table\TableRow;

final readonly class PipelineTableService
{
    public function __construct(
        private PipelineQueryService $queryService,
    ) {
    }

    public function getTable(): TableData
    {
        $columns = [
            TableColumn::make('stage', 'Stage'),
            TableColumn::make('record_count', 'Records'),
            TableColumn::make('last_execution', 'Last Execution'),
            TableColumn::make('status', 'Status'),
        ];

        $rows = [];

        foreach ($this->queryService->allStages() as $stage) {

            $rows[] = TableRow::make([
                'stage' => $stage->stage,
                'record_count' => $stage->displayRecordCount(),
                'last_execution' => $stage->displayLastExecution(),
                'status' => $stage->displayStatus(),
            ]);

        }

        return TableData::make(
            columns: $columns,
            rows: $rows,
        );
    }
}