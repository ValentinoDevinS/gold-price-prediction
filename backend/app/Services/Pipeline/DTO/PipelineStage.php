<?php

declare(strict_types=1);

namespace App\Services\Pipeline\DTO;

use App\Services\Pipeline\Enums\PipelineStageStatus;

/**
 * Represents a single executable stage within a pipeline.
 *
 * The stage identity (order, name, description) is immutable.
 * Only the execution state (status and message) changes during runtime.
 */
final class PipelineStage
{
    private PipelineStageStatus $status;

    private ?string $message = null;

    public function __construct(
        private readonly int $order,
        private readonly string $name,
        private readonly string $description,
    ) {
        $this->status = PipelineStageStatus::Pending;
    }

    /**
     * Mark the stage as running.
     */
    public function start(): void
    {
        $this->status = PipelineStageStatus::Running;
        $this->message = null;
    }

    /**
     * Mark the stage as completed.
     */
    public function complete(?string $message = null): void
    {
        $this->status = PipelineStageStatus::Completed;
        $this->message = $message;
    }

    /**
     * Mark the stage as failed.
     */
    public function fail(string $message): void
    {
        $this->status = PipelineStageStatus::Failed;
        $this->message = $message;
    }

    /**
     * Mark the stage as skipped.
     */
    public function skip(?string $message = null): void
    {
        $this->status = PipelineStageStatus::Skipped;
        $this->message = $message;
    }

    public function order(): int
    {
        return $this->order;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function status(): PipelineStageStatus
    {
        return $this->status;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function isPending(): bool
    {
        return $this->status === PipelineStageStatus::Pending;
    }

    public function isRunning(): bool
    {
        return $this->status === PipelineStageStatus::Running;
    }

    public function isCompleted(): bool
    {
        return $this->status === PipelineStageStatus::Completed;
    }

    public function isFailed(): bool
    {
        return $this->status === PipelineStageStatus::Failed;
    }

    public function isSkipped(): bool
    {
        return $this->status === PipelineStageStatus::Skipped;
    }

    /**
     * Export the stage as an array.
     */
    public function toArray(): array
    {
        return [
            'order' => $this->order,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status->value,
            'message' => $this->message,
        ];
    }
}