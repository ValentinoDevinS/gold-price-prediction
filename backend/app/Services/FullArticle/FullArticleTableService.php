<?php

declare(strict_types=1);

namespace App\Services\FullArticle;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableState;
use Illuminate\Http\Request;

final readonly class FullArticleTableService
{
    public function __construct(
        private FullArticleQueryService $queryService,
    ) {
    }

    public function build(
        Request $request,
    ): TableData {

        return TableData::make(
            rows: $this->queryService->paginate(
                filters: $request->only([
                    'download_status',
                ]),
                search: $request->string('search')->toString(),
                sort: $request->string('sort')->toString(),
                direction: $request->string('direction')->toString(),
                perPage: (int) $request->input('per_page', 20),
            ),
        )
            ->columns($this->columns())
            ->actions($this->actions())
            ->state($this->state($request));

    }

    /**
     * @return array<int, TableColumn>
     */
    private function columns(): array
    {
        return [

            TableColumn::make(
                key: 'article.title',
                label: 'Title',
            )
                ->searchable()
                ->sortable(),

            TableColumn::make(
                key: 'author',
                label: 'Author',
            )
                ->searchable()
                ->sortable(),

            TableColumn::make(
                key: 'wordCount',
                label: 'Words',
            )
                ->sortable(),

            TableColumn::make(
                key: 'downloadStatus',
                label: 'Status',
            )
                ->sortable(),

            TableColumn::make(
                key: 'downloadedAt',
                label: 'Downloaded',
            )
                ->sortable(),

        ];

    }

    /**
     * @return array<int, TableAction>
     */
    private function actions(): array
    {
        return [

            TableAction::make(
                label: 'View',
            )
                ->icon('eye')
                ->route('full-articles.show'),

        ];

    }

    private function state(
        Request $request,
    ): TableState {

        return TableState::make(

            search: $request->string('search')->toString(),

            sortColumn: $request->string('sort')->toString(),

            sortDirection: $request->string('direction')->toString(),

            page: (int) $request->input('page', 1),

            perPage: (int) $request->input('per_page', 20),

            filters: $request->only([
                'download_status',
            ]),

        );

    }
}