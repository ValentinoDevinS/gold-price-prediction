<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

use App\Services\Pipeline\DTO\PipelineResult;
use App\Services\Pipeline\DTO\PipelineStage;
use App\Services\Pipeline\PipelineStatus;
use App\Services\Process\ArticleCleanerService;
use App\Services\Process\ArticleDownloaderService;
use App\Services\Process\EvaluationService;
use App\Services\Process\FeatureGeneratorService;
use App\Services\Process\NewsScraperService;
use App\Services\Process\PredictionService;
use App\Services\Process\SentimentProcessorService;
use Throwable;

final class IngestionPipelineService
{
    public function __construct(
        private readonly NewsScraperService $scraper,
        private readonly ArticleDownloaderService $downloader,
        private readonly ArticleCleanerService $cleaner,
        private readonly SentimentProcessorService $sentiment,
        private readonly FeatureGeneratorService $feature,
        private readonly PredictionService $prediction,
        private readonly EvaluationService $evaluation,
    ) {
    }

    public function run(): PipelineResult
    {
        $pipeline = new PipelineResult();

        try {

            $pipeline->addStage(
                new PipelineStage(
                    'Scraper',
                    $this->scraper->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Downloader',
                    $this->downloader->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Cleaner',
                    $this->cleaner->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Sentiment',
                    $this->sentiment->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Feature',
                    $this->feature->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Prediction',
                    $this->prediction->run(),
                )
            );

            $pipeline->addStage(
                new PipelineStage(
                    'Evaluation',
                    $this->evaluation->run(),
                )
            );

            $pipeline->setStatus(
                PipelineStatus::SUCCESS
            );

        } catch (Throwable $exception) {

            $pipeline->setStatus(
                PipelineStatus::FAILED
            );

            $pipeline->setException($exception);

        }

        return $pipeline;
    }
}