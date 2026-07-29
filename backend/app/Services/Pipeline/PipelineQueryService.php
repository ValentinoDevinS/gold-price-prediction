<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

use App\DTOs\Pipeline\PipelineStageData;
use App\Repositories\PipelineRepository;
use Illuminate\Support\Collection;

final readonly class PipelineQueryService
{
    public function __construct(
        private PipelineRepository $repository,
    ) {
    }

    /**
     * Get every pipeline stage.
     *
     * @return Collection<int, PipelineStageData>
     */
    public function allStages(): Collection
    {
        return $this->repository->allStages();
    }

    /**
     * Total pipeline stages.
     */
    public function totalStages(): int
    {
        return $this->allStages()->count();
    }

    /**
     * Completed stages.
     */
    public function completedStages(): int
    {
        return $this->allStages()

            ->filter(
                fn (PipelineStageData $stage) => $stage->isComplete()
            )

            ->count();
    }

    /**
     * Latest pipeline execution.
     */
    public function latestExecution(): ?\Carbon\Carbon
    {
        return $this->allStages()

            ->pluck('lastExecution')

            ->filter()

            ->sortDesc()

            ->first();
    }

    /**
     * Whether every stage completed successfully.
     */
    public function isHealthy(): bool
    {
        return $this->completedStages() === $this->totalStages();
    }
}