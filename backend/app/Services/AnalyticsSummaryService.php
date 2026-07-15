<?php

namespace App\Services;

use App\Repositories\HistoricalAnalyticsRepository;
use Illuminate\Support\Collection;

class AnalyticsSummaryService
{
    public function __construct(
        private readonly HistoricalAnalyticsRepository $repository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Overview
    |--------------------------------------------------------------------------
    */

    /**
     * Dashboard overview.
     */
    public function getOverview(): array
    {
        return [

            'best_model'

                =>

                $this->getCurrentLeaderCard(),

            'predictions'

                =>

                $this->getPredictionCard(),

            'snapshots'

                =>

                $this->getSnapshotCard(),

            'leaderboard'

                =>

                $this->getLeaderboardCard(),

            'generated_at'

                =>

                now(),

        ];

    }

    /**
     * Current leader.
     */
    public function getCurrentLeaderCard(): array
    {
        $leader =

            $this->repository
                ->getCurrentLeader();

        if (

            ! $leader

        ) {

            return [

                'title'

                    =>

                    'Best Model',

                'value'

                    =>

                    '-',

                'subtitle'

                    =>

                    'No Data',

                'badge'

                    =>

                    '⚪',

                'status'

                    =>

                    'unknown',

                'description'

                    =>

                    'No statistics available.',

                'help'

                    =>

                    $this->helpBestModel(),

                'generated_at'

                    =>

                    now(),

            ];

        }

        return [

            'title'

                =>

                'Best Model',

            'value'

                =>

                $leader->model_name,

            'subtitle'

                =>

                'Current Leader',

            'badge'

                =>

                '🥇 Rank #1',

            'status'

                =>

                'excellent',

            'description'

                =>

                'Lowest MAE among all active models.',

            'help'

                =>

                $this->helpBestModel(),

            'generated_at'

                =>

                now(),

        ];

    }

    /**
     * Total prediction card.
     */
    public function getPredictionCard(): array
    {
        return [

            'title'

                =>

                'Predictions',

            'value'

                =>

                number_format(

                    $this->repository
                        ->getTotalPredictions()

                ),

            'subtitle'

                =>

                'Evaluated Predictions',

            'badge'

                =>

                '📈',

            'status'

                =>

                'normal',

            'description'

                =>

                'Total predictions successfully evaluated.',

            'help'

                =>

                $this->helpPredictions(),

            'generated_at'

                =>

                now(),

        ];

    }

        /**
     * Snapshot card.
     */
    public function getSnapshotCard(): array
    {
        return [

            'title'

                =>

                'Snapshots',

            'value'

                =>

                number_format(

                    $this->repository
                        ->getTotalSnapshots()

                ),

            'subtitle'

                =>

                'Historical Leaderboards',

            'badge'

                =>

                '📸',

            'status'

                =>

                'normal',

            'description'

                =>

                'Historical leaderboard snapshots recorded by the system.',

            'help'

                =>

                $this->helpSnapshots(),

            'generated_at'

                =>

                now(),

        ];

    }

    /**
     * Leaderboard card.
     */
    public function getLeaderboardCard(): array
    {
        $leaderboard =

            $this->repository
                ->getLeaderboard();

        return [

            'title'

                =>

                'Leaderboard',

            'value'

                =>

                $leaderboard->count(),

            'subtitle'

                =>

                'Active Models',

            'badge'

                =>

                '🏆',

            'status'

                =>

                'excellent',

            'description'

                =>

                'Models currently participating in prediction ranking.',

            'help'

                =>

                $this->helpLeaderboard(),

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Help
    |--------------------------------------------------------------------------
    */

    private function helpBestModel(): array
    {
        return [

            'definition'

                =>

                'The model currently ranked first based on historical evaluation.',

            'formula'

                =>

                'Lowest MAE, then ranking position.',

            'interpretation'

                =>

                'This model currently provides the best prediction performance.',

            'importance'

                =>

                'Used as the primary recommendation for prediction.',

        ];
    }

    private function helpPredictions(): array
    {
        return [

            'definition'

                =>

                'Total prediction results evaluated using actual gold prices.',

            'formula'

                =>

                'COUNT(prediction_evaluations)',

            'interpretation'

                =>

                'Higher values indicate more evaluation history.',

            'importance'

                =>

                'A larger evaluation dataset generally increases confidence in model statistics.',

        ];
    }

    private function helpSnapshots(): array
    {
        return [

            'definition'

                =>

                'Historical rankings recorded after each statistics update.',

            'formula'

                =>

                'COUNT(DISTINCT snapshot_uuid)',

            'interpretation'

                =>

                'Represents how many historical leaderboard states have been preserved.',

            'importance'

                =>

                'Used for historical analytics, ranking trends, and model dominance.',

        ];
    }

    private function helpLeaderboard(): array
    {
        return [

            'definition'

                =>

                'Models currently available for comparison.',

            'formula'

                =>

                'COUNT(model_statistics)',

            'interpretation'

                =>

                'Displays all active prediction models.',

            'importance'

                =>

                'Allows users to compare model performance.',

        ];
    }
}