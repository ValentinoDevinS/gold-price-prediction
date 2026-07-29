<?php

declare(strict_types=1);

namespace App\Services\Pipeline\DTO;

use App\Services\Pipeline\Enums\PipelineStatus;
use JsonSerializable;

/**
 * Tracks the execution progress of a pipeline.
 */
final class PipelineProgress implements JsonSerializable
{
    /**
     * @var PipelineStage[]
     */
    private array $stages = [];

    /**
     * Register a stage.
     */
    public function addStage(PipelineStage $stage): self
    {
        $this->stages[] = $stage;

        usort(
            $this->stages,
            fn (PipelineStage $a, PipelineStage $b) => $a->order() <=> $b->order()
        );

        return $this;
    }

    /**
     * @return PipelineStage[]
     */
    public function stages(): array
    {
        return $this->stages;
    }

    /**
     * Returns the current running stage.
     */
    public function currentStage(): ?PipelineStage
    {
        foreach ($this->stages as $stage) {
            if ($stage->isRunning()) {
                return $stage;
            }
        }

        return null;
    }

    /**
     * Returns the current step number.
     */
    public function currentStep(): int
    {
        $completed = 0;

        foreach ($this->stages as $stage) {
            if (
                $stage->isCompleted() ||
                $stage->isFailed() ||
                $stage->isSkipped()
            ) {
                $completed++;
            }
        }

        if ($this->currentStage() !== null) {
            return $completed + 1;
        }

        return $completed;
    }

    /**
     * Returns total stage count.
     */
    public function totalSteps(): int
    {
        return count($this->stages);
    }

    /**
     * Returns progress percentage.
     */
    public function percentage(): float
    {
        if ($this->totalSteps() === 0) {
            return 0.0;
        }

        return round(
            ($this->currentStep() / $this->totalSteps()) * 100,
            2
        );
    }

    /**
     * Returns overall pipeline status.
     */
    public function status(): PipelineStatus
    {
        if ($this->totalSteps() === 0) {
            return PipelineStatus::Pending;
        }

        foreach ($this->stages as $stage) {
            if ($stage->isFailed()) {
                return PipelineStatus::Failed;
            }
        }

        foreach ($this->stages as $stage) {
            if ($stage->isRunning()) {
                return PipelineStatus::Running;
            }
        }

        foreach ($this->stages as $stage) {
            if ($stage->isPending()) {
                return PipelineStatus::Pending;
            }
        }

        return PipelineStatus::Completed;
    }

    /**
     * Export progress as array.
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status()->value,
            'current_step' => $this->currentStep(),
            'total_steps' => $this->totalSteps(),
            'percentage' => $this->percentage(),
            'stages' => array_map(
                fn (PipelineStage $stage) => $stage->toArray(),
                $this->stages
            ),
        ];
    }

    /**
     * JSON serialization.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}