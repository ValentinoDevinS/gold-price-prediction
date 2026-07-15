<?php

namespace App\Services;

use App\Models\EnsembleResult;
use App\Models\FeatureSnapshot;
use App\Models\PredictionResult;
use App\Repositories\EnsembleResultRepository;
use App\Repositories\FeatureSnapshotRepository;
use App\Repositories\PredictionResultRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use RuntimeException;
use InvalidArgumentException;
use LogicException;

class EnsembleResultService extends BaseService
{
    public function __construct(
        private readonly EnsembleResultRepository $repository,
        private readonly FeatureSnapshotRepository $featureSnapshotRepository,
        private readonly PredictionResultRepository $predictionRepository,
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public function generateFromFeatureSnapshot(
        string $featureSnapshotUuid,
        string $method = EnsembleResult::METHOD_AVERAGE
    ): EnsembleResult {

        return $this->execute(function () use (
            $featureSnapshotUuid,
            $method
        ) {

            $featureSnapshot =

                $this->loadFeatureSnapshot(
                    $featureSnapshotUuid
                );

            $predictions =

                $this->loadPredictions(
                    $featureSnapshot->id
                );

            $this->validatePredictions(
                $predictions
            );

            $ensemble =

                $this->calculateEnsemble(
                    $predictions,
                    $method
                );

            return $this->storeResult(
                $featureSnapshot,
                $ensemble,
                $method
            );

        });

    }

    public function delete(
        string $uuid
    ): bool {

        return $this->execute(function () use ($uuid) {

            $ensemble =

                $this->repository
                    ->findOrFailByUuid(
                        $uuid
                    );

            return $this->repository
                ->delete(
                    $ensemble
                );

        });

    }

    public function findByUuid(
        string $uuid
    ): EnsembleResult {

        return

            $this->repository
                ->findOrFailByUuid(
                    $uuid
                );

    }

    public function getPaginated(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        ?string $direction = null,
        int $perPage = 20
    ): LengthAwarePaginator {

        return

            $this->repository
                ->getPaginated(
                    filters: $filters,
                    search: $search,
                    sort: $sort,
                    direction: $direction,
                    perPage: $perPage
                );

    }

    /*
    |--------------------------------------------------------------------------
    | Internal AI Pipeline
    |--------------------------------------------------------------------------
    */

    private function loadFeatureSnapshot(
        string $uuid
    ): FeatureSnapshot {

        return

            $this->featureSnapshotRepository
                ->findOrFailByUuid(
                    $uuid
                );

    }

    private function loadPredictions(
        int $featureSnapshotId
    ): Collection {

        return

            $this->predictionRepository
                ->getByFeatureSnapshotId(
                    $featureSnapshotId
                );

    }

    private function validatePredictions(
        Collection $predictions
    ): void {

        $requiredModels =

            PredictionResult::requiredModels();

        if (

            $predictions->count()

            !==

            count($requiredModels)

        ) {

            throw new RuntimeException(

                sprintf(
                    'Exactly %d prediction results are required.',
                    count($requiredModels)
                )

            );

        }

        foreach ($requiredModels as $model) {

            $count =

                $predictions
                    ->where(
                        'model_name',
                        $model
                    )
                    ->count();

            if ($count !== 1) {

                throw new RuntimeException(

                    sprintf(
                        'Exactly one %s prediction is required.',
                        $model
                    )

                );

            }

        }

    }

    private function calculateEnsemble(
        Collection $predictions,
        string $method
    ): Collection {

        return match ($method) {

            EnsembleResult::METHOD_AVERAGE =>

                $this->calculateAverage(
                    $predictions
                ),

            EnsembleResult::METHOD_WEIGHTED =>

                $this->calculateWeightedAverage(
                    $predictions
                ),

            EnsembleResult::METHOD_MEDIAN =>

                $this->calculateMedian(
                    $predictions
                ),

            EnsembleResult::METHOD_STACKING =>

                $this->calculateStacking(
                    $predictions
                ),

            default =>

                throw new InvalidArgumentException(
                    'Unsupported ensemble method.'
                ),

        };

    }

    /*
    |--------------------------------------------------------------------------
    | Ensemble Algorithms
    |--------------------------------------------------------------------------
    */

    private function calculateAverage(
        Collection $predictions
    ): Collection {

        $predictedPrice =

            $predictions
                ->avg(
                    'predicted_price'
                );

        return collect([

            'predicted_price' => round(
                $predictedPrice,
                2
            ),

            'confidence_score' =>

                $this->calculateConfidence(
                    $predictions
                ),

        ]);

    }

    private function calculateWeightedAverage(
        Collection $predictions
    ): Collection {

        throw new LogicException(
            'Weighted Average is not implemented.'
        );

    }

    private function calculateMedian(
        Collection $predictions
    ): Collection {

        throw new LogicException(
            'Median Ensemble is not implemented.'
        );

    }

    private function calculateStacking(
        Collection $predictions
    ): Collection {

        throw new LogicException(
            'Stacking Ensemble is not implemented.'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Confidence
    |--------------------------------------------------------------------------
    */

    private function calculateConfidence(
        Collection $predictions
    ): float {

        return round(

            $predictions
                ->avg(
                    'confidence_score'
                ),

            6

        );

    }

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    */

    private function storeResult(
        FeatureSnapshot $featureSnapshot,
        Collection $ensemble,
        string $method
    ): EnsembleResult {

        $existing =

            $this->repository
                ->findByFeatureSnapshotId(
                    $featureSnapshot->id
                );

        $data = [

            'feature_snapshot_id'

                =>

                $featureSnapshot->id,

            'ensemble_method'

                =>

                $method,

            'model_version'

                =>

                EnsembleResult::VERSION_LATEST,

            'predicted_price'

                =>

                $ensemble->get(
                    'predicted_price'
                ),

            'confidence_score'

                =>

                $ensemble->get(
                    'confidence_score'
                ),

            'prediction_date'

                =>

                today(),

            'predicted_at'

                =>

                now(),

        ];

        if ($existing) {

            $this->repository
                ->update(
                    $existing,
                    $data
                );

            return $existing->fresh();

        }

        return

            $this->repository
                ->create(
                    $data
                );

    }

}