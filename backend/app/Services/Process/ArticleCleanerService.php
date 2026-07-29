<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\CleanArticle\CleanArticleAlreadyExistsException;
use App\Repositories\FullArticleRepository;
use App\Services\CleanArticleService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class ArticleCleanerService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly FullArticleRepository $repository,
        private readonly CleanArticleService $cleanArticleService,
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
            ->findPendingCleaning();

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

                'content' => $article->content,

            ])

            ->values()

            ->all();

        $results = $this->python->run(
            config('python.scripts.cleaner'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->cleanArticleService->create($result);

                $created++;

            } catch (CleanArticleAlreadyExistsException $exception) {

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