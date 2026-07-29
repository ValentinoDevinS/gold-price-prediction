<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\Evaluation\EvaluationAlreadyExistsException;
use App\Repositories\PredictionResultRepository;
use App\Services\PredictionEvaluationService as EvaluationBusinessService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class EvaluationService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly PredictionResultRepository $repository,
        private readonly EvaluationBusinessService $evaluationService,
    ) {
    }

    public function run(): ProcessResult
    {
        $processed = 0;
        $created = 0;
        $skipped = 0;
        $failed = 0;

        $warnings = [];
        $errors = [];

        $predictions = $this->repository
            ->findPendingEvaluation();

        if ($predictions->isEmpty()) {

            return new ProcessResult(
                processed: 0,
                created: 0,
                skipped: 0,
                failed: 0,
            );

        }

        $payload = $predictions

            ->map(fn ($prediction) => [

                'prediction_uuid' => $prediction->uuid,

                'model' => $prediction->model,

                'predicted_price' => $prediction->predicted_price,

                'actual_price' => $prediction->featureSnapshot->gold_close,

            ])

            ->values()

            ->all();

        $results = $this->python->run(
            config('python.scripts.evaluation'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->evaluationService
                    ->create($result);

                $created++;

            } catch (
                EvaluationAlreadyExistsException $exception
            ) {

                $skipped++;

                $warnings[] = $exception->getMessage();

            } catch (Throwable $exception) {

                $failed++;

                $errors[] = $exception->getMessage();

            }

        }

        return new ProcessResult(
            processed: $processed,
            created: $created,
            skipped: $skipped,
            failed: $failed,
            warnings: $warnings,
            errors: $errors,
        );
    }
}