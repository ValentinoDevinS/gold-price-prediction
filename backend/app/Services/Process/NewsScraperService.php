<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\Article\ArticleAlreadyExistsException;
use App\Services\ArticleService;
use App\Services\Process\DTO\ProcessResult;
use Throwable;

final class NewsScraperService
{
    public function __construct(
        private readonly PythonProcessService $python,
        private readonly ArticleService $articleService,
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

        $articles = $this->python->run(
            'scraper/scraper.py'
        );

        foreach ($articles as $article) {

            $processed++;

            try {

                $this->articleService->create($article);

                $created++;

            } catch (ArticleAlreadyExistsException $exception) {

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