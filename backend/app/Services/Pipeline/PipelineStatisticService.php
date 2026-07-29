<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

final readonly class PipelineStatisticService
{
    public function __construct(
        private PipelineQueryService $queryService,
    ) {
    }

    /**
     * Get pipeline statistics.
     *
     * @return array<string, mixed>
     */
    public function getStatistics(): array
    {
        return [

            'total_stages'
                => $this->queryService->totalStages(),

            'completed_stages'
                => $this->queryService->completedStages(),

            'latest_execution'
                => $this->latestExecution(),

            'pipeline_health'
                => $this->pipelineHealth(),

        ];
    }

    /**
     * Latest execution time.
     */
    private function latestExecution(): string
    {
        return $this->queryService
            ->latestExecution()
            ?->format('Y-m-d H:i:s')
            ?? 'Never';
    }

    /**
     * Overall pipeline health.
     */
    private function pipelineHealth(): string
    {
        if ($this->queryService->completedStages() === 0) {
            return 'Empty';
        }

        if ($this->queryService->isHealthy()) {
            return 'Healthy';
        }

        return 'Warning';
    }
}