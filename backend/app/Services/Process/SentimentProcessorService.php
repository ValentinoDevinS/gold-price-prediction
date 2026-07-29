<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\SentimentAnalysis\SentimentAnalysisAlreadyExistsException;
use App\Repositories\CleanArticleRepository;
use App\Services\Process\DTO\ProcessResult;
use App\Services\SentimentAnalysisService;
use Throwable;

final class SentimentProcessorService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly CleanArticleRepository $repository,
        private readonly SentimentAnalysisService $sentimentAnalysisService,
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

        $articles = $this->repository
            ->findPendingSentiment();

        if ($articles->isEmpty()) {

            return new ProcessResult(
                processed: 0,
                created: 0,
                skipped: 0,
                failed: 0,
            );

        }

        $payload = $articles

            ->map(fn ($article) => [

                'article_uuid' => $article->article_uuid,

                'text' => $article->clean_text,

            ])

            ->values()

            ->all();

        $results = $this->python->run(
            config('python.scripts.sentiment'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->sentimentAnalysisService->create(
                    $result
                );

                $created++;

            } catch (
                SentimentAnalysisAlreadyExistsException $exception
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