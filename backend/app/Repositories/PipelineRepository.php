<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Pipeline\PipelineStageData;
use App\Models\Article;
use App\Models\CleanArticle;
use App\Models\FeatureSnapshot;
use App\Models\FullArticle;
use App\Models\MlModel;
use App\Models\PredictionEvaluation;
use App\Models\PredictionResult;
use App\Models\SentimentAnalysis;
use Illuminate\Support\Collection;

final readonly class PipelineRepository
{
    /**
     * Get all pipeline stages.
     *
     * @return Collection<int, PipelineStageData>
     */
    public function allStages(): Collection
    {
        return collect([
            $this->article(),
            $this->fullArticle(),
            $this->cleanArticle(),
            $this->sentiment(),
            $this->featureEngineering(),
            $this->training(),
            $this->prediction(),
            $this->performance(),
        ]);
    }

    public function article(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Article Scraper',
            count: Article::query()->count(),
            lastExecution: Article::query()->max('scraped_at'),
        );
    }

    public function fullArticle(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Downloader',
            count: FullArticle::query()->count(),
            lastExecution: FullArticle::query()->max('downloaded_at'),
        );
    }

    public function cleanArticle(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Cleaner',
            count: CleanArticle::query()->count(),
            lastExecution: CleanArticle::query()->max('cleaned_at'),
        );
    }

    public function sentiment(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Sentiment Analysis',
            count: SentimentAnalysis::query()->count(),
            lastExecution: SentimentAnalysis::query()->max('analyzed_at'),
        );
    }

    public function featureEngineering(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Feature Engineering',
            count: FeatureSnapshot::query()->count(),
            lastExecution: FeatureSnapshot::query()->max('generated_at'),
        );
    }

    public function training(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Training',
            count: MlModel::query()->count(),
            lastExecution: MlModel::query()->max('updated_at'),
        );
    }

    public function prediction(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Prediction',
            count: PredictionResult::query()->count(),
            lastExecution: PredictionResult::query()->max('predicted_at'),
        );
    }

    public function performance(): PipelineStageData
    {
        return $this->buildStage(
            stage: 'Performance',
            count: PredictionEvaluation::query()->count(),
            lastExecution: PredictionEvaluation::query()->max('evaluated_at'),
        );
    }

    private function buildStage(
        string $stage,
        int $count,
        mixed $lastExecution,
    ): PipelineStageData {

        return PipelineStageData::make(
            stage: $stage,
            recordCount: $count,
            lastExecution: $lastExecution,
            status: $this->determineStatus(
                recordCount: $count,
                lastExecution: $lastExecution,
            ),
        );

    }

    private function determineStatus(
        int $recordCount,
        mixed $lastExecution,
    ): string {

        if ($recordCount === 0) {
            return 'Empty';
        }

        if ($lastExecution === null) {
            return 'Warning';
        }

        return 'Complete';
    }
}