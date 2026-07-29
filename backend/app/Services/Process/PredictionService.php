<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\PredictionResult\PredictionResultAlreadyExistsException;
use App\Repositories\FeatureSnapshotRepository;
use App\Services\PredictionResultService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class PredictionService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly FeatureSnapshotRepository $repository,
        private readonly PredictionResultService $predictionResultService,
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

        $features = $this->repository
            ->findPendingPrediction();

        if ($features->isEmpty()) {

            return new ProcessResult(
                processed: 0,
                created: 0,
                skipped: 0,
                failed: 0,
            );

        }

        $payload = $features

            ->map(fn ($feature) => [

                'article_uuid' => $feature->article_uuid,

                'feature_vector' => [
                    'sentiment_score' => $feature->sentiment_score,
                    'rolling_sentiment_3d' => $feature->rolling_sentiment_3d,
                    'rolling_sentiment_7d' => $feature->rolling_sentiment_7d,
                    'gold_close' => $feature->gold_close,
                    'gold_return' => $feature->gold_return,
                    'sma_5' => $feature->sma_5,
                    'ema_10' => $feature->ema_10,
                    'rsi_14' => $feature->rsi_14,
                    'macd' => $feature->macd,
                    'signal' => $feature->signal,
                ],

            ])

            ->values()

            ->all();

        $results = $this->python->run(
            config('python.scripts.prediction'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->predictionResultService
                    ->create($result);

                $created++;

            } catch (
                PredictionResultAlreadyExistsException $exception
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