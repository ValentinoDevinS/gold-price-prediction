<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\FullArticle\FullArticleAlreadyExistsException;
use App\Repositories\ArticleRepository;
use App\Services\FullArticleService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class ArticleDownloaderService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly ArticleRepository $articleRepository,
        private readonly FullArticleService $fullArticleService,
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

        $articles = $this->articleRepository
            ->findPendingDownload();

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
                'uuid' => $article->uuid,
                'url' => $article->url,
            ])
            ->values()
            ->all();

        $results = $this->python->run(
            config('python.scripts.downloader'),
            input: $payload,
        );

        foreach ($results as $result) {

            $processed++;

            try {

                $this->fullArticleService->create($result);

                $created++;

            } catch (FullArticleAlreadyExistsException $exception) {

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