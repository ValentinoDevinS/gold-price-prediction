<?php

namespace App\Repositories;

use App\Models\ModelStatistic;
use Illuminate\Database\Eloquent\Collection;

class ModelStatisticRepository extends BaseRepository
{
    protected function model(): string
    {
        return ModelStatistic::class;
    }

    protected array $searchable = [

        'model_name',

    ];

    protected array $filterable = [

        'model_name',

    ];

    protected array $sortable = [

        'ranking_position',

        'mae',

        'rmse',

        'win_rate',

        'latest_prediction_date',

    ];

    /**
     * Find by model name.
     */
    public function findByModelName(
        string $modelName
    ): ?ModelStatistic {

        return $this->model
            ->where(
                'model_name',
                $modelName
            )
            ->first();

    }

    /**
     * Get statistics ordered by MAE.
     */
    public function getOrderedByMae(): Collection
    {
        return $this->model
            ->orderBy('mae')
            ->get();
    }

    /**
     * Ranking ordered by position.
     */
    public function getRanking()
    {
        return $this->model
            ->orderBy(
                'ranking_position'
            )
            ->get();
    }

    /**
     * Leaderboard ordered by ranking.
     */
    public function getLeaderboard(): Collection
    {
        return

            $this->model

                ->orderBy(
                    'ranking_position'
                )

                ->get();

    }

}