<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\FeatureSnapshot\FeatureSnapshotAlreadyExistsException;
use App\Repositories\SentimentAnalysisRepository;
use App\Services\FeatureSnapshotService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class FeatureGeneratorService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly SentimentAnalysisRepository $repository,
        private readonly FeatureSnapshotService $featureSnapshotService,
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

        $sentiments = $this->repository
            ->findPendingFeatureGeneration();

        if ($sentiments->isEmpty()) {

            return new ProcessResult(
                processed: 0,
                created: 0,
                skipped: 0,
                failed: 0,
            );

        }

        $payload = $sentiments

            ->map(fn ($sentiment) => [

                'article_uuid' => $sentiment
                    ->cleanArticle
                    ->fullArticle
                    ->article
                    ->uuid,

                'published_at' => $sentiment
                    ->cleanArticle
                    ->fullArticle
                    ->article
                    ->published_at,

                'sentiment' => $sentiment->sentiment,

                'positive_score' => $sentiment->positive_score,

                'neutral_score' => $sentiment->neutral_score,

                'negative_score' => $sentiment->negative_score,

            ])

            ->values()

            ->all();

        $results = $this->python->run(
            config('python.scripts.feature'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->featureSnapshotService->create(
                    $result
                );

                $created++;

            } catch (
                FeatureSnapshotAlreadyExistsException $exception
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