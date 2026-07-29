<?php

declare(strict_types=1);

namespace App\Services\Article;

use App\Data\Ui\TableAction;
use App\Data\Ui\TableColumn;
use App\Data\Ui\TableData;
use App\Data\Ui\TableState;
use App\Http\Requests\Article\ArticleIndexRequest;

final readonly class ArticleTableService
{
    public function __construct(
        private ArticleQueryService $queryService,
    ) {
    }

    /**
     * Build article table.
     */
    public function build(
        ArticleIndexRequest $request,
    ): TableData {

        $rows = $this->queryService->paginate($request);

        return TableData::make($rows)

            ->columns($this->columns())

            ->actions($this->actions())

            ->bulkActions($this->bulkActions())

            ->exportFormats([
                'csv',
                'xlsx',
            ])

            ->state($this->state($request));
    }

    /**
     * Table columns.
     *
     * @return TableColumn[]
     */
    private function columns(): array
    {
        return [

            TableColumn::make(
                'title',
                'Title',
            )
                ->sortable()
                ->searchable(),

            TableColumn::make(
                'source',
                'Source',
            )
                ->sortable()
                ->searchable(),

            TableColumn::make(
                'language',
                'Language',
            )
                ->sortable(),

            TableColumn::make(
                'country',
                'Country',
            )
                ->sortable(),

            TableColumn::make(
                'status',
                'Status',
            )
                ->sortable(),

            TableColumn::make(
                'published_at',
                'Published',
            )
                ->sortable(),

            TableColumn::make(
                'scraped_at',
                'Scraped',
            )
                ->sortable(),

        ];
    }

    /**
     * Row actions.
     *
     * @return TableAction[]
     */
    private function actions(): array
    {
        return [

            TableAction::make(
                'view',
                'View',
            )
                ->icon('eye')
                ->route('articles.show'),

        ];
    }

    /**
     * Bulk actions.
     *
     * @return TableAction[]
     */
    private function bulkActions(): array
    {
        return [

            TableAction::make(
                'export',
                'Export Selected',
            )
                ->bulk(),

        ];
    }

    /**
     * Current table state.
     */
    private function state(
        ArticleIndexRequest $request,
    ): TableState {

        return new TableState(

            search: (string) $request->input(
                'search',
                '',
            ),

            sortColumn: $request->input(
                'sort',
            ),

            sortDirection: (string) $request->input(
                'direction',
                'desc',
            ),

            page: (int) $request->input(
                'page',
                1,
            ),

            perPage: (int) $request->input(
                'per_page',
                20,
            ),

            filters: [

                'status' => $request->input('status'),

                'source' => $request->input('source'),

                'language' => $request->input('language'),

                'country' => $request->input('country'),

                'scraper' => $request->input('scraper'),

            ],

        );
    }
}